@extends('layouts.app')

@section('title', 'All Categories - Arts Of Code')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-medium text-[var(--text)] mb-2">All Categories</h1>
            <p class="text-sm text-[var(--muted)] max-w-2xl">
                Browse all learning categories and track your progress
            </p>
        </div>

        <!-- Categories Grid -->
        @php
            $categories = \App\Models\Category::withCount(['articles', 'exams'])->get();
            $user = auth()->user();
        @endphp

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    @php
                        $completionStatus = $user ? $category->getCompletionStatusForUser($user->id) : null;
                    @endphp

                    <a href="/categories/{{ $category->slug }}" role="article" aria-label="Category {{ $category->name }}" class="block bg-white rounded-lg border border-[var(--border)] shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1 p-5">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors truncate">
                                {{ $category->name }}
                            </h3>
                            @if($completionStatus && $completionStatus['is_complete'])
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                    ✓ Complete
                                </span>
                            @endif
                        </div>

                        @if($category->description)
                            <p class="text-sm text-[var(--muted)] mb-4 line-clamp-3">
                                {{ $category->description }}
                            </p>
                        @endif

                        <div class="flex flex-wrap items-center gap-3 text-sm text-[var(--muted)] mb-4">
                            <span class="inline-flex items-center gap-2 bg-[var(--muted-bg,white)] px-3 py-1 rounded-md border border-transparent text-[13px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[var(--muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" /></svg>
                                <span>{{ $category->articles_count }} articles</span>
                            </span>
                            <span class="inline-flex items-center gap-2 bg-[var(--muted-bg,white)] px-3 py-1 rounded-md border border-transparent text-[13px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[var(--muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M7 21h10" /></svg>
                                <span>{{ $category->exams_count }} exams</span>
                            </span>
                        </div>

                        @if($completionStatus)
                            <div class="mb-2">
                                <div class="w-full bg-[var(--border)] rounded-full h-2 overflow-hidden">
                                    <div class="bg-[var(--accent)] h-2 rounded-full transition-all duration-300" style="width: {{ $completionStatus['percentage'] }}%"></div>
                                </div>
                                <div class="flex items-center justify-between text-xs text-[var(--muted)] mt-2">
                                    <div>
                                        <span class="font-medium text-[var(--text)]">{{ $completionStatus['completed'] }}</span>
                                        <span> / {{ $completionStatus['total'] }} completed</span>
                                    </div>
                                    <div class="text-[var(--accent)] font-medium">{{ $completionStatus['percentage'] }}%</div>
                                </div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-5xl mb-4">📭</div>
                <h3 class="text-lg font-medium text-[var(--text)] mb-2">No categories available</h3>
                <p class="text-sm text-[var(--muted)] max-w-md mx-auto">
                    Check back later for new learning categories.
                </p>
            </div>
        @endif
    </div>
@endsection
