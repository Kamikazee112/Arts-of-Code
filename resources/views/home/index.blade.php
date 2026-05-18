@extends('layouts.app')

@section('title', 'Home - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto py-4 relative">

    <!-- Subtle Premium Hero Background Glow -->
    <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-gradient-to-tr from-indigo-500/5 to-purple-500/5 blur-[80px] rounded-full pointer-events-none -z-10"></div>

    <!-- Hero Section -->
    <section class="py-12 md:py-16 text-center md:text-left relative">
        <div class="mb-4 inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50/80 border border-indigo-100/60 rounded-full text-[11px] font-extrabold text-indigo-600 uppercase tracking-widest backdrop-blur-sm select-none">
            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
            Community Platform for Coders
        </div>
        <h1 class="text-[38px] md:text-[48px] font-extrabold text-[var(--text)] leading-[1.1] tracking-tight mb-4 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 bg-clip-text text-transparent">
            Arts Of Code
        </h1>
        <p class="text-[16px] md:text-[17px] text-[var(--muted)] mb-8 max-w-[540px] leading-relaxed mx-auto md:mx-0 font-medium">
            A premium developer collective for problem solvers, software architects, and competitive programmers. Learn, share, and grow together.
        </p>

        @guest
            <div class="flex flex-wrap justify-center md:justify-start gap-3.5">
                <a href="/register" class="btn-primary px-6 py-3 text-sm font-bold text-white bg-[var(--accent)] hover:bg-[var(--accent-hover)] rounded-xl shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Get Started
                </a>
                <a href="/articles" class="btn-outline px-6 py-3 text-sm font-bold text-slate-700 bg-white border-slate-200/80 hover:border-slate-300 rounded-xl hover:-translate-y-0.5 transition-all shadow-sm flex items-center gap-2">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Browse Articles
                </a>
            </div>
        @endguest

        @auth
            <div class="flex flex-wrap justify-center md:justify-start gap-3.5 items-center">
                <a href="/articles/create" class="btn-primary px-6 py-3 text-sm font-bold text-white bg-[var(--accent)] hover:bg-[var(--accent-hover)] rounded-xl shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Write Article
                </a>
                <a href="/exams" class="btn-outline px-6 py-3 text-sm font-bold text-slate-700 bg-white border-slate-200/80 hover:border-slate-300 rounded-xl hover:-translate-y-0.5 transition-all shadow-sm">Take Quiz</a>
                <span class="text-[13px] text-[var(--muted)] hidden sm:inline ml-2 font-medium">
                    Welcome back, <a href="/dashboard" class="font-extrabold text-[var(--accent)] hover:underline">{{ auth()->user()->username }}</a>
                </span>
            </div>
        @endauth
    </section>

    <!-- Divider -->
    <div class="border-t border-slate-100 mb-10"></div>

    <!-- Recent Articles Section -->
    <section class="mb-12">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4h2a2 2 0 012 2v6a2 2 0 01-2 2h-2M9 9h.01M9 13h.01M9 17h.01"/></svg>
                </span>
                <h2 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Recent Developer Feed</h2>
            </div>
            <a href="/articles" class="text-[12px] text-[var(--accent)] font-bold hover:text-[var(--accent-hover)] flex items-center gap-1 transition-colors select-none">
                All Articles
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if(isset($articles) && $articles->count() > 0)
            <div class="space-y-4">
                @foreach($articles as $article)
                    <div class="card p-5 bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-sm transition-all rounded-2xl relative overflow-hidden group">
                        <div class="flex items-start gap-4">
                            <!-- Initials Avatar Circle -->
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-slate-50 to-slate-100 border border-slate-200/50 flex items-center justify-center text-slate-700 font-extrabold text-sm shadow-inner group-hover:scale-105 transition-transform duration-200">
                                {{ strtoupper(substr($article->user->username, 0, 1)) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <a href="/articles/{{ $article->slug }}"
                                    class="text-[16px] font-bold text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-1.5 leading-snug">
                                    {{ $article->title }}
                                </a>
                                
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[12px] text-[var(--muted)] font-medium">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $article->user->username }}
                                    </span>
                                    <span class="text-slate-300 select-none">·</span>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                    
                                    @if($article->tags->count() > 0)
                                        <span class="text-slate-300 select-none">·</span>
                                        <div class="flex items-center gap-1.5">
                                            @foreach($article->tags->take(2) as $tag)
                                                <span class="text-[10px] font-bold text-[var(--accent)] bg-indigo-50 border border-indigo-100/50 px-2 py-0.5 rounded-full">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($article->comments->count() > 0)
                                        <span class="text-slate-300 select-none">·</span>
                                        <span class="flex items-center gap-1 text-slate-500">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                            {{ $article->comments->count() }} {{ Str::plural('comment', $article->comments->count()) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <a href="/articles/{{ $article->slug }}" class="text-slate-300 group-hover:text-[var(--accent)] transition-colors flex-shrink-0 mt-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 duration-200 transform">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card p-8 text-center bg-slate-50/50 border-dashed border-slate-200/80 rounded-2xl">
                <p class="text-[var(--muted)] text-sm">No articles published yet.</p>
            </div>
        @endif
    </section>

    <!-- Categories Section -->
    <section>
        <div class="flex items-center gap-2 mb-5">
            <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 rounded-lg">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </span>
            <h2 class="text-[11.5px] uppercase tracking-[0.1em] text-[var(--muted)] font-bold">Learning Paths</h2>
        </div>

        @php
            $categories = \App\Models\Category::withCount(['articles', 'exams'])->get();
        @endphp

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($categories as $category)
                    <a href="/categories/{{ $category->slug }}"
                        class="card p-5 bg-white border border-slate-100 hover:border-[var(--accent)] hover:shadow-sm transition-all group flex items-center gap-4 rounded-2xl">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-indigo-50/70 text-indigo-600 rounded-xl flex-shrink-0 group-hover:bg-[var(--accent)] group-hover:text-white transition-all shadow-inner">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </span>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-[14.5px] font-bold text-[var(--text)] group-hover:text-[var(--accent)] transition-colors mb-0.5 truncate leading-snug">{{ $category->name }}</h3>
                            <p class="text-[12px] text-[var(--muted)] font-medium">
                                {{ $category->articles_count }} {{ Str::plural('article', $category->articles_count) }}
                                · {{ $category->exams_count }} {{ Str::plural('quiz', $category->exams_count) }}
                            </p>
                        </div>
                        <svg width="14" height="14" class="text-slate-300 group-hover:text-[var(--accent)] group-hover:translate-x-0.5 transition-all flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card p-8 text-center bg-slate-50/50 border-dashed border-slate-200/80 rounded-2xl">
                <p class="text-[var(--muted)] text-sm">No categories available yet.</p>
            </div>
        @endif
    </section>

</div>
@endsection