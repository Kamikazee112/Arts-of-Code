@extends('layouts.app')

@section('title', 'Profile - Arts Of Code')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Profile Header -->
    <section class="py-8">
        <h1 class="text-[24px] font-medium text-[var(--text)] mb-2">
            {{ auth()->user()->username }}
        </h1>
        <p class="text-[13px] text-[var(--muted)] mb-4">
            Member since {{ auth()->user()->created_at->format('M Y') }}
        </p>

        @if(auth()->user()->profile && auth()->user()->profile->bio)
            <p class="text-[14px] text-[var(--muted)] mb-6">
                {{ auth()->user()->profile->bio }}
            </p>
        @endif

        <!-- Stats Row -->
        <div class="flex gap-8 mt-4">
            <div>
                <span class="text-[14px] font-medium text-[var(--text)]">{{ auth()->user()->articles()->count() }}</span>
                <span class="text-[14px] text-[var(--muted)] ml-1">Articles</span>
            </div>
            <div>
                <span class="text-[14px] font-medium text-[var(--text)]">{{ auth()->user()->quizAttempts()->count() }}</span>
                <span class="text-[14px] text-[var(--muted)] ml-1">Quiz Attempts</span>
            </div>
            <div>
                <span class="text-[14px] font-medium text-[var(--text)]">{{ auth()->user()->achievements()->count() }}</span>
                <span class="text-[14px] text-[var(--muted)] ml-1">Achievements</span>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <hr class="border-t border-[var(--border)] my-6">

    <!-- Articles Section -->
    <section>
        <h2 class="text-[16px] font-medium text-[var(--text)] mb-4">
            Your Articles
        </h2>

        @if(auth()->user()->articles()->count() > 0)
            <div class="space-y-0">
                @foreach(auth()->user()->articles as $article)
                    <div class="py-5 border-b border-[var(--border)] last:border-0">
                        <a href="/articles/{{ $article->slug }}" class="text-[17px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-2">
                            {{ $article->title }}
                        </a>
                        <p class="text-[13px] text-[var(--muted)]">
                            {{ $article->created_at->diffForHumans() }} · {{ $article->status }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-[var(--muted)]">No published articles yet. <a href="/articles/create" class="link">Write your first article!</a></p>
        @endif
    </section>
</div>
@endsection