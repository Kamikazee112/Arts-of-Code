<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_category');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_category');
    }

    public function getCompletionStatusForUser($userId)
    {
        $totalArticles = $this->articles()->where('status', 'published')->count();
        $totalExams = $this->exams()->count();
        $totalItems = $totalArticles + $totalExams;

        if ($totalItems === 0) {
            return [
                'total' => 0,
                'completed' => 0,
                'percentage' => 0,
                'is_complete' => true,
                'articles_completed' => 0,
                'exams_completed' => 0,
            ];
        }

        $completedArticles = $this->articles()
            ->where('status', 'published')
            ->whereHas('userCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->count();

        $completedExams = $this->exams()
            ->whereHas('userExamCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->count();

        $totalCompleted = $completedArticles + $completedExams;
        $percentage = ($totalCompleted / $totalItems) * 100;

        return [
            'total' => $totalItems,
            'completed' => $totalCompleted,
            'percentage' => round($percentage, 2),
            'is_complete' => $totalCompleted === $totalItems,
            'articles_completed' => $completedArticles,
            'exams_completed' => $completedExams,
        ];
    }

    public function getCompletedArticlesForUser($userId)
    {
        return $this->articles()
            ->where('status', 'published')
            ->whereHas('userCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    public function getCompletedExamsForUser($userId)
    {
        return $this->exams()
            ->whereHas('userExamCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    public function getIncompleteArticlesForUser($userId)
    {
        return $this->articles()
            ->where('status', 'published')
            ->whereDoesntHave('userCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    public function getIncompleteExamsForUser($userId)
    {
        return $this->exams()
            ->whereDoesntHave('userExamCompletions', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }
}