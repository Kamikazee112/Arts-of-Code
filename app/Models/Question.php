<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'question_text',
        'type',
        'explanation',
        'points',
        'user_id',
    ];

    protected $casts = [
        'type' => 'string',
        'points' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'question_category');
    }

    public function options()
    {
        return $this->hasMany(Option::class)->orderBy('order');
    }

    public function correctOption()
    {
        return $this->hasOne(Option::class)->where('is_correct', true);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question')
                    ->withPivot('order')
                    ->withTimestamps();
    }

    public function quizAnswers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
