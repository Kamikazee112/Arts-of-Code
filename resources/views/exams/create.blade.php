@extends('layouts.app')

@section('title', 'Create Quiz - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title -->
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Create Quiz</h1>

    <!-- Quiz Form -->
    <div class="card p-6">
        <form method="POST" action="/exams">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="input"
                    required
                    placeholder="Quiz title..."
                >
                @error('title')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Description (Optional)</label>
                <textarea
                    name="description"
                    rows="2"
                    class="input resize-vertical"
                    placeholder="Describe this quiz..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Time Limit -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Time Limit (minutes, optional)</label>
                <input
                    type="number"
                    name="time_limit"
                    value="{{ old('time_limit') }}"
                    class="input"
                    min="1"
                    placeholder="Leave empty for no time limit"
                >
                @error('time_limit')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Passing Score -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Passing Score (%)</label>
                <input
                    type="number"
                    name="passing_score"
                    value="{{ old('passing_score', 70) }}"
                    class="input"
                    required
                    min="0"
                    max="100"
                >
                @error('passing_score')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Max Attempts -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Max Attempts (optional)</label>
                <input
                    type="number"
                    name="max_attempts"
                    value="{{ old('max_attempts') }}"
                    class="input"
                    min="1"
                    placeholder="Leave empty for unlimited attempts"
                >
                @error('max_attempts')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-4">
                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-[var(--text)]">Make quiz immediately available</span>
                </label>
            </div>

            <!-- Categories Selection -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Categories</label>
                <div class="space-y-2">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <label class="flex items-center gap-2 p-2 border border-[var(--border)] rounded hover:bg-[var(--bg)] cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
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

            <!-- Questions Selection -->
            <div class="mb-6">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Select Questions</label>
                @if($questions->count() > 0)
                    <div class="space-y-2 max-h-[300px] overflow-y-auto border border-[var(--border)] rounded-lg p-4">
                        @foreach($questions as $question)
                            <label class="flex items-start gap-3 p-2 hover:bg-[var(--bg)] rounded cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="questions[]"
                                    value="{{ $question->id }}"
                                    class="w-4 h-4 mt-1"
                                >
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-[var(--text)]">
                                        {{ $question->title }}
                                    </div>
                                    <div class="text-xs text-[var(--muted)]">
                                        {{ Str::limit($question->question_text, 80) }}
                                    </div>
                                    <div class="flex gap-2 mt-1">
                                        <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                            {{ strtoupper($question->type) }}
                                        </span>
                                        <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                            {{ $question->points }} pts
                                        </span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-[var(--muted)] mt-2">Select at least one question for this quiz.</p>
                @else
                    <div class="text-center py-8 border border-[var(--border)] rounded-lg">
                        <p class="text-[var(--muted)] mb-4">No questions available yet.</p>
                        <a href="/questions/create" class="btn-primary text-sm">
                            Create Your First Question
                        </a>
                    </div>
                @endif
                @error('questions')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary" {{ $questions->count() === 0 ? 'disabled' : '' }}>
                Create Quiz
            </button>
        </form>
    </div>
</div>
@endsection