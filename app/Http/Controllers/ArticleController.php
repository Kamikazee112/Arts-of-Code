<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $selectedCategory = request('category', '');

        $query = Article::with('user', 'categories', 'comments')->where('status', 'published');

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        // Apply category filter
        if ($selectedCategory) {
            $query->whereHas('categories', function($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $articles = $query->latest()->get();
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories', 'search', 'selectedCategory'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'status' => 'draft', // Default to draft, requires admin approval
        ]);

        // Attach categories
        if (!empty($validated['categories'])) {
            $article->categories()->attach($validated['categories']);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Article submitted for review! It will appear once approved by an admin.');
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->with('user', 'categories', 'comments.replies')->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        $article->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        // Sync categories
        if (!empty($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        } else {
            $article->categories()->detach();
        }

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Article updated successfully!');
    }

    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully!');
    }

    public function like($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $existingLike = $article->interactions()
            ->where('user_id', auth()->id())
            ->where('type', 'like')
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            return back()->with('success', 'Article unliked!');
        } else {
            // Like
            $article->interactions()->create([
                'user_id' => auth()->id(),
                'type' => 'like',
                'interactable_type' => Article::class,
                'interactable_id' => $article->id,
            ]);
            return back()->with('success', 'Article liked!');
        }
    }
}
