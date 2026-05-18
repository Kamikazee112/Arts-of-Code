@extends('layouts.app')

@section('title', 'Dashboard - Arts Of Code')

@section('content')
    <div class="max-w-[1000px] mx-auto animate-fade-up">
        
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-[32px] md:text-[36px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-2 flex items-center gap-3">
                Welcome back, {{ auth()->user()->username }}!
                <span class="inline-flex items-center justify-center w-9 h-9 bg-indigo-100 text-indigo-500 rounded-xl animate-pulse">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
            </h1>
            <p class="text-[14.5px] font-semibold text-slate-400">
                Here is a quick look at your progress, activity, and achievements today.
            </p>
        </div>

        <!-- Stats Grid (Analytics Widgets style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Articles Stat Card -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-indigo-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $articlesCount }}
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Published Articles
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quiz Attempts Stat Card -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-purple-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $quizAttemptsCount }}
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Quiz Attempts
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-purple-50 text-purple-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Achievements Stat Card -->
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md hover:shadow-lg transition-all duration-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-cyan-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[38px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-1">
                            {{ $achievementsCount }}
                        </div>
                        <div class="text-[13px] font-extrabold text-slate-400 uppercase tracking-wider">
                            Achievements
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-5">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;background:var(--accent-light);border-radius:8px;color:var(--accent);">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                <h2 class="text-[20px] font-extrabold text-slate-800">Quick Actions</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Write Article -->
                <a href="/articles/create" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                    <div class="flex items-start gap-4">
                        <span class="flex items-center justify-center w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-200">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                Write Article
                            </h3>
                            <p class="text-[13px] font-medium text-slate-400">
                                Share your technical knowledge with the community
                            </p>
                        </div>
                    </div>
                </a>

                @if(auth()->user()->role === 'admin')
                    <!-- Create Question (Admin Tool) -->
                    <a href="/questions/create" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                        <span class="absolute top-3 right-3 text-[10px] font-extrabold bg-rose-50 text-rose-600 border border-rose-100 px-2 py-0.5 rounded-md uppercase tracking-wider">
                            Admin Tool
                        </span>
                        <div class="flex items-start gap-4">
                            <span class="flex items-center justify-center w-10 h-10 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-colors duration-200">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                    Create Question
                                </h3>
                                <p class="text-[13px] font-medium text-slate-400">
                                    Add multiple choice, true/false, or short questions
                                </p>
                            </div>
                        </div>
                    </a>

                    <!-- Create Quiz (Admin Tool) -->
                    <a href="/exams/create" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                        <span class="absolute top-3 right-3 text-[10px] font-extrabold bg-rose-50 text-rose-600 border border-rose-100 px-2 py-0.5 rounded-md uppercase tracking-wider">
                            Admin Tool
                        </span>
                        <div class="flex items-start gap-4">
                            <span class="flex items-center justify-center w-10 h-10 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-colors duration-200">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                    Create Quiz
                                </h3>
                                <p class="text-[13px] font-medium text-slate-400">
                                    Create custom quizzes from available questions
                                </p>
                            </div>
                        </div>
                    </a>
                @endif

                <!-- Take a Quiz -->
                <a href="/exams" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                    <div class="flex items-start gap-4">
                        <span class="flex items-center justify-center w-10 h-10 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-200">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                Take Quiz
                            </h3>
                            <p class="text-[13px] font-medium text-slate-400">
                                Test your coding skills and solve problems
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Browse Articles -->
                <a href="/articles" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                    <div class="flex items-start gap-4">
                        <span class="flex items-center justify-center w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-200">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                Browse Articles
                            </h3>
                            <p class="text-[13px] font-medium text-slate-400">
                                Read technical guides, tutorials, and in-depth articles
                            </p>
                        </div>
                    </div>
                </a>

                <!-- View Achievements -->
                <a href="/achievements" class="card card-hover p-6 bg-white border border-slate-200/60 shadow-sm block relative group">
                    <div class="flex items-start gap-4">
                        <span class="flex items-center justify-center w-10 h-10 bg-cyan-50 text-cyan-600 rounded-xl group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-200">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-[16px] font-extrabold text-slate-800 mb-1 group-hover:text-[var(--accent)] transition-colors">
                                View Achievements
                            </h3>
                            <p class="text-[13px] font-medium text-slate-400">
                                View earned awards, category completion, and status
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity: Your Articles -->
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-5">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;background:var(--accent-light);border-radius:8px;color:var(--accent);">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m2 2a2 2 0 012 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2v-2m-6-1h10m-5-4h5m-5 8h5" />
                    </svg>
                </span>
                <h2 class="text-[20px] font-extrabold text-slate-800">Your Articles</h2>
            </div>
            
            <div class="card p-6 bg-white border border-slate-200/60 shadow-md rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-slate-300"></div>

                @if(auth()->user()->articles()->count() > 0)
                    <div class="space-y-4">
                        @foreach(auth()->user()->articles()->latest()->get() as $article)
                            <div class="p-4 border border-slate-100 rounded-xl hover:bg-slate-50/50 transition-all duration-200">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="flex-1">
                                        <a href="/articles/{{ $article->slug }}"
                                            class="text-[16.5px] font-extrabold text-slate-800 hover:text-[var(--accent)] transition-colors block mb-1">
                                            {{ $article->title }}
                                        </a>
                                        
                                        <div class="flex flex-wrap items-center gap-2.5 text-[12px] font-bold text-slate-400">
                                            <span class="inline-flex items-center gap-1">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $article->created_at->diffForHumans() }}
                                            </span>
                                            <span>•</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-extrabold uppercase border
                                                {{ $article->status === 'published' 
                                                    ? 'bg-emerald-50 text-emerald-600 border-emerald-100' 
                                                    : ($article->status === 'rejected' 
                                                        ? 'bg-rose-50 text-rose-600 border-rose-100' 
                                                        : 'bg-amber-50 text-amber-600 border-amber-100') }}">
                                                {{ $article->status }}
                                            </span>
                                        </div>

                                        @if($article->tags->count() > 0)
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                @foreach($article->tags as $tag)
                                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase px-2 py-0.5 bg-slate-50 border border-slate-200/60 rounded text-slate-500">
                                                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 mt-3 sm:mt-0 flex-shrink-0">
                                        <!-- View Button (Solid Indigo) -->
                                        <a href="/articles/{{ $article->slug }}" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-[12px] transition-all transform active:scale-95 shadow-sm hover:shadow" 
                                            style="border-radius: 8px; color: white !important;">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>

                                        <!-- Edit Button (Solid Sky Blue) -->
                                        <a href="/articles/{{ $article->slug }}/edit" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sky-500 hover:bg-sky-600 text-white font-extrabold text-[12px] transition-all transform active:scale-95 shadow-sm hover:shadow" 
                                            style="border-radius: 8px; color: white !important;">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Delete Button (Solid Rose/Red) -->
                                        <form method="POST" action="/articles/{{ $article->slug }}" onsubmit="return confirm('Are you sure you want to delete this article?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-[12px] transition-all transform active:scale-95 shadow-sm hover:shadow" 
                                                style="border-radius: 8px; color: white !important;">
                                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 flex flex-col items-center">
                        <span class="inline-flex items-center justify-center w-14 h-14 bg-indigo-50 text-indigo-400 rounded-2xl mb-4">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </span>
                        <p class="text-slate-400 font-bold text-sm mb-3">No articles yet.</p>
                        <a href="/articles/create" class="btn-sm font-bold bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2" style="border-radius: 8px; color: white !important;">
                            Write your first article
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection