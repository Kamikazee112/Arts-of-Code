@extends('layouts.app')

@section('title', 'Admin Dashboard - Arts Of Code')

@section('content')
<div class="max-w-[1000px] mx-auto">
    <h1 class="text-[28px] font-medium text-[var(--text)] mb-8">Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid md:grid-cols-5 gap-6 mb-8">
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $pendingArticles->count() }}</div>
            <div class="text-[14px] text-[var(--muted)]">Pending Articles</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $publishedArticles->count() }}</div>
            <div class="text-[14px] text-[var(--muted)]">Published Articles</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ \App\Models\User::count() }}</div>
            <div class="text-[14px] text-[var(--muted)]">Total Users</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ \App\Models\Exam::count() }}</div>
            <div class="text-[14px] text-[var(--muted)]">Total Quizzes</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ \App\Models\Category::count() }}</div>
            <div class="text-[14px] text-[var(--muted)]">Categories</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Quick Actions</h2>
        <div class="grid md:grid-cols-5 gap-4">
            <a href="/admin/categories" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">📁</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Manage Categories</div>
                <div class="text-[13px] text-[var(--muted)]">Create and edit categories</div>
            </a>
            <a href="/admin/users" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">👥</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Manage Users</div>
                <div class="text-[13px] text-[var(--muted)]">Promote/demote admins</div>
            </a>
            <a href="/questions/create" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">❓</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Create Question</div>
                <div class="text-[13px] text-[var(--muted)]">Add new quiz questions</div>
            </a>
            <a href="/exams/create" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">🎯</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">Create Quiz</div>
                <div class="text-[13px] text-[var(--muted)]">Build quizzes from questions</div>
            </a>
            <a href="/admin/dashboard" class="card p-6 hover:border-[var(--accent)] transition-colors block">
                <div class="text-[20px] mb-2">📊</div>
                <div class="text-[16px] font-medium text-[var(--text)] mb-1">View Stats</div>
                <div class="text-[13px] text-[var(--muted)]">See platform statistics</div>
            </a>
        </div>
    </div>

    <!-- Pending Articles Section -->
    <div class="mb-8">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Pending Articles</h2>

        @if($pendingArticles->count() > 0)
            <div class="space-y-0">
                @foreach($pendingArticles as $article)
                    <div class="card p-4 mb-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-[16px] font-medium text-[var(--text)] mb-1">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-[13px] text-[var(--muted)] mb-2">
                                    By {{ $article->user->username }} · {{ $article->created_at->diffForHumans() }}
                                </p>
                                <p class="text-[14px] text-[var(--text)] line-clamp-2">
                                    {{ Str::limit(strip_tags($article->body), 150) }}
                                </p>
                                @if($article->tags->count() > 0)
                                    <div class="mt-2">
                                        @foreach($article->tags as $tag)
                                            <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs mr-1">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex gap-2">
                                <a href="/articles/{{ $article->slug }}" target="_blank" class="btn-outline text-sm">
                                    Preview
                                </a>
                                <form method="POST" action="/admin/articles/{{ $article->slug }}/approve">
                                    @csrf
                                    <button type="submit" class="btn-primary text-sm">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="/admin/articles/{{ $article->slug }}/reject" onsubmit="return confirm('Are you sure you want to reject this article?');">
                                    @csrf
                                    <button type="submit" class="btn-danger text-sm">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card p-8 text-center">
                <p class="text-[var(--muted)]">No pending articles to review.</p>
            </div>
        @endif
    </div>

    <!-- Recent Published Articles -->
    <div>
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Recent Published Articles</h2>

        @if($publishedArticles->count() > 0)
            <div class="space-y-0">
                @foreach($publishedArticles as $article)
                    <div class="py-4 border-b border-[var(--border)] last:border-0">
                        <a href="/articles/{{ $article->slug }}" class="text-[16px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-1">
                            {{ $article->title }}
                        </a>
                        <p class="text-[13px] text-[var(--muted)]">
                            By {{ $article->user->username }} · {{ $article->created_at->diffForHumans() }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card p-8 text-center">
                <p class="text-[var(--muted)]">No published articles yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection