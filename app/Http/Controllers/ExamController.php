<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Category;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\UserExamCompletion;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Admin sees all exams for management
            $exams = Exam::with('questions')->latest()->get();
            $myExams = Exam::where('user_id', auth()->id())->latest()->get();
        } else {
            // Regular users only see active exams they can take
            $exams = Exam::with('questions')->where('is_active', true)->latest()->get();
            $myExams = collect(); // Empty collection for non-admins
        }

        return view('exams.index', compact('exams', 'myExams'));
    }

    public function create()
    {
        $questions = Question::all();
        return view('exams.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'time_limit' => ['nullable', 'integer', 'min:1'],
            'passing_score' => ['required', 'integer', 'min:0', 'max:100'],
            'max_attempts' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'questions' => ['required', 'array', 'min:1'],
            'questions.*' => ['exists:questions,id'],
        ]);

        $exam = Exam::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'time_limit' => $validated['time_limit'] ?? null,
            'passing_score' => $validated['passing_score'],
            'max_attempts' => $validated['max_attempts'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'user_id' => auth()->id(),
        ]);

        // Attach categories
        if (!empty($validated['categories'])) {
            $exam->categories()->attach($validated['categories']);
        }

        // Attach questions to exam
        foreach ($validated['questions'] as $index => $questionId) {
            $exam->questions()->attach($questionId, ['order' => $index]);
        }

        return redirect()->route('exams.index')
            ->with('success', 'Quiz created successfully!');
    }

    public function show($id)
    {
        $exam = Exam::with('questions.options')->findOrFail($id);
        return view('exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        $questions = Question::all();
        return view('exams.edit', compact('exam', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'time_limit' => ['nullable', 'integer', 'min:1'],
            'passing_score' => ['required', 'integer', 'min:0', 'max:100'],
            'max_attempts' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'questions' => ['required', 'array', 'min:1'],
            'questions.*' => ['exists:questions,id'],
        ]);

        $exam->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'time_limit' => $validated['time_limit'] ?? null,
            'passing_score' => $validated['passing_score'],
            'max_attempts' => $validated['max_attempts'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Sync categories
        if (!empty($validated['categories'])) {
            $exam->categories()->sync($validated['categories']);
        } else {
            $exam->categories()->detach();
        }

        // Sync questions
        $exam->questions()->detach();
        foreach ($validated['questions'] as $index => $questionId) {
            $exam->questions()->attach($questionId, ['order' => $index]);
        }

        return redirect()->route('exams.index')
            ->with('success', 'Quiz updated successfully!');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('exams.index')
            ->with('success', 'Quiz deleted successfully!');
    }

    public function take($id)
    {
        $exam = Exam::with('questions.options')->where('is_active', true)->findOrFail($id);

        // Check if user has exceeded max attempts
        $attempts = QuizAttempt::where('user_id', auth()->id())
            ->where('exam_id', $exam->id)
            ->count();

        if ($exam->max_attempts && $attempts >= $exam->max_attempts) {
            return back()->with('error', 'You have reached the maximum number of attempts for this quiz.');
        }

        return view('exams.take', compact('exam'));
    }

    public function submit(Request $request, $id)
    {
        $exam = Exam::with('questions.options')->findOrFail($id);

        $validated = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required'],
        ]);

        // Calculate score
        $totalPoints = 0;
        $earnedPoints = 0;

        $quizAttempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'exam_id' => $exam->id,
            'score' => 0,
            'passed' => false,
        ]);

        foreach ($exam->questions as $question) {
            $totalPoints += $question->points;

            $userAnswer = $validated['answers'][$question->id] ?? null;
            $isCorrect = false;
            $pointsEarned = 0;
            $optionId = null;
            $textAnswer = null;

            if ($question->type === 'mcq' || $question->type === 'true_false') {
                $correctOption = $question->options()->where('is_correct', true)->first();
                if ($correctOption && $userAnswer == $correctOption->id) {
                    $isCorrect = true;
                    $pointsEarned = $question->points;
                }
                $optionId = $userAnswer;
            } elseif ($question->type === 'short_answer') {
                // For short answers, store the text and mark as incorrect (admin needs to grade)
                $textAnswer = $userAnswer;
                // Short answers are not auto-graded, so 0 points by default
                $isCorrect = false;
                $pointsEarned = 0;
            }

            $earnedPoints += $pointsEarned;

            QuizAnswer::create([
                'quiz_attempt_id' => $quizAttempt->id,
                'question_id' => $question->id,
                'option_id' => $optionId,
                'text_answer' => $textAnswer,
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned,
            ]);
        }

        // Calculate percentage score
        $percentage = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;
        $passed = $percentage >= $exam->passing_score;

        $quizAttempt->update([
            'score' => $percentage,
            'passed' => $passed,
        ]);

        // Auto-mark exam as complete if user gets full mark (100%)
        if ($percentage == 100) {
            $user = Auth::user();

            // Create or update exam completion record
            UserExamCompletion::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'exam_id' => $exam->id,
                ],
                [
                    'score' => $percentage,
                    'total_questions' => $exam->questions()->count(),
                    'completed_at' => now(),
                ]
            );

            // Check if this completes any categories and award achievements
            $this->checkCategoryCompletion($user, $exam->categories);
        }

        return redirect()->route('exams.results', $quizAttempt->id)
            ->with('success', 'Quiz submitted successfully!');
    }

    public function results($attemptId)
    {
        $attempt = QuizAttempt::with(['exam', 'quizAnswers.question', 'quizAnswers.option'])
            ->where('user_id', auth()->id())
            ->findOrFail($attemptId);

        return view('exams.results', compact('attempt'));
    }

    protected function checkCategoryCompletion($user, $categories)
    {
        foreach ($categories as $category) {
            $status = $category->getCompletionStatusForUser($user->id);

            if ($status['is_complete']) {
                $this->awardCategoryAchievement($user, $category);
            }
        }
    }

    protected function awardCategoryAchievement($user, $category)
    {
        $achievement = Achievement::where('category_id', $category->id)->first();

        if ($achievement && !$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
            UserAchievement::create([
                'user_id' => $user->id,
                'achievement_id' => $achievement->id,
                'awarded_at' => now(),
            ]);
        }
    }
}
