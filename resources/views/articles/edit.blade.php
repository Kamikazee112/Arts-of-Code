@extends('layouts.app')

@section('title', 'Edit Article - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)]">Edit Article</h1>
    </div>

    <!-- Form -->
    <form method="POST" action="/articles/{{ $article->slug }}">
        @csrf
        @method('PUT')

        <!-- Error Display -->
        @if($errors->any())
            <div class="mb-6 p-4 border border-[var(--danger)] rounded-lg">
                <ul class="text-sm text-[var(--danger)]">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Title Input -->
        <div class="mb-6">
            <input
                type="text"
                name="title"
                value="{{ old('title', $article->title) }}"
                placeholder="Article title..."
                class="input text-[20px] py-3 px-4"
                required
            >
            @error('title')
                <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Categories Selection -->
        <div class="mb-6">
            <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Categories</label>
            <div class="space-y-2">
                @php
                    $categories = \App\Models\Category::all();
                    $selectedCategories = $article->categories->pluck('id')->toArray();
                @endphp
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <label class="flex items-center gap-2 p-2 border border-[var(--border)] rounded hover:bg-[var(--bg)] cursor-pointer">
                            <input
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}
                                class="w-4 h-4"
                            >
                            <span class="text-sm text-[var(--text)]">{{ $category->name }}</span>
                        </label>
                    @endforeach
                @else
                    <p class="text-sm text-[var(--muted)]">No categories available yet. <a href="/admin/categories" class="link">Create categories first</a></p>
                @endif
            </div>
            @error('categories')
                <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body Textarea -->
        <div class="mb-6">
            <textarea
                name="body"
                placeholder="Write your article in plain text or Markdown..."
                class="input min-h-[420px] resize-vertical leading-relaxed"
                required
            >{{ old('body', $article->body) }}</textarea>
            @error('body')
                <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Row -->
        <div class="flex justify-between items-center">
            <a href="/articles/{{ $article->slug }}" class="text-[var(--muted)] hover:text-[var(--text)] transition-colors">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection