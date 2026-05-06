<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserArticleCompletion extends Model
{
    protected $table = 'user_article_completion';

    protected $fillable = [
        'user_id',
        'article_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
