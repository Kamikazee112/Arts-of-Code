<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingArticles = Article::where('status', 'draft')
            ->with('user', 'tags', 'comments')
            ->latest()
            ->get();

        $publishedArticles = Article::where('status', 'published')
            ->with('user', 'tags', 'comments')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('pendingArticles', 'publishedArticles'));
    }

    public function approveArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->update([
            'status' => 'published',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Article approved successfully!');
    }

    public function rejectArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Article rejected successfully!');
    }

    public function users()
    {
        $search = request('search', '');

        $query = User::query();

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->latest()->get();

        return view('admin.users', compact('users', 'search'));
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => 'admin']);

        return back()->with('success', "{$user->username} has been promoted to admin!");
    }

    public function demoteFromAdmin($id)
    {
        $user = User::findOrFail($id);

        // Prevent demoting the last admin or yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot demote yourself!');
        }

        $adminCount = User::where('role', 'admin')->count();
        if ($adminCount <= 1) {
            return back()->with('error', 'Cannot demote the last admin!');
        }

        $user->update(['role' => 'user']);

        return back()->with('success', "{$user->username} has been demoted to user!");
    }
}
