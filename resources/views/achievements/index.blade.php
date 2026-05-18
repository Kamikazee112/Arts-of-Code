@extends('layouts.app')

@section('title', 'Achievements - Arts Of Code')

@section('content')
    <div class="max-w-[1000px] mx-auto animate-fade-up">
        
        <!-- Breadcrumb Navigation -->
        <div class="mb-6">
            <div class="flex items-center gap-2">
                <a href="/" class="text-sm font-semibold text-[var(--accent)] hover:underline">الرئيسية</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-slate-500">Achievements</span>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-[32px] md:text-[36px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-2 flex items-center gap-3">
                Trophy Room
                <span class="inline-flex items-center justify-center w-9 h-9 bg-cyan-100 text-cyan-600 rounded-xl">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                </span>
            </h1>
            <p class="text-[14.5px] font-semibold text-slate-400">
                Track your learning progress, complete categories, and earn premium mastery badges!
            </p>
        </div>

        <!-- Stats Overview (Premium Widgets) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Achievements Earned -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-cyan-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $earnedCount }}
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Earned Badges
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Achievements -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-indigo-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $totalAchievements }}
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Total Badges
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completion Rate -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-emerald-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $completionPercentage }}%
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Completion Rate
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Progress Card -->
        <div class="card p-6 bg-white border border-slate-200/60 shadow-lg rounded-2xl relative overflow-hidden mb-10">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[13.5px] font-extrabold text-slate-800 uppercase tracking-wider">Overall Progress</span>
                <span class="text-[13px] font-extrabold text-indigo-600 bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-full shadow-sm">{{ $earnedCount }} / {{ $totalAchievements }} Completed</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-3 shadow-inner">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full transition-all duration-300 shadow-sm"
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

                <div class="mb-10">
                    <!-- Category Header -->
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-[20px] font-extrabold text-slate-800">
                            {{ $category ? $category->name : 'General' }}
                        </h2>
                        <span class="text-[13px] font-bold text-slate-400 bg-slate-50 border border-slate-200 px-3 py-1 rounded-lg">
                            {{ $earnedInCategory }} / {{ $totalInCategory }} earned
                        </span>
                    </div>

                    <!-- Category Progress Bar -->
                    <div class="w-full bg-slate-100 rounded-full h-1.5 mb-5 shadow-inner">
                        <div class="bg-[var(--accent)] h-1.5 rounded-full transition-all duration-300 shadow-sm"
                            style="width: {{ $categoryProgress }}%"></div>
                    </div>

                    <!-- Achievements Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($achievements as $achievement)
                            @php
                                $isEarned = $earnedAchievements->contains('id', $achievement->id);
                            @endphp

                            <div class="card p-5 transition-all duration-300 group rounded-xl relative
                                {{ $isEarned 
                                    ? 'border border-emerald-200 bg-emerald-50/20 shadow-md' 
                                    : 'border border-slate-200/50 bg-white/60 opacity-75 shadow-sm' }}"
                            >
                                <div class="flex items-start gap-4">
                                    <!-- Badge Icon Container -->
                                    <div class="flex-shrink-0 flex items-center justify-center w-14 h-14 rounded-xl shadow-sm transition-transform duration-300 group-hover:scale-110
                                        {{ $isEarned 
                                            ? 'bg-emerald-50 border border-emerald-100 text-emerald-600' 
                                            : 'bg-slate-100 border border-slate-200 text-slate-400 grayscale' }}"
                                    >
                                        @if($achievement->icon && !preg_match('/[\x{1F000}-\x{1FFFF}]/u', $achievement->icon))
                                            {{ $achievement->icon }}
                                        @else
                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-[15.5px] font-extrabold text-slate-800 leading-snug mb-1 truncate">
                                            {{ $achievement->name }}
                                        </h3>
                                        <p class="text-[13px] text-slate-400 leading-relaxed mb-3 line-clamp-2">
                                            {{ $achievement->description }}
                                        </p>
                                        
                                        @if($isEarned)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase bg-emerald-500 text-white border border-emerald-600/10 shadow-sm">
                                                <svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                Earned
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase bg-slate-100 text-slate-400 border border-slate-200">
                                                <svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
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
            <!-- Empty Room State -->
            <div class="card p-12 text-center flex flex-col items-center justify-center border-dashed border-2">
                <span class="inline-flex items-center justify-center w-16 h-16 bg-cyan-50 text-cyan-400 rounded-2xl mb-4">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                </span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">No Achievements Yet</h3>
                <p class="text-sm text-[var(--muted)] max-w-sm">Complete categories to earn premium badges and claim your bragging rights!</p>
            </div>
        @endif
    </div>
@endsection