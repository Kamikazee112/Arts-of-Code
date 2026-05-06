@extends('layouts.app')

@section('title', $achievement->name . ' - Achievement')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/achievements" class="text-sm text-[var(--muted)] hover:text-[var(--accent)] transition-colors">
            ← Back to Achievements
        </a>
    </div>

    <!-- Achievement Header -->
    <div class="card p-8 mb-8">
        <div class="flex items-start gap-6">
            <div class="text-[64px]">{{ $achievement->icon ?? '🏆' }}</div>
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-[28px] font-medium text-[var(--text)]">{{ $achievement->name }}</h1>
                    @if($hasEarned)
                        <span class="text-[14px] bg-green-100 text-green-800 px-3 py-1 rounded-full">
                            ✓ Earned
                        </span>
                    @else
                        <span class="text-[14px] bg-[var(--bg)] text-[var(--muted)] px-3 py-1 rounded-full">
                            Not Earned
                        </span>
                    @endif
                </div>
                <p class="text-[14px] text-[var(--muted)] mb-4">
                    {{ $achievement->description }}
                </p>
                @if($achievement->category)
                    <div class="text-[13px] text-[var(--muted)]">
                        Category: <a href="/categories/{{ $achievement->category->slug }}" class="text-[var(--accent)] hover:underline">{{ $achievement->category->name }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- How to Earn -->
    @if($achievement->category)
        <div class="card p-6 mb-8">
            <h2 class="text-[18px] font-medium text-[var(--text)] mb-4">How to Earn</h2>
            <p class="text-[14px] text-[var(--muted)]">
                Complete all articles and exams in the <strong>{{ $achievement->category->name }}</strong> category to earn this achievement.
            </p>
            <div class="mt-4">
                <a href="/categories/{{ $achievement->category->slug }}" class="btn-primary">
                    View {{ $achievement->category->name }} Category
                </a>
            </div>
        </div>
    @endif

    <!-- Recent Earners -->
    @if($earners->count() > 0)
        <div class="card p-6">
            <h2 class="text-[18px] font-medium text-[var(--text)] mb-4">Recent Earners</h2>
            <div class="space-y-3">
                @foreach($earners as $earner)
                    <div class="flex items-center justify-between p-3 bg-[var(--bg)] rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[var(--accent)] flex items-center justify-center text-white font-medium">
                                {{ strtoupper(substr($earner->username, 0, 1)) }}
                            </div>
                            <div>
                                <a href="/users/{{ $earner->id }}" class="text-[14px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                                    {{ $earner->username }}
                                </a>
                                <div class="text-[12px] text-[var(--muted)]">
                                    Earned {{ $earner->pivot->awarded_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="card p-6">
            <h2 class="text-[18px] font-medium text-[var(--text)] mb-4">No Earners Yet</h2>
            <p class="text-[14px] text-[var(--muted)]">
                Be the first to earn this achievement!
            </p>
        </div>
    @endif
</div>
@endsection