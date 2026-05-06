@extends('layouts.app')

@section('title', 'Home - Arts Of Code')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Hero Section -->
    <section class="pt-16 pb-12">
        <h1 class="text-[32px] font-medium text-[var(--text)] mb-4">Arts Of Code</h1>
        <p class="text-[16px] text-[var(--muted)] mb-8">A community for problem solvers and competitive programmers.</p>

        @guest
            <div class="flex gap-4">
                <a href="/articles" class="btn-primary">
                    Browse Articles
                </a>
                <a href="/achievements" class="text-[var(--muted)] hover:text-[var(--accent)] transition-colors">
                    View Achievements
                </a>
            </div>
        @endguest

        @auth
            <p class="text-[var(--text)]">
                Welcome back, {{ auth()->user()->username }}! —
                <a href="/articles/create" class="link">Write an article</a>
            </p>
        @endauth
    </section>

    <!-- Recent Articles Section -->
    <section class="pt-8">
        <h2 class="text-[12px] uppercase tracking-[0.08em] text-[var(--muted)] mb-6">Recent Articles</h2>

        @if(isset($articles) && $articles->count() > 0)
            <div class="space-y-0">
                @foreach($articles as $article)
                    <div class="py-5 border-b border-[var(--border)] last:border-0">
                        <a href="/articles/{{ $article->slug }}" class="text-[17px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-2">
                            {{ $article->title }}
                        </a>
                        <p class="text-[13px] text-[var(--muted)]">
                            by {{ $article->user->username }} · {{ $article->created_at->diffForHumans() }}
                            @if($article->tags->count() > 0)
                                · {{ $article->tags->pluck('name')->implode(', ') }}
                            @endif
                            @if($article->comments->count() > 0)
                                · {{ $article->comments->count() }} {{ $article->comments->count() === 1 ? 'comment' : 'comments' }}
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="text-right mt-6">
                <a href="/articles" class="text-sm text-[var(--muted)] hover:text-[var(--accent)] transition-colors">
                    See all articles →
                </a>
            </div>
        @else
            <p class="text-[var(--muted)]">No articles published yet.</p>
        @endif
    </section>

    <!-- Categories Section -->
    <section class="pt-8">
        <h2 class="text-[12px] uppercase tracking-[0.08em] text-[var(--muted)] mb-6">Learning Categories</h2>

        @php
            $categories = \App\Models\Category::withCount(['articles', 'exams'])->get();
        @endphp

        @if($categories->count() > 0)
            <div class="grid grid-cols-2 gap-4">
                @foreach($categories as $category)
                    <a href="/categories/{{ $category->slug }}" class="card p-4 hover:shadow-md transition-shadow block">
                        <h3 class="text-[15px] font-medium text-[var(--text)] mb-2">{{ $category->name }}</h3>
                        <p class="text-[12px] text-[var(--muted)] mb-3">
                            {{ $category->articles_count }} articles · {{ $category->exams_count }} exams
                        </p>
                        @if($category->description)
                            <p class="text-[12px] text-[var(--muted)] line-clamp-2">
                                {{ Str::limit($category->description, 80) }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-[var(--muted)]">No categories available yet.</p>
        @endif
    </section>
</div>
@endsection