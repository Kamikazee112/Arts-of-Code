<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'slug',
        'status',
        'approved_by',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function interactions()
    {
        return $this->morphMany(Interaction::class, 'interactable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagsStringAttribute()
    {
        return $this->tags->pluck('name')->implode(', ');
    }

    public function isLikedBy($userId)
    {
        return $this->interactions()
            ->where('user_id', $userId)
            ->where('type', 'like')
            ->exists();
    }

    public function likesCount()
    {
        return $this->interactions()->where('type', 'like')->count();
    }

    public function userCompletions()
    {
        return $this->hasMany(UserArticleCompletion::class);
    }

    public function isCompletedBy($userId)
    {
        return $this->userCompletions()->where('user_id', $userId)->exists();
    }
}
