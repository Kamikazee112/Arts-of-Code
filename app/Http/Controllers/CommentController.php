<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete all replies as well
        $comment->replies()->delete();
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
