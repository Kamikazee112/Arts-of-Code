@extends('layouts.app')

@section('title', $category->name . ' - Arts Of Code')

@section('content')
    <div class="max-w-[1000px] mx-auto animate-fade-up">
        
        <!-- Breadcrumb Navigation -->
        <div class="mb-6">
            <div class="flex items-center gap-2">
                <a href="/" class="text-sm font-semibold text-[var(--accent)] hover:underline">Home</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-slate-500">{{ $category->name }}</span>
            </div>
        </div>

        <!-- Category Header & Progress Card -->
        <div class="card p-6 md:p-8 bg-white border border-slate-200/60 shadow-xl rounded-2xl relative overflow-hidden mb-10">
            <!-- Subtle accent top strip -->
            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <div class="flex items-center gap-3.5 mb-2">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;background:var(--accent-light);border-radius:12px;color:var(--accent);">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                        <h1 class="text-[30px] font-extrabold text-[#0f172a] tracking-tight leading-none">{{ $category->name }}</h1>
                    </div>
                    @if($category->description)
                        <p class="text-[14.5px] text-slate-500 leading-relaxed max-w-[580px]">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>

                @if($completionStatus)
                    <!-- Progress Section Block -->
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100 min-w-[240px] md:min-w-[280px]">
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[12.5px] font-bold text-slate-400 uppercase tracking-wider">Progress</span>
                                <span class="text-[14px] font-extrabold text-indigo-600">{{ $completionStatus['percentage'] }}%</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full bg-slate-200 rounded-full h-2.5 shadow-inner">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2.5 rounded-full transition-all duration-300 shadow-sm"
                                    style="width: {{ $completionStatus['percentage'] }}%"></div>
                            </div>
                            <div class="text-[11.5px] text-slate-400 font-semibold mt-1">
                                {{ $completionStatus['completed'] }} of {{ $completionStatus['total'] }} steps completed
                            </div>
                        </div>
                        @if($completionStatus['is_complete'])
                            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full shadow-sm" title="Category Mastered!">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm-2 4h4M8 15h8M8 19h8"/></svg>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Articles Section -->
        @if($articles->count() > 0)
            <div class="mb-10">
                <div class="flex items-center gap-2.5 mb-5">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;background:var(--accent-light);border-radius:8px;color:var(--accent);">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.243.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </span>
                    <h2 class="text-[20px] font-extrabold text-slate-800">
                        Study Guides
                        <span class="text-[13.5px] text-slate-400 font-semibold ml-1">({{ $articles->count() }})</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach($articles as $index => $article)
                        <div class="card card-hover p-5 transition-all duration-300">
                            <div class="flex flex-col sm:flex-row items-start gap-4">
                                <!-- Step Circle -->
                                <div class="flex-shrink-0 w-11 h-11 bg-slate-50 border-2 border-indigo-100 flex items-center justify-center rounded-full text-indigo-600 font-extrabold shadow-sm">
                                    {{ $index + 1 }}
                                </div>

                                <!-- Article Details -->
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                        <a href="/articles/{{ $article->slug }}"
                                            class="text-[17px] font-extrabold text-slate-800 hover:text-[var(--accent)] transition-colors leading-snug">
                                            {{ $article->title }}
                                        </a>
                                        @if(isset($article->is_completed) && $article->is_completed)
                                            <span class="inline-flex items-center justify-center w-4 h-4 bg-emerald-100 rounded-full" title="Completed">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4" class="text-emerald-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Author Metadata -->
                                    <div class="flex flex-wrap items-center gap-3 text-[12.5px] text-slate-400 font-semibold mb-2">
                                        <span class="inline-flex items-center gap-1">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            {{ $article->user->username }}
                                        </span>
                                        <span>•</span>
                                        <span class="inline-flex items-center gap-1">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $article->created_at->diffForHumans() }}
                                        </span>
                                        @if($article->likesCount() > 0)
                                            <span>•</span>
                                            <span class="inline-flex items-center gap-1">
                                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                {{ $article->likesCount() }} likes
                                            </span>
                                        @endif
                                    </div>

                                    @if($article->body)
                                        <p class="text-[13.5px] text-slate-500 leading-relaxed max-w-[700px] line-clamp-2">
                                            {{ Str::limit(strip_tags($article->body), 150) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Buttons (No raw emojis!) -->
                                @auth
                                    <div class="flex-shrink-0 mt-3 sm:mt-0">
                                        @if(isset($article->is_completed) && !$article->is_completed)
                                            <form method="POST" action="/articles/{{ $article->id }}/complete" class="inline">
                                                @csrf
                                                <button type="submit" class="btn-sm font-bold bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 text-indigo-600 px-4 py-2 text-[12px] transition-colors" style="border-radius: 8px;">
                                                    Mark Complete
                                                </button>
                                            </form>
                                        @elseif(isset($article->is_completed) && $article->is_completed)
                                            <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] px-3.5 py-1.5 font-bold uppercase shadow-sm">
                                                Completed
                                            </span>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Exams Section -->
        @if($exams->count() > 0)
            <div class="mb-10">
                <div class="flex items-center gap-2.5 mb-5">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;background:var(--accent-light);border-radius:8px;color:var(--accent);">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </span>
                    <h2 class="text-[20px] font-extrabold text-slate-800">
                        Skill Evaluations
                        <span class="text-[13.5px] text-slate-400 font-semibold ml-1">({{ $exams->count() }})</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach($exams as $index => $exam)
                        <div class="card card-hover p-5 transition-all duration-300">
                            <div class="flex flex-col sm:flex-row items-start gap-4">
                                <!-- Level Number (indexed after study guides) -->
                                <div class="flex-shrink-0 w-11 h-11 bg-slate-50 border-2 border-indigo-100 flex items-center justify-center rounded-full text-indigo-600 font-extrabold shadow-sm">
                                    {{ $articles->count() + $index + 1 }}
                                </div>

                                <!-- Exam Content -->
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                        <a href="/exams/{{ $exam->id }}"
                                            class="text-[17px] font-extrabold text-slate-800 hover:text-[var(--accent)] transition-colors leading-snug">
                                            {{ $exam->title }}
                                        </a>
                                        @if(isset($exam->is_completed) && $exam->is_completed)
                                            <span class="inline-flex items-center justify-center w-4 h-4 bg-emerald-100 rounded-full" title="Completed">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4" class="text-emerald-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Exam Metadata Badges -->
                                    <div class="flex flex-wrap items-center gap-3 text-[12.5px] text-slate-400 font-semibold mb-2">
                                        <span class="inline-flex items-center gap-1">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $exam->questions->count() }} questions
                                        </span>
                                        @if($exam->time_limit)
                                            <span>•</span>
                                            <span class="inline-flex items-center gap-1">
                                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $exam->time_limit }} minutes
                                            </span>
                                        @endif
                                        @if($exam->passing_score)
                                            <span>•</span>
                                            <span class="inline-flex items-center gap-1">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Passing: {{ $exam->passing_score }}%
                                            </span>
                                        @endif
                                    </div>

                                    @if($exam->description)
                                        <p class="text-[13.5px] text-slate-500 leading-relaxed max-w-[700px] line-clamp-2">
                                            {{ Str::limit($exam->description, 150) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Buttons (No raw emojis!) -->
                                @auth
                                    <div class="flex-shrink-0 mt-3 sm:mt-0">
                                        @if(isset($exam->is_completed) && !$exam->is_completed)
                                            <a href="/exams/{{ $exam->id }}/take" class="btn-sm font-bold bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-[12px] transition-colors" style="border-radius: 8px; color: white !important;">
                                                Take Exam
                                            </a>
                                        @elseif(isset($exam->is_completed) && $exam->is_completed)
                                            <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] px-3.5 py-1.5 font-bold uppercase shadow-sm">
                                                Completed
                                            </span>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($articles->count() === 0 && $exams->count() === 0)
            <div class="card p-12 text-center flex flex-col items-center justify-center border-dashed border-2">
                <span class="text-4xl mb-4">📭</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">No Content Yet</h3>
                <p class="text-sm text-[var(--muted)] max-w-sm">This category doesn't have any study guides or exams yet. Check back soon!</p>
            </div>
        @endif
    </div>
@endsection