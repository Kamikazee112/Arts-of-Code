@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
    <div class="max-w-[800px] mx-auto">
        <!-- Page Title Row -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-[22px] font-medium text-[var(--text)] mb-2">التصنيفات</h1>
                <p class="text-[14px] text-[var(--muted)]">
                    Manage categories for articles, exams, and questions.
                </p>
            </div>
            <a href="/admin/categories/create" class="btn-primary">
                Create Category
            </a>
        </div>

        <!-- Categories List -->
        @if(isset($categories) && $categories->count() > 0)
            <div class="space-y-0">
                @foreach($categories as $category)
                    <div class="py-5 border-b border-[var(--border)] last:border-0">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-[17px] font-medium text-[var(--text)] mb-2">
                                    {{ $category->name }}
                                </h3>
                                @if($category->description)
                                    <p class="text-[13px] text-[var(--muted)] mb-2">
                                        {{ Str::limit($category->description, 100) }}
                                    </p>
                                @endif
                                <div class="flex gap-2">
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ $category->articles_count }} articles
                                    </span>
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ $category->exams_count }} exams
                                    </span>
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ $category->questions_count ?? 0 }} questions
                                    </span>
                                </div>
                            </div>
                            <div class="action-group ml-4">
                                <a href="/admin/categories/{{ $category->id }}/edit"
                                    class="btn-sm btn-sm-edit">
                                    Edit
                                </a>
                                <form method="POST" action="/admin/categories/{{ $category->id }}"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-sm-delete">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-[var(--muted)] mb-4">No categories created yet.</p>
                <a href="/admin/categories/create" class="btn-primary">
                    Create Your First Category
                </a>
            </div>
        @endif
    </div>
@endsection