@extends('layouts.app')

@section('title', 'Admin Dashboard - Arts Of Code')

@section('content')
<div class="max-w-[1000px] mx-auto py-4">
    
    <!-- Admin Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-[26px] font-extrabold text-[var(--text)] tracking-tight leading-none mb-2">Admin Dashboard</h1>
            <p class="text-[13px] text-[var(--muted)]">Manage categories, user profiles, review exams, and moderate articles.</p>
        </div>
        <div class="flex items-center gap-2">
            <!-- Live badge showing current system state -->
            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 border border-emerald-100/60 px-3 py-1.5 rounded-full select-none shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Console Active
            </span>
        </div>
    </div>

    <!-- Stats Grid Row of 5 (Cohesive premium theme) -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-8">
        <!-- Metric 1 -->
        <div class="card p-5 bg-white border border-slate-200/80 shadow-sm rounded-2xl flex flex-col justify-between hover:border-slate-300 hover:shadow transition-all group">
            <div class="flex justify-between items-start mb-3">
                <div class="text-[28px] font-extrabold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors leading-none">
                    {{ $pendingArticles->count() }}
                </div>
                <div class="w-7 h-7 bg-amber-50 text-amber-500 rounded-lg flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-[11.5px] font-bold text-[var(--muted)] uppercase tracking-wider">Pending Articles</div>
        </div>

        <!-- Metric 2 -->
        <div class="card p-5 bg-white border border-slate-200/80 shadow-sm rounded-2xl flex flex-col justify-between hover:border-slate-300 hover:shadow transition-all group">
            <div class="flex justify-between items-start mb-3">
                <div class="text-[28px] font-extrabold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors leading-none">
                    {{ $publishedArticles->count() }}
                </div>
                <div class="w-7 h-7 bg-indigo-50 text-indigo-500 rounded-lg flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-[11.5px] font-bold text-[var(--muted)] uppercase tracking-wider">Published Articles</div>
        </div>

        <!-- Metric 3 -->
        <div class="card p-5 bg-white border border-slate-200/80 shadow-sm rounded-2xl flex flex-col justify-between hover:border-slate-300 hover:shadow transition-all group">
            <div class="flex justify-between items-start mb-3">
                <div class="text-[28px] font-extrabold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors leading-none">
                    {{ \App\Models\User::count() }}
                </div>
                <div class="w-7 h-7 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <div class="text-[11.5px] font-bold text-[var(--muted)] uppercase tracking-wider">Total Users</div>
        </div>

        <!-- Metric 4 -->
        <div class="card p-5 bg-white border border-slate-200/80 shadow-sm rounded-2xl flex flex-col justify-between hover:border-slate-300 hover:shadow transition-all group">
            <div class="flex justify-between items-start mb-3">
                <div class="text-[28px] font-extrabold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors leading-none">
                    {{ \App\Models\Exam::count() }}
                </div>
                <div class="w-7 h-7 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
            </div>
            <div class="text-[11.5px] font-bold text-[var(--muted)] uppercase tracking-wider">Total Exams</div>
        </div>

        <!-- Metric 5 -->
        <div class="card p-5 bg-white border border-slate-200/80 shadow-sm rounded-2xl flex flex-col justify-between hover:border-slate-300 hover:shadow transition-all group">
            <div class="flex justify-between items-start mb-3">
                <div class="text-[28px] font-extrabold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors leading-none">
                    {{ \App\Models\Category::count() }}
                </div>
                <div class="w-7 h-7 bg-rose-50 text-rose-500 rounded-lg flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
            </div>
            <div class="text-[11.5px] font-bold text-[var(--muted)] uppercase tracking-wider">Categories</div>
        </div>
    </div>

    <!-- Quick Actions (Premium Portal Cards) -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </span>
            <h3 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Quick Actions</h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <!-- Action 1 -->
            <a href="/admin/categories" class="card p-5 hover:border-[var(--accent)] hover:shadow-sm transition-all block group bg-white border border-slate-100 rounded-2xl">
                <div class="flex items-center justify-center w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl mb-3.5 group-hover:bg-[var(--accent)] group-hover:text-white transition-colors shadow-inner">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
                <div class="text-[14.5px] font-bold text-[var(--text)] mb-0.5 group-hover:text-[var(--accent)] transition-colors leading-snug">Categories</div>
                <div class="text-[11px] text-[var(--muted)] leading-tight">Create and edit paths</div>
            </a>

            <!-- Action 2 -->
            <a href="/admin/users" class="card p-5 hover:border-[var(--accent)] hover:shadow-sm transition-all block group bg-white border border-slate-100 rounded-2xl">
                <div class="flex items-center justify-center w-10 h-10 bg-purple-50 text-purple-600 rounded-xl mb-3.5 group-hover:bg-[var(--accent)] group-hover:text-white transition-colors shadow-inner">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div class="text-[14.5px] font-bold text-[var(--text)] mb-0.5 group-hover:text-[var(--accent)] transition-colors leading-snug">Users</div>
                <div class="text-[11px] text-[var(--muted)] leading-tight">Promote or manage members</div>
            </a>

            <!-- Action 3 -->
            <a href="/questions/create" class="card p-5 hover:border-[var(--accent)] hover:shadow-sm transition-all block group bg-white border border-slate-100 rounded-2xl">
                <div class="flex items-center justify-center w-10 h-10 bg-rose-50 text-rose-600 rounded-xl mb-3.5 group-hover:bg-[var(--accent)] group-hover:text-white transition-colors shadow-inner">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-[14.5px] font-bold text-[var(--text)] mb-0.5 group-hover:text-[var(--accent)] transition-colors leading-snug">New Question</div>
                <div class="text-[11px] text-[var(--muted)] leading-tight">Add new quiz questions</div>
            </a>

            <!-- Action 4 -->
            <a href="/exams/create" class="card p-5 hover:border-[var(--accent)] hover:shadow-sm transition-all block group bg-white border border-slate-100 rounded-2xl">
                <div class="flex items-center justify-center w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl mb-3.5 group-hover:bg-[var(--accent)] group-hover:text-white transition-colors shadow-inner">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div class="text-[14.5px] font-bold text-[var(--text)] mb-0.5 group-hover:text-[var(--accent)] transition-colors leading-snug">New Exam</div>
                <div class="text-[11px] text-[var(--muted)] leading-tight">Build new exam papers</div>
            </a>

            <!-- Action 5 -->
            <a href="/admin/dashboard" class="card p-5 hover:border-[var(--accent)] hover:shadow-sm transition-all block group bg-white border border-slate-100 rounded-2xl">
                <div class="flex items-center justify-center w-10 h-10 bg-slate-100 text-slate-600 rounded-xl mb-3.5 group-hover:bg-[var(--accent)] group-hover:text-white transition-colors shadow-inner">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div class="text-[14.5px] font-bold text-[var(--text)] mb-0.5 group-hover:text-[var(--accent)] transition-colors leading-snug">Metrics Board</div>
                <div class="text-[11px] text-[var(--muted)] leading-tight">View metrics and analytics</div>
            </a>
        </div>
    </div>

    <!-- Pending Articles Section -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </span>
            <h3 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Pending Articles Queue</h3>
        </div>

        @if($pendingArticles->count() > 0)
            <div class="space-y-4">
                @foreach($pendingArticles as $article)
                    <div class="card p-5 bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:border-slate-300 transition-all relative overflow-hidden">
                        <!-- Left colored stripe -->
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500"></div>

                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-[16px] font-bold text-[var(--text)] mb-1 leading-snug">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-[12px] text-[var(--muted)] mb-3 font-medium flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-[10px] text-slate-700 font-extrabold uppercase">{{ substr($article->user->username, 0, 1) }}</span>
                                    by <strong class="text-slate-700">{{ $article->user->username }}</strong> · {{ $article->created_at->diffForHumans() }}
                                </p>
                                <p class="text-[13.5px] text-[var(--text-2)] leading-relaxed line-clamp-2 max-w-2xl bg-slate-50/50 p-3 rounded-xl border border-slate-100">
                                    {{ Str::limit(strip_tags($article->body), 160) }}
                                </p>
                                @if($article->tags->count() > 0)
                                    <div class="mt-3 flex flex-wrap gap-1.5">
                                        @foreach($article->tags as $tag)
                                            <span class="text-[10px] font-bold text-slate-500 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-full">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Action buttons -->
                            <div class="flex flex-wrap md:flex-nowrap items-center gap-2 mt-2 md:mt-0 flex-shrink-0">
                                <a href="/articles/{{ $article->slug }}" target="_blank" class="btn-outline px-4 py-2 text-xs font-semibold flex items-center gap-1 bg-white border-slate-200 text-slate-700 hover:bg-slate-50/80 rounded-xl transition-all shadow-sm">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Preview
                                </a>
                                
                                <form method="POST" action="/admin/articles/{{ $article->slug }}/approve" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-primary px-4 py-2 text-xs font-bold text-white bg-emerald-600 border border-emerald-700 hover:bg-emerald-700 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        Approve
                                    </button>
                                </form>
                                
                                <form method="POST" action="/admin/articles/{{ $article->slug }}/reject" class="inline" onsubmit="return confirm('Are you sure you want to reject this article?');">
                                    @csrf
                                    <button type="submit" class="btn-danger px-4 py-2 text-xs font-bold text-white bg-rose-500 border border-rose-600 hover:bg-rose-600 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Beautiful empty reviews vector box -->
            <div class="card p-8 text-center bg-slate-50/50 border-dashed border-slate-200/80 rounded-2xl">
                <div class="w-12 h-12 bg-white text-slate-400 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h4 class="text-[14px] font-bold text-[var(--text)] mb-1">All reviewed!</h4>
                <p class="text-[12.5px] text-[var(--muted)] max-w-xs mx-auto leading-relaxed">
                    No pending articles to review right now. Good job!
                </p>
            </div>
        @endif
    </div>

    <!-- Recent Published Articles (List Overhaul) -->
    <div>
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></span>
            <h3 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Recently Published Articles</h3>
        </div>

        @if($publishedArticles->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($publishedArticles as $article)
                    <a href="/articles/{{ $article->slug }}" class="card p-5 bg-white border border-slate-100 hover:border-[var(--accent)] hover:shadow-sm transition-all rounded-2xl block group relative overflow-hidden">
                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-50 to-slate-100 border border-slate-200/50 flex items-center justify-center text-slate-700 font-extrabold text-sm shadow-inner group-hover:scale-105 transition-transform duration-200">
                                {{ strtoupper(substr($article->user->username, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-[14.5px] font-bold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors truncate leading-snug mb-1">
                                    {{ $article->title }}
                                </h4>
                                <p class="text-[12px] text-[var(--muted)] font-medium flex items-center gap-1">
                                    <span>by <strong class="text-slate-600">{{ $article->user->username }}</strong></span>
                                    <span>·</span>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                            <div class="text-slate-300 group-hover:text-[var(--accent)] transition-colors flex-shrink-0 ml-1 mt-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 duration-200 transform">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card p-8 text-center bg-slate-50/50 border-dashed border-slate-200/80 rounded-2xl">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400 mx-auto mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <h4 class="text-[14px] font-bold text-[var(--text)] mb-1">No articles yet</h4>
                <p class="text-[12px] text-[var(--muted)] leading-relaxed">
                    No published articles in the library yet.
                </p>
            </div>
        @endif
    </div>

</div>
@endsection