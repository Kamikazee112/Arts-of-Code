@extends('layouts.app')

@section('title', 'Exams - Arts Of Code')

@section('content')
    <div class="max-w-[900px] mx-auto animate-fade-up">

        <!-- Page Title Row -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10 pb-6 border-b border-[var(--border)]">
            <div>
                <div class="flex items-center gap-3.5 mb-1.5">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--accent-light);border-radius:10px;color:var(--accent);">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </span>
                    <h1 class="text-[26px] font-bold text-[var(--text)] tracking-tight">Quizzes & Challenges</h1>
                </div>
                <p class="text-[14.5px] text-[var(--muted)]">
                    @if(auth()->user()->role === 'admin')
                        Manage challenges, view scores, and create new testing materials.
                    @else
                        Challenge yourself, unlock achievements, and measure your coding skills.
                    @endif
                </p>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="/exams/create" class="btn-primary" style="padding: 10px 20px; font-size: 13.5px; border-radius: 10px;">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Quiz
                    </a>
                @endif
            @endauth
        </div>

        <!-- My Quizzes (Admin Only) -->
        @auth
            @if(auth()->user()->role === 'admin' && isset($myExams) && $myExams->count() > 0)
                <div class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                        <h2 class="text-[14px] font-bold uppercase tracking-[0.08em] text-[var(--text)]">My Admin Quizzes</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach($myExams as $exam)
                            <div class="card card-hover p-6 relative overflow-hidden flex flex-col justify-between" style="border-left: 4px solid var(--accent); min-height: 180px;">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <a href="/exams/{{ $exam->id }}" class="text-[17px] font-bold text-[var(--text)] hover:text-[var(--accent)] transition-colors line-clamp-1">
                                            {{ $exam->title }}
                                        </a>
                                        @if($exam->is_active)
                                            <span class="badge badge-success text-[10px] px-2.5 py-0.5 font-bold uppercase">Active</span>
                                        @else
                                            <span class="badge badge-muted text-[10px] px-2.5 py-0.5 font-bold uppercase">Draft</span>
                                        @endif
                                    </div>

                                    <!-- Badges Grid -->
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="badge badge-default text-[11px] px-2.5 py-1 flex items-center gap-1 font-semibold">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->questions->count() }} Qs
                                        </span>
                                        @if($exam->time_limit)
                                            <span class="badge badge-muted text-[11px] px-2.5 py-1 flex items-center gap-1 font-semibold">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->time_limit }} Mins
                                            </span>
                                        @else
                                            <span class="badge badge-muted text-[11px] px-2.5 py-1 flex items-center gap-1 font-semibold">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Unlimited
                                            </span>
                                        @endif
                                        <span class="badge badge-muted text-[11px] px-2.5 py-1 flex items-center gap-1 font-semibold">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->passing_score }}% Pass
                                        </span>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center border-t border-[var(--border)] pt-4 mt-auto">
                                    <span class="text-[12px] text-[var(--muted)] font-medium">Created by me</span>
                                    <div class="action-group">
                                        <a href="/exams/{{ $exam->id }}/edit" class="btn-sm btn-sm-edit" style="border-radius: 8px; padding: 6px 14px;">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endauth

        <!-- Available Quizzes -->
        <div>
            <div class="flex items-center gap-2 mb-6">
                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                <h2 class="text-[14px] font-bold uppercase tracking-[0.08em] text-[var(--text)]">Available Challenges</h2>
            </div>

            @if(isset($exams) && $exams->count() > 0)
                <div class="grid grid-cols-1 gap-5">
                    @foreach($exams as $exam)
                        <div class="card card-hover p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden transition-all duration-300" style="border-left: 4px solid var(--accent);">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3.5 mb-2.5">
                                    <h3 class="text-[19px] font-extrabold text-[var(--text)] tracking-tight">
                                        {{ $exam->title }}
                                    </h3>

                                    <!-- Meta Badges -->
                                    <div class="flex gap-2">
                                        <span class="badge badge-default text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->questions->count() }} Qs
                                        </span>
                                        @if($exam->time_limit)
                                            <span class="badge badge-muted text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->time_limit }} Min
                                            </span>
                                        @else
                                            <span class="badge badge-muted text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Unlimited
                                            </span>
                                        @endif
                                        <span class="badge badge-muted text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $exam->passing_score }}% Pass
                                        </span>
                                    </div>
                                </div>

                                @if($exam->description)
                                    <p class="text-[13.5px] text-[var(--text-2)] leading-relaxed max-w-[580px] mb-3">
                                        {{ Str::limit($exam->description, 130) }}
                                    </p>
                                @else
                                    <p class="text-[13px] text-[var(--muted)] italic max-w-[580px] mb-3">
                                        No description provided for this challenge. Good luck!
                                    </p>
                                @endif
                            </div>

                            <div class="w-full md:w-auto flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-3 border-t md:border-t-0 border-[var(--border)] pt-4 md:pt-0">
                                @guest
                                    <span class="text-[12px] text-[var(--muted)] italic">
                                        🔒 Login to take this quiz
                                    </span>
                                @endguest

                                @auth
                                    @php
                                        $attempts = \App\Models\QuizAttempt::where('user_id', auth()->id())
                                            ->where('exam_id', $exam->id)
                                            ->latest()
                                            ->first();
                                    @endphp
                                    @if($attempts)
                                        <div class="flex flex-col items-start md:items-end gap-1.5">
                                            @if($attempts->passed)
                                                <span class="badge badge-success text-[11px] font-bold px-3 py-1 flex items-center gap-1 shadow-sm">
                                                    ✓ Passed ({{ round($attempts->score) }}%)
                                                </span>
                                            @else
                                                <span class="badge badge-danger text-[11px] font-bold px-3 py-1 flex items-center gap-1 shadow-sm">
                                                    ✗ Failed ({{ round($attempts->score) }}%)
                                                </span>
                                            @endif

                                            @if(!$exam->max_attempts || \App\Models\QuizAttempt::where('user_id', auth()->id())->where('exam_id', $exam->id)->count() < $exam->max_attempts)
                                                <a href="/exams/{{ $exam->id }}/take" class="btn-sm btn-sm-edit text-[12px] px-3.5 py-1.5" style="border-radius: 8px;">
                                                    Retake Challenge
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <a href="/exams/{{ $exam->id }}/take" class="btn-primary text-[13px] font-bold px-5 py-2.5 hover:shadow-lg flex items-center gap-1" style="border-radius: 8px;">
                                            Take Quiz
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="ml-0.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card p-10 text-center flex flex-col items-center justify-center border-dashed border-2">
                    <span class="inline-flex items-center justify-center w-12 h-12 bg-indigo-50 text-indigo-300 rounded-2xl mb-3">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </span>
                    <h3 class="text-lg font-bold text-[var(--text)] mb-1">No Challenges Available</h3>
                    <p class="text-sm text-[var(--muted)] max-w-sm">There are currently no quizzes published. Check back later for new coding challenges!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
