<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExamCompletion extends Model
{
    protected $table = 'user_exam_completion';

    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'total_questions',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
