@extends('layouts.app')

@section('title', 'Dashboard - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-[28px] font-medium text-[var(--text)] mb-2">
            Welcome back, {{ auth()->user()->username }}!
        </h1>
        <p class="text-[14px] text-[var(--muted)]">
            Here's what's happening with your account today.
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <!-- Articles Stat -->
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $articlesCount }}</div>
            <div class="text-[14px] text-[var(--muted)]">Articles Published</div>
        </div>

        <!-- Quiz Attempts Stat -->
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $quizAttemptsCount }}</div>
            <div class="text-[14px] text-[var(--muted)]">Quiz Attempts</div>
        </div>

        <!-- Achievements Stat -->
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $achievementsCount }}</div>
            <div class="text-[14px] text-[var(--muted)]">Achievements Earned</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Quick Actions</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="/articles/create" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">📝</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Write an Article</div>
                <div class="text-[13px] text-[var(--muted)]">Share your knowledge with the community</div>
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="/questions/create" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                    <div class="text-[20px] mb-2">❓</div>
                    <div class="text-[16px] font-medium text-[var(--text)] mb-1">Create Question</div>
                    <div class="text-[13px] text-[var(--muted)]">Add MCQ, True/False, or Short Answer questions</div>
                </a>

                <a href="/exams/create" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                    <div class="text-[20px] mb-2">🎯</div>
                    <div class="text-[16px] font-medium text-[var(--text)] mb-1">Create Quiz</div>
                    <div class="text-[13px] text-[var(--muted)]">Build quizzes from your questions</div>
                </a>
            @endif

            <a href="/exams" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">📝</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Take a Quiz</div>
                <div class="text-[13px] text-[var(--muted)]">Test your problem-solving skills</div>
            </a>

            <a href="/articles" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">📚</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Browse Articles</div>
                <div class="text-[13px] text-[var(--muted)]">Learn from community tutorials</div>
            </a>

            <a href="/achievements" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">🏆</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">View Achievements</div>
                <div class="text-[13px] text-[var(--muted)]">Track your progress and earned badges</div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div>
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Your Articles</h2>
        <div class="card p-6">
            @if(auth()->user()->articles()->count() > 0)
                <div class="space-y-0">
                    @foreach(auth()->user()->articles()->latest()->get() as $article)
                        <div class="py-4 border-b border-[var(--border)] last:border-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <a href="/articles/{{ $article->slug }}" class="text-[16px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-1">
                                        {{ $article->title }}
                                    </a>
                                    <p class="text-[13px] text-[var(--muted)]">
                                        {{ $article->created_at->diffForHumans() }} ·
                                        <span class="px-2 py-1 rounded text-xs {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : ($article->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($article->status) }}
                                        </span>
                                    </p>
                                    @if($article->tags->count() > 0)
                                        <div class="mt-1">
                                            @foreach($article->tags as $tag)
                                                <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs mr-1">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                @if($article->status === 'draft')
                                    <a href="/articles/{{ $article->slug }}/edit" class="ml-4 text-sm text-[var(--accent)] hover:underline">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-[var(--muted)] text-center py-8">No articles yet. <a href="/articles/create" class="link">Write your first article!</a></p>
            @endif
        </div>
    </div>
</div>
@endsection