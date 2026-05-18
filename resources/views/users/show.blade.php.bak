@extends('layouts.app')

@section('title', $user->username . ' - Profile')

@section('content')
<div class="max-w-4xl mx-auto py-4">
    
    <!-- Profile Card Container -->
    <div class="card overflow-hidden mb-8 relative border border-slate-200/80 shadow-sm bg-white">
        <!-- Elegant Dual-Tone Cover: Blue split vertically down the middle -->
        <div class="h-36 border-b border-slate-100 relative overflow-hidden" style="background: linear-gradient(90deg, #3b82f6 50%, #f8fafc 50%);">
            <!-- Subtle modern mesh/grid pattern overlay -->
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 18px 18px;"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-white/10 to-transparent"></div>

            <!-- Floating White Username and Role Badge exactly in the blue box (Desktop only) -->
            <div class="absolute bottom-4 left-[152px] z-20 text-left hidden md:flex flex-col gap-1.5">
                <h1 class="text-[26px] font-extrabold text-white tracking-tight leading-none">
                    {{ $user->username }}
                </h1>
                <div class="flex items-center gap-2">
                    @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider text-white bg-white/25 border border-white/30 px-2.5 py-0.5 rounded-full backdrop-blur-sm shadow-sm select-none">
                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Admin
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider text-white bg-white/25 border border-white/30 px-2.5 py-0.5 rounded-full backdrop-blur-sm shadow-sm select-none">
                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Coder
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Header Info Overlay -->
        <div class="px-6 pb-6 pt-0 md:px-8 flex flex-col md:flex-row items-center md:items-end gap-6 -mt-16 relative z-10 text-center md:text-left">
            <!-- Circular Avatar with double border shadow -->
            <div class="w-28 h-28 rounded-full bg-white p-1 shadow-md flex-shrink-0 border border-slate-100">
                <div class="w-full h-full rounded-full bg-gradient-to-tr from-slate-50 to-slate-100 border border-slate-200/60 flex items-center justify-center text-[var(--accent)] font-extrabold text-[36px] shadow-inner">
                    {{ strtoupper(substr($user->username, 0, 1)) }}
                </div>
            </div>

            <!-- Profile Info Details -->
            <div class="flex-1 mb-2">
                <!-- Mobile Username and Role Badge (Visible only on Mobile) -->
                <div class="flex md:hidden flex-col items-center gap-2 mb-2">
                    <h1 class="text-[24px] font-extrabold text-[var(--text)] tracking-tight leading-none">
                        {{ $user->username }}
                    </h1>
                    @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 border border-indigo-100/60 px-3 py-1 rounded-full">
                            Admin
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-600 bg-slate-50 border border-slate-200/80 px-3 py-1 rounded-full">
                            Coder
                        </span>
                    @endif
                </div>
                
                <!-- Joined date (Desktop/Mobile responsive margin) -->
                <p class="text-[13px] text-[var(--muted)] flex items-center justify-center md:justify-start gap-1.5 font-medium mt-1 md:mt-2">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Joined {{ $user->created_at->format('F Y') }}
                </p>
            </div>

            <!-- Edit Profile Quick Action (Own Profile Only) -->
            @if(auth()->check() && $user->id === auth()->id())
                <div class="mb-2">
                    <a href="/settings" class="btn-outline border-slate-200 hover:border-slate-300 text-slate-700 bg-white hover:bg-slate-50/50 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm flex items-center gap-2">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Edit Profile
                    </a>
                </div>
            @endif
        </div>

        @if($user->profile && $user->profile->bio)
            <div class="px-6 pb-6 md:px-8 border-t border-slate-100 pt-5 bg-slate-50/30">
                <h4 class="text-[12px] font-bold uppercase tracking-wider text-slate-400 mb-2">About Me</h4>
                <p class="text-[14px] text-[var(--text-2)] leading-relaxed italic bg-white p-4 rounded-xl border border-slate-100/80 shadow-sm">
                    "{{ $user->profile->bio }}"
                </p>
            </div>
        @endif
    </div>

    <!-- Analytics Dashboard Widgets (Stats Row - Unified Palette) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <!-- Articles Metric -->
        <div class="card p-6 flex items-center justify-between border border-slate-100 hover:border-slate-200 transition-all bg-white shadow-sm">
            <div>
                <div class="text-[30px] font-extrabold text-[var(--text)] tracking-tight leading-none mb-1">
                    {{ $user->articles()->count() }}
                </div>
                <div class="text-[12px] font-bold text-[var(--muted)] uppercase tracking-wider">
                    Articles Written
                </div>
            </div>
            <div class="w-12 h-12 bg-indigo-50/50 text-[var(--accent)] rounded-xl flex items-center justify-center shadow-inner">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>

        <!-- Quiz Attempts Metric -->
        <div class="card p-6 flex items-center justify-between border border-slate-100 hover:border-slate-200 transition-all bg-white shadow-sm">
            <div>
                <div class="text-[30px] font-extrabold text-[var(--text)] tracking-tight leading-none mb-1">
                    {{ $user->quizAttempts()->count() }}
                </div>
                <div class="text-[12px] font-bold text-[var(--muted)] uppercase tracking-wider">
                    Quiz Attempts
                </div>
            </div>
            <div class="w-12 h-12 bg-indigo-50/50 text-[var(--accent)] rounded-xl flex items-center justify-center shadow-inner">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Achievements Metric -->
        <div class="card p-6 flex items-center justify-between border border-slate-100 hover:border-slate-200 transition-all bg-white shadow-sm">
            <div>
                <div class="text-[30px] font-extrabold text-[var(--text)] tracking-tight leading-none mb-1">
                    {{ $user->achievements()->count() }}
                </div>
                <div class="text-[12px] font-bold text-[var(--muted)] uppercase tracking-wider">
                    Badges Unlocked
                </div>
            </div>
            <div class="w-12 h-12 bg-indigo-50/50 text-[var(--accent)] rounded-xl flex items-center justify-center shadow-inner">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Left Column: Badges Case (Subtle Trophy Icons instead of raw emojis) -->
        <div class="md:col-span-1">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                </span>
                <h3 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Badges Case</h3>
            </div>

            @if($user->achievements->count() > 0)
                <div class="space-y-3">
                    @foreach($user->achievements as $ach)
                        <a href="/achievements/{{ $ach->id }}" class="card p-3.5 flex items-center gap-3.5 hover:border-indigo-200 group bg-white shadow-sm transition-all border border-slate-100">
                            <!-- Clean SVG Golden Badge instead of system emoji -->
                            <div class="w-10 h-10 bg-amber-50/60 border border-amber-100/60 text-amber-500 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-200 shadow-sm">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-[13px] font-bold text-[var(--text)] truncate leading-none mb-1 group-hover:text-[var(--accent)] transition-colors">{{ $ach->name }}</h4>
                                <p class="text-[11px] text-[var(--muted)] truncate">{{ $ach->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="card p-6 text-center bg-slate-50/50 border-dashed border-slate-200">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400 mx-auto mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <h4 class="text-[13px] font-bold text-[var(--text)] mb-1">No Badges Locked</h4>
                    <p class="text-[11px] text-[var(--muted)] leading-relaxed">
                        Complete paths and quizzes to unlock custom badges here!
                    </p>
                </div>
            @endif
        </div>

        <!-- Right Column: Articles Authored -->
        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </span>
                <h3 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Articles Authored</h3>
            </div>

            @if($user->articles()->count() > 0)
                <div class="space-y-4">
                    @foreach($user->articles as $article)
                        <div class="card p-5 hover:border-slate-200 transition-all relative overflow-hidden group bg-white border border-slate-100 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <a href="/articles/{{ $article->slug }}" class="text-[15.5px] font-bold text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-1.5 leading-snug">
                                        {{ $article->title }}
                                    </a>
                                    
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[12px] text-[var(--muted)]">
                                        <span>Published {{ $article->created_at->diffForHumans() }}</span>
                                        <span>·</span>
                                        @if($article->status === 'published')
                                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100/60 px-2 py-0.5 rounded-full">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-amber-600 bg-amber-50 border border-amber-100/60 px-2 py-0.5 rounded-full">
                                                {{ ucfirst($article->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="/articles/{{ $article->slug }}" class="text-slate-400 hover:text-[var(--accent)] transition-colors flex-shrink-0 mt-1 opacity-0 group-hover:opacity-100">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card p-8 text-center bg-slate-50/50 border-dashed border-slate-200">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400 mx-auto mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <h3 class="text-[14px] font-bold text-[var(--text)] mb-1">No Articles Published</h3>
                    <p class="text-[12.5px] text-[var(--muted)] max-w-xs mx-auto leading-relaxed mb-4">
                        This coder has not authored any articles on the platform yet.
                    </p>
                    @if(auth()->check() && $user->id === auth()->id())
                        <a href="/articles/create" class="btn-primary">
                            Write Your First Article
                        </a>
                    @endif
                </div>
            @endif
        </div>

    </div>
</div>
@endsection