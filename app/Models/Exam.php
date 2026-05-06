<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time_limit',
        'passing_score',
        'max_attempts',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'time_limit' => 'integer',
        'passing_score' => 'integer',
        'max_attempts' => 'integer',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'exam_category');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question')
                    ->withPivot('order')
                    ->withTimestamps()
                    ->orderBy('exam_question.order');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function userExamCompletions()
    {
        return $this->hasMany(UserExamCompletion::class);
    }

    public function isCompletedBy($userId)
    {
        return $this->userExamCompletions()->where('user_id', $userId)->exists();
    }
}
