@extends('layouts.app')

@section('title', 'Achievements - Arts Of Code')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[28px] font-medium text-[var(--text)] mb-2">Achievements</h1>
        <p class="text-[14px] text-[var(--muted)]">
            Track your progress and earn badges by completing categories
        </p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $earnedCount }}</div>
            <div class="text-[13px] text-[var(--muted)]">Achievements Earned</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-[var(--text)] mb-2">{{ $totalAchievements }}</div>
            <div class="text-[13px] text-[var(--muted)]">Total Achievements</div>
        </div>
        <div class="card p-6">
            <div class="text-[32px] font-medium text-green-600 mb-2">{{ $completionPercentage }}%</div>
            <div class="text-[13px] text-[var(--muted)]">Completion Rate</div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-2">
            <span class="text-[14px] font-medium text-[var(--text)]">Overall Progress</span>
            <span class="text-[14px] text-[var(--muted)]">{{ $earnedCount }} / {{ $totalAchievements }}</span>
        </div>
        <div class="w-full bg-[var(--border)] rounded-full h-3">
            <div class="bg-[var(--accent)] h-3 rounded-full transition-all duration-300"
                 style="width: {{ $completionPercentage }}%"></div>
        </div>
    </div>

    <!-- Achievements by Category -->
    @if($achievementsByCategory->count() > 0)
        @foreach($achievementsByCategory as $categoryId => $achievements)
            @php
                $category = $achievements->first()->category;
                $earnedInCategory = $earnedAchievements->where('category_id', $categoryId)->count();
                $totalInCategory = $achievements->count();
                $categoryProgress = $totalInCategory > 0 ? round(($earnedInCategory / $totalInCategory) * 100, 1) : 0;
            @endphp

            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[20px] font-medium text-[var(--text)]">
                        {{ $category ? $category->name : 'General' }}
                    </h2>
                    <span class="text-[14px] text-[var(--muted)]">
                        {{ $earnedInCategory }} / {{ $totalInCategory }} earned
                    </span>
                </div>

                <!-- Category Progress -->
                <div class="mb-4">
                    <div class="w-full bg-[var(--border)] rounded-full h-2">
                        <div class="bg-[var(--accent)] h-2 rounded-full transition-all duration-300"
                             style="width: {{ $categoryProgress }}%"></div>
                    </div>
                </div>

                <!-- Achievements Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($achievements as $achievement)
                        @php
                            $isEarned = $earnedAchievements->contains('id', $achievement->id);
                        @endphp

                        <div class="card p-4 {{ $isEarned ? 'border-l-4 border-l-green-500' : 'opacity-60' }}">
                            <div class="flex items-start gap-3">
                                <div class="text-[32px]">{{ $achievement->icon ?? '🏆' }}</div>
                                <div class="flex-1">
                                    <h3 class="text-[16px] font-medium text-[var(--text)] mb-1">
                                        {{ $achievement->name }}
                                    </h3>
                                    <p class="text-[13px] text-[var(--muted)] mb-2">
                                        {{ $achievement->description }}
                                    </p>
                                    @if($isEarned)
                                        <span class="text-[12px] bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                            ✓ Earned
                                        </span>
                                    @else
                                        <span class="text-[12px] bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded-full">
                                            Not Earned
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-12">
            <div class="text-[48px] mb-4">🏆</div>
            <h3 class="text-[18px] font-medium text-[var(--text)] mb-2">No Achievements Yet</h3>
            <p class="text-[14px] text-[var(--muted)]">
                Complete categories to earn achievements and track your progress!
            </p>
        </div>
    @endif
</div>
@endsection