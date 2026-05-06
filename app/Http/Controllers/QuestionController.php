<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\Option;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        // Debug: Log the request data
        \Log::info('Question creation attempt', [
            'type' => $request->input('type'),
            'correct_answer' => $request->input('correct_answer'),
            'correct_option' => $request->input('correct_option'),
            'options' => $request->input('options'),
            'all_data' => $request->all()
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'question_text' => ['required', 'string'],
            'type' => ['required', 'in:mcq,true_false,short_answer'],
            'explanation' => ['nullable', 'string'],
            'points' => ['required', 'integer', 'min:1'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'options' => ['required_if:type,mcq', 'array', 'min:2'],
            'options.*.text' => ['required_if:type,mcq', 'string'],
            'correct_option' => ['required_if:type,mcq', 'integer', 'min:0', 'max:3'],
            'correct_answer' => ['required_if:type,true_false', 'in:0,1'],
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'question_text' => $validated['question_text'],
            'type' => $validated['type'],
            'explanation' => $validated['explanation'] ?? null,
            'points' => $validated['points'],
            'user_id' => auth()->id(),
        ]);

        // Attach categories
        if (!empty($validated['categories'])) {
            $question->categories()->attach($validated['categories']);
        }

        // Handle MCQ options
        if ($validated['type'] === 'mcq') {
            foreach ($validated['options'] as $index => $optionData) {
                Option::create([
                    'option_text' => $optionData['text'],
                    'is_correct' => ($index == $validated['correct_option']),
                    'order' => $index,
                    'question_id' => $question->id,
                ]);
            }
        }
        // Handle true/false
        elseif ($validated['type'] === 'true_false') {
            $isTrueCorrect = ($validated['correct_answer'] == '1');
            Option::create([
                'option_text' => 'True',
                'is_correct' => $isTrueCorrect,
                'order' => 0,
                'question_id' => $question->id,
            ]);
            Option::create([
                'option_text' => 'False',
                'is_correct' => !$isTrueCorrect,
                'order' => 1,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('questions.index')
            ->with('success', 'Question created successfully!');
    }

    public function show($id)
    {
        $question = Question::with('options')->findOrFail($id);
        return view('questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::with('options')->findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'question_text' => ['required', 'string'],
            'type' => ['required', 'in:mcq,true_false,short_answer'],
            'explanation' => ['nullable', 'string'],
            'points' => ['required', 'integer', 'min:1'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'options' => ['required_if:type,mcq', 'array', 'min:2'],
            'options.*.text' => ['required_if:type,mcq', 'string'],
            'correct_option' => ['required_if:type,mcq', 'integer', 'min:0', 'max:3'],
            'correct_answer' => ['required_if:type,true_false', 'in:0,1'],
        ]);

        $question->update([
            'title' => $validated['title'],
            'question_text' => $validated['question_text'],
            'type' => $validated['type'],
            'explanation' => $validated['explanation'] ?? null,
            'points' => $validated['points'],
        ]);

        // Sync categories
        if (!empty($validated['categories'])) {
            $question->categories()->sync($validated['categories']);
        } else {
            $question->categories()->detach();
        }

        // Delete existing options and recreate
        $question->options()->delete();

        // Handle MCQ options
        if ($validated['type'] === 'mcq') {
            foreach ($validated['options'] as $index => $optionData) {
                Option::create([
                    'option_text' => $optionData['text'],
                    'is_correct' => ($index == $validated['correct_option']),
                    'order' => $index,
                    'question_id' => $question->id,
                ]);
            }
        }
        // Handle true/false
        elseif ($validated['type'] === 'true_false') {
            $isTrueCorrect = ($validated['correct_answer'] == '1');
            Option::create([
                'option_text' => 'True',
                'is_correct' => $isTrueCorrect,
                'order' => 0,
                'question_id' => $question->id,
            ]);
            Option::create([
                'option_text' => 'False',
                'is_correct' => !$isTrueCorrect,
                'order' => 1,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('questions.index')
            ->with('success', 'Question updated successfully!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')
            ->with('success', 'Question deleted successfully!');
    }
}
