<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Exam;
use App\Models\Category;
use App\Models\UserArticleCompletion;
use App\Models\UserExamCompletion;
use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Auth;

class CategoryCompletionController extends Controller
{
    public function markArticleComplete(Request $request, $articleId)
    {
        $article = Article::findOrFail($articleId);
        $user = Auth::user();

        $completion = UserArticleCompletion::updateOrCreate(
            [
                'user_id' => $user->id,
                'article_id' => $articleId,
            ],
            [
                'completed_at' => now(),
            ]
        );

        $this->checkCategoryCompletion($user, $article->categories);

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Article marked as completed',
            ]);
        }

        // Redirect back for form submissions
        return redirect()->back()->with('success', 'Article marked as completed!');
    }

    public function markExamComplete(Request $request, $examId)
    {
        $exam = Exam::findOrFail($examId);
        $user = Auth::user();

        $completion = UserExamCompletion::updateOrCreate(
            [
                'user_id' => $user->id,
                'exam_id' => $examId,
            ],
            [
                'score' => $request->score ?? 0,
                'total_questions' => $request->total_questions ?? $exam->questions()->count(),
                'completed_at' => now(),
            ]
        );

        $this->checkCategoryCompletion($user, $exam->categories);

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Exam marked as completed',
            ]);
        }

        // Redirect back for form submissions
        return redirect()->back()->with('success', 'Exam marked as completed!');
    }

    public function getCategoryCompletionStatus($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $user = Auth::user();

        $status = $category->getCompletionStatusForUser($user->id);

        return response()->json([
            'category' => $category->name,
            'status' => $status,
        ]);
    }

    public function getAllCategoriesCompletion()
    {
        $user = Auth::user();
        $categories = Category::with(['articles', 'exams'])->get();

        $categoriesWithStatus = $categories->map(function ($category) use ($user) {
            $articles = $category->articles->map(function ($article) use ($user) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'is_completed' => $article->isCompletedBy($user->id),
                ];
            });

            $exams = $category->exams->map(function ($exam) use ($user) {
                return [
                    'id' => $exam->id,
                    'title' => $exam->title,
                    'is_completed' => $exam->isCompletedBy($user->id),
                ];
            });

            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'articles' => $articles,
                'exams' => $exams,
                'status' => $category->getCompletionStatusForUser($user->id),
            ];
        });

        return response()->json([
            'categories' => $categoriesWithStatus,
        ]);
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
