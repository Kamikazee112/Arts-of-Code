@extends('layouts.app')

@section('title', $achievement->name . ' - Achievement')

@section('content')
<div class="max-w-3xl mx-auto py-4">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/achievements" class="inline-flex items-center gap-1.5 text-sm text-[var(--muted)] hover:text-[var(--accent)] font-medium transition-colors">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Achievements
        </a>
    </div>

    <!-- Achievement Header Card -->
    <div class="card p-8 mb-6 relative overflow-hidden group">
        <!-- Subtle glowing decorative background element -->
        <div class="absolute -right-20 -top-20 w-48 h-48 bg-indigo-50/50 rounded-full blur-3xl group-hover:bg-indigo-100/50 transition-all duration-700"></div>
        
        <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6 relative z-10">
            <!-- Glowing Trophy/Icon Badge -->
            <div class="flex-shrink-0 inline-flex items-center justify-center w-24 h-24 bg-gradient-to-tr from-amber-50 to-yellow-50 text-amber-500 rounded-3xl border border-amber-100 shadow-md transform group-hover:scale-105 transition-transform duration-300">
                @if($achievement->icon)
                    <span class="text-4xl filter drop-shadow-sm">{{ $achievement->icon }}</span>
                @else
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" class="text-amber-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                @endif
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row items-center gap-3 mb-2">
                    <h1 class="text-[26px] font-extrabold text-[var(--text)] tracking-tight">{{ $achievement->name }}</h1>
                    @if($hasEarned)
                        <span class="inline-flex items-center gap-1 text-[12px] font-bold bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full border border-emerald-100">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            ✓ Earned
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[12px] font-bold bg-slate-50 text-slate-500 px-3 py-1 rounded-full border border-slate-200">
                            <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                            Locked
                        </span>
                    @endif
                </div>
                <p class="text-[14.5px] text-[var(--muted)] mb-4 max-w-xl leading-relaxed">
                    {{ $achievement->description }}
                </p>
                @if($achievement->category)
                    <div class="text-[13px] font-semibold text-[var(--muted)] flex items-center justify-center md:justify-start gap-1">
                        <span>Category:</span>
                        <a href="/categories/{{ $achievement->category->slug }}" class="text-[var(--accent)] hover:underline flex items-center gap-0.5">
                            {{ $achievement->category->name }}
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- How to Earn -->
    @if($achievement->category)
        <div class="card p-6 md:p-8 mb-6 relative overflow-hidden">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-indigo-50 text-[var(--accent)] rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-[17px] font-bold text-[var(--text)] mb-1">Requirement</h2>
                    <p class="text-[14px] text-[var(--muted)] leading-relaxed mb-4">
                        To claim this badge, you must complete all articles and conquer all exams in the <strong class="text-[var(--text)]">{{ $achievement->category->name }}</strong> category.
                    </p>
                    <a href="/categories/{{ $achievement->category->slug }}" class="btn-primary">
                        Go to {{ $achievement->category->name }} Path
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Recent Earners -->
    @if($earners->count() > 0)
        <div class="card p-6 md:p-8">
            <h2 class="text-[17px] font-bold text-[var(--text)] mb-5 flex items-center gap-2">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-[var(--accent)]"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Platform Earners
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($earners as $earner)
                    <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-slate-100/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-[var(--accent)] flex items-center justify-center text-white font-extrabold shadow-sm">
                                {{ strtoupper(substr($earner->username, 0, 1)) }}
                            </div>
                            <div>
                                <a href="/users/{{ $earner->id }}" class="text-[14px] font-bold text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                                    {{ $earner->username }}
                                </a>
                                <div class="text-[11.5px] text-[var(--muted)] mt-0.5">
                                    Earned {{ \Carbon\Carbon::parse($earner->awarded_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="card p-8 text-center bg-slate-50/50 border-dashed">
            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h2 class="text-[16px] font-bold text-[var(--text)] mb-1">No Earners Yet</h2>
            <p class="text-[13.5px] text-[var(--muted)] max-w-xs mx-auto leading-relaxed">
                Be the absolute first coder to unlock this premium achievement!
            </p>
        </div>
    @endif
</div>
@endsection