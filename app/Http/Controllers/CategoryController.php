<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['articles', 'exams'])->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
        ]);

        $slug = strtolower(str_replace(' ', '-', $validated['name']));

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $id],
            'description' => ['nullable', 'string'],
        ]);

        $slug = strtolower(str_replace(' ', '-', $validated['name']));

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['articles' => function($query) {
                $query->where('status', 'published');
            }, 'exams'])
            ->firstOrFail();
        $user = auth()->user();

        // Get completion status for the current user
        $completionStatus = $user ? $category->getCompletionStatusForUser($user->id) : null;

        // Mark articles and exams as completed for the current user
        if ($user) {
            $articles = $category->articles->map(function ($article) use ($user) {
                $article->is_completed = $article->isCompletedBy($user->id);
                return $article;
            });

            $exams = $category->exams->map(function ($exam) use ($user) {
                $exam->is_completed = $exam->isCompletedBy($user->id);
                return $exam;
            });
        } else {
            $articles = $category->articles;
            $exams = $category->exams;
        }

        return view('categories.show', compact('category', 'articles', 'exams', 'completionStatus'));
    }
}