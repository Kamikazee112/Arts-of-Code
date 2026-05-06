@extends('layouts.app')

@section('title', 'Ranking - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)] mb-2">Ranking</h1>
        <p class="text-[14px] text-[var(--muted)]">
            Ranked by total score across articles and exams.
        </p>
    </div>

    <!-- Ranking Table -->
    @if(isset($users) && $users->count() > 0)
        <div>
            <!-- Header Row -->
            <div class="flex text-[12px] text-[var(--muted)] uppercase tracking-[0.06em] px-4 pb-2 border-b border-[var(--border)]">
                <div class="w-10">Rank</div>
                <div class="flex-1">User</div>
                <div class="w-20 text-center">Articles</div>
                <div class="w-24 text-center">Best Exam</div>
                <div class="w-24 text-center">Total Score</div>
            </div>

            <!-- User Rows -->
            @foreach($users as $user)
                <div class="flex items-center px-4 py-4 border-b border-[var(--border)] {{ auth()->check() && auth()->id() === $user->id ? 'border-l-3 border-l-[var(--accent)] bg-[#EFF6FF]' : '' }}">
                    <!-- Rank -->
                    <div class="w-10 font-medium">
                        @if($user->rank === 1)
                            <span class="flex items-center">
                                <span class="w-2 h-2 rounded-full bg-[#F59E0B] mr-2"></span>
                                {{ $user->rank }}
                            </span>
                        @elseif($user->rank === 2)
                            <span class="flex items-center">
                                <span class="w-2 h-2 rounded-full bg-[#9CA3AF] mr-2"></span>
                                {{ $user->rank }}
                            </span>
                        @elseif($user->rank === 3)
                            <span class="flex items-center">
                                <span class="w-2 h-2 rounded-full bg-[#D97706] mr-2"></span>
                                {{ $user->rank }}
                            </span>
                        @else
                            {{ $user->rank }}
                        @endif
                    </div>

                    <!-- User -->
                    <div class="flex-1">
                        <a href="/users/{{ $user->username }}" class="font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                            {{ $user->username }}
                        </a>
                        <div class="text-[13px] text-[var(--muted)]">
                            {{ $user->name }}
                        </div>
                    </div>

                    <!-- Articles Count -->
                    <div class="w-20 text-center text-[var(--muted)]">
                        {{ $user->articles_count ?? 0 }}
                    </div>

                    <!-- Best Exam Score -->
                    <div class="w-24 text-center text-[var(--muted)]">
                        {{ $user->best_exam_score ? $user->best_exam_score . '%' : '—' }}
                    </div>

                    <!-- Total Score -->
                    <div class="w-24 text-center font-medium text-[var(--accent)]">
                        {{ $user->total_score ?? 0 }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-[var(--muted)]">No users ranked yet.</p>
    @endif
</div>
@endsection