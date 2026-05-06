@extends('layouts.app')

@section('title', 'All Categories - Arts Of Code')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[28px] font-medium text-[var(--text)] mb-2">All Categories</h1>
        <p class="text-[14px] text-[var(--muted)]">
            Browse all learning categories and track your progress
        </p>
    </div>

    <!-- Categories Grid -->
    @php
        $categories = \App\Models\Category::withCount(['articles', 'exams'])->get();
        $user = auth()->user();
    @endphp

    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                @php
                    $completionStatus = $user ? $category->getCompletionStatusForUser($user->id) : null;
                @endphp

                <a href="/categories/{{ $category->slug }}" class="card p-6 hover:shadow-lg transition-shadow block">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-[18px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                            {{ $category->name }}
                        </h3>
                        @if($completionStatus && $completionStatus['is_complete'])
                            <span class="text-[12px] bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                ✓ Complete
                            </span>
                        @endif
                    </div>

                    @if($category->description)
                        <p class="text-[13px] text-[var(--muted)] mb-4 line-clamp-2">
                            {{ $category->description }}
                        </p>
                    @endif

                    <div class="flex items-center gap-4 text-[12px] text-[var(--muted)] mb-4">
                        <span>{{ $category->articles_count }} articles</span>
                        <span>{{ $category->exams_count }} exams</span>
                    </div>

                    @if($completionStatus)
                        <!-- Progress Bar -->
                        <div class="w-full bg-[var(--border)] rounded-full h-2 mb-2">
                            <div class="bg-[var(--accent)] h-2 rounded-full transition-all duration-300"
                                 style="width: {{ $completionStatus['percentage'] }}%"></div>
                        </div>
                        <div class="text-[12px] text-[var(--muted)]">
                            <span>{{ $completionStatus['completed'] }}</span> / <span>{{ $completionStatus['total'] }}</span> completed
                            <span class="ml-2 text-[var(--accent)]">({{ $completionStatus['percentage'] }}%)</span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-[48px] mb-4">📭</div>
            <h3 class="text-[18px] font-medium text-[var(--text)] mb-2">No categories available</h3>
            <p class="text-[14px] text-[var(--muted)]">
                Check back later for new learning categories.
            </p>
        </div>
    @endif
</div>
@endsection