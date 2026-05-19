@extends('layouts.app')

@section('title', $exam->title . ' - Arts Of Code')

@section('content')
    <div class="max-w-5xl mx-auto space-y-5">
        <a href="/exams" class="inline-flex items-center gap-2 text-sm font-medium text-(--muted) hover:text-(--accent) transition-colors">
            <span class="text-base leading-none">←</span>
            Back to Quizzes
        </a>

        <div class="card overflow-hidden border border-(--border) shadow-md">
            <div class="relative p-7 sm:p-8 bg-[linear-gradient(135deg,rgba(99,102,241,0.10),rgba(14,165,233,0.06),rgba(255,255,255,0))]">
                <div class="absolute inset-x-0 top-0 h-1 bg-(--brand-gradient)"></div>
                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                    <div class="space-y-4 max-w-2xl">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge bg-(--accent-light) text-(--accent) px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase">Quiz</span>
                            <span class="badge {{ $exam->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase">
                                {{ $exam->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <h1 class="text-[30px] leading-tight font-semibold text-(--text) tracking-tight">
                                {{ $exam->title }}
                            </h1>
                            @if($exam->description)
                                <p class="text-[15px] sm:text-[16px] leading-7 text-(--muted) max-w-2xl">
                                    {{ $exam->description }}
                                </p>
                            @endif
                        </div>
                    </div>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="/exams/{{ $exam->id }}/edit" class="btn-sm btn-sm-edit self-start shrink-0 px-4 py-2" style="font-size: 13px; border-radius: 12px;">
                            Edit
                        </a>
                    @endif
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <div class="rounded-2xl border border-white/70 bg-white/75 backdrop-blur px-4 py-3 shadow-sm">
                        <div class="text-[11px] uppercase tracking-[0.18em] text-(--muted) font-semibold">Questions</div>
                        <div class="mt-1 text-[18px] font-semibold text-(--text)">{{ $exam->questions->count() }}</div>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/75 backdrop-blur px-4 py-3 shadow-sm">
                        <div class="text-[11px] uppercase tracking-[0.18em] text-(--muted) font-semibold">Passing</div>
                        <div class="mt-1 text-[18px] font-semibold text-(--text)">{{ $exam->passing_score }}%</div>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/75 backdrop-blur px-4 py-3 shadow-sm">
                        <div class="text-[11px] uppercase tracking-[0.18em] text-(--muted) font-semibold">Time Limit</div>
                        <div class="mt-1 text-[18px] font-semibold text-(--text)">{{ $exam->time_limit ? $exam->time_limit . ' min' : 'Unlimited' }}</div>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/75 backdrop-blur px-4 py-3 shadow-sm">
                        <div class="text-[11px] uppercase tracking-[0.18em] text-(--muted) font-semibold">Attempts</div>
                        <div class="mt-1 text-[18px] font-semibold text-(--text)">{{ $exam->max_attempts ? $exam->max_attempts : '∞' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-6 sm:p-7 border border-(--border) shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-[18px] font-semibold text-(--text)">Questions</h2>
                    <p class="text-sm text-(--muted) mt-1">Preview the structure before you start the quiz.</p>
                </div>
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-(--muted)">{{ $exam->questions->count() }} items</span>
            </div>

            @if($exam->questions->count() > 0)
                <div class="space-y-3">
                    @foreach($exam->questions as $index => $question)
                        <div class="rounded-2xl border border-(--border) bg-white p-4 sm:p-5 transition-shadow hover:shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-(--accent-light) text-(--accent) flex items-center justify-center text-sm font-semibold shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <h3 class="text-[15px] font-semibold text-(--text) leading-6">
                                                {{ $question->title }}
                                            </h3>
                                            <p class="mt-1 text-sm leading-6 text-(--muted)">
                                                {{ Str::limit($question->question_text, 120) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <span class="badge bg-(--bg) text-(--muted) px-2.5 py-1 rounded-full text-[11px] font-semibold tracking-wide">
                                            {{ strtoupper($question->type) }}
                                        </span>
                                        <span class="badge bg-(--bg) text-(--muted) px-2.5 py-1 rounded-full text-[11px] font-semibold tracking-wide">
                                            {{ $question->points }} pts
                                        </span>
                                        <span class="badge bg-(--bg) text-(--muted) px-2.5 py-1 rounded-full text-[11px] font-semibold tracking-wide">
                                            {{ $question->options->count() }} options
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-(--border) bg-(--bg) px-5 py-8 text-center">
                    <p class="text-[15px] font-medium text-(--text)">No questions in this quiz yet.</p>
                    <p class="mt-1 text-sm text-(--muted)">Add questions to make this quiz available to learners.</p>
                </div>
            @endif
        </div>

        @if($exam->is_active)
            <div class="card p-6 sm:p-7 border border-(--border) shadow-sm">
                @auth
                    @php
                        $attempts = \App\Models\QuizAttempt::where('user_id', auth()->id())
                            ->where('exam_id', $exam->id)
                            ->count();
                    @endphp

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-[16px] font-semibold text-(--text)">Ready to start?</h3>
                            <p class="mt-1 text-sm text-(--muted)">
                                {{ $exam->max_attempts ? 'You have used ' . $attempts . ' of ' . $exam->max_attempts . ' attempts.' : 'You can attempt this quiz as many times as needed.' }}
                            </p>
                        </div>

                        @if(!$exam->max_attempts || $attempts < $exam->max_attempts)
                            <a href="/exams/{{ $exam->id }}/take" class="btn-primary inline-flex items-center justify-center px-6 py-3 rounded-xl shadow-sm">
                                Take Quiz
                            </a>
                        @else
                            <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3">
                                <p class="text-sm font-medium text-amber-800">You have reached the maximum number of attempts for this quiz.</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-[16px] font-semibold text-(--text)">Sign in to continue</h3>
                            <p class="mt-1 text-sm text-(--muted)">Log in to save your progress and take the quiz.</p>
                        </div>

                        <a href="/login" class="btn-primary inline-flex items-center justify-center px-6 py-3 rounded-xl shadow-sm">
                            Login to Take Quiz
                        </a>
                    </div>
                @endauth
            </div>
        @endif
    </div>
@endsection
