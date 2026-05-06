@extends('layouts.app')

@section('title', $category->name . ' - Arts Of Code')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Category Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="/" class="text-sm text-[var(--muted)] hover:text-[var(--accent)]">Home</a>
            <span class="text-[var(--muted)]">/</span>
            <span class="text-sm text-[var(--text)]">{{ $category->name }}</span>
        </div>

        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-[28px] font-medium text-[var(--text)] mb-2">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-[14px] text-[var(--muted)]">{{ $category->description }}</p>
                @endif
            </div>

            @if($completionStatus)
                <div class="text-right">
                    <div class="text-[14px] text-[var(--muted)] mb-1">Progress</div>
                    <div class="text-[24px] font-medium text-[var(--accent)]">
                        {{ $completionStatus['percentage'] }}%
                    </div>
                    <div class="text-[12px] text-[var(--muted)]">
                        {{ $completionStatus['completed'] }} / {{ $completionStatus['total'] }} completed
                    </div>
                    @if($completionStatus['is_complete'])
                        <div class="mt-2 text-[12px] bg-green-100 text-green-800 px-3 py-1 rounded-full inline-block">
                            🏆 Achievement Earned!
                        </div>
                    @endif
                </div>
            @endif
        </div>

        @if($completionStatus)
            <!-- Progress Bar -->
            <div class="mt-4 w-full bg-[var(--border)] rounded-full h-3">
                <div class="bg-[var(--accent)] h-3 rounded-full transition-all duration-300"
                     style="width: {{ $completionStatus['percentage'] }}%"></div>
            </div>
        @endif
    </div>

    <!-- Articles Section -->
    @if($articles->count() > 0)
        <div class="mb-8">
            <h2 class="text-[20px] font-medium text-[var(--text)] mb-4 flex items-center gap-2">
                <span>📚</span> Articles
                <span class="text-[14px] text-[var(--muted)] font-normal">({{ $articles->count() }})</span>
            </h2>

            <div class="grid gap-4">
                @foreach($articles as $index => $article)
                    <div class="card p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-4">
                            <!-- Level Number -->
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--bg)] border border-[var(--border)] flex items-center justify-center text-[14px] font-medium text-[var(--text)]">
                                {{ $index + 1 }}
                            </div>

                            <!-- Article Content -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <a href="/articles/{{ $article->slug }}"
                                       class="text-[16px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                                        {{ $article->title }}
                                    </a>
                                    @if(isset($article->is_completed) && $article->is_completed)
                                        <span class="text-green-600 text-[14px]">✓</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4 text-[12px] text-[var(--muted)]">
                                    <span>By {{ $article->user->username }}</span>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                    @if($article->likesCount() > 0)
                                        <span>{{ $article->likesCount() }} likes</span>
                                    @endif
                                </div>

                                @if($article->body)
                                    <p class="text-[13px] text-[var(--muted)] mt-2 line-clamp-2">
                                        {{ Str::limit(strip_tags($article->body), 150) }}
                                    </p>
                                @endif
                            </div>

                            <!-- Action Button -->
                            @auth
                                @if(isset($article->is_completed) && !$article->is_completed)
                                    <form method="POST" action="/articles/{{ $article->id }}/complete" class="flex-shrink-0">
                                        @csrf
                                        <button type="submit" class="btn-outline text-[12px] px-3 py-1">
                                            Mark Complete
                                        </button>
                                    </form>
                                @elseif(isset($article->is_completed) && $article->is_completed)
                                    <span class="flex-shrink-0 text-[12px] text-green-600 px-3 py-1 bg-green-50 rounded">
                                        Completed
                                    </span>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Exams Section -->
    @if($exams->count() > 0)
        <div class="mb-8">
            <h2 class="text-[20px] font-medium text-[var(--text)] mb-4 flex items-center gap-2">
                <span>🎯</span> Exams
                <span class="text-[14px] text-[var(--muted)] font-normal">({{ $exams->count() }})</span>
            </h2>

            <div class="grid gap-4">
                @foreach($exams as $index => $exam)
                    <div class="card p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-4">
                            <!-- Level Number -->
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--bg)] border border-[var(--border)] flex items-center justify-center text-[14px] font-medium text-[var(--text)]">
                                {{ $articles->count() + $index + 1 }}
                            </div>

                            <!-- Exam Content -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <a href="/exams/{{ $exam->id }}"
                                       class="text-[16px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                                        {{ $exam->title }}
                                    </a>
                                    @if(isset($exam->is_completed) && $exam->is_completed)
                                        <span class="text-green-600 text-[14px]">✓</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4 text-[12px] text-[var(--muted)]">
                                    <span>{{ $exam->questions->count() }} questions</span>
                                    @if($exam->time_limit)
                                        <span>{{ $exam->time_limit }} minutes</span>
                                    @endif
                                    @if($exam->passing_score)
                                        <span>Passing: {{ $exam->passing_score }}%</span>
                                    @endif
                                </div>

                                @if($exam->description)
                                    <p class="text-[13px] text-[var(--muted)] mt-2 line-clamp-2">
                                        {{ Str::limit($exam->description, 150) }}
                                    </p>
                                @endif
                            </div>

                            <!-- Action Button -->
                            @auth
                                @if(isset($exam->is_completed) && !$exam->is_completed)
                                    <div class="flex-shrink-0">
                                        <a href="/exams/{{ $exam->id }}/take"
                                           class="btn-primary text-[12px] px-3 py-1">
                                            Take Exam
                                        </a>
                                    </div>
                                @elseif(isset($exam->is_completed) && $exam->is_completed)
                                    <span class="flex-shrink-0 text-[12px] text-green-600 px-3 py-1 bg-green-50 rounded">
                                        Completed
                                    </span>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Empty State -->
    @if($articles->count() === 0 && $exams->count() === 0)
        <div class="text-center py-12">
            <div class="text-[48px] mb-4">📭</div>
            <h3 class="text-[18px] font-medium text-[var(--text)] mb-2">No content yet</h3>
            <p class="text-[14px] text-[var(--muted)]">
                This category doesn't have any articles or exams yet.
            </p>
        </div>
    @endif
</div>
@endsection