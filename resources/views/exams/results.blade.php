@extends('layouts.app')

@section('title', 'Results - ' . $attempt->exam->title . ' - Arts Of Code')

@section('content')
    <div class="max-w-[760px] mx-auto px-4 py-6">
        <!-- Results Summary Card -->
        <div class="bg-white border border-slate-100 rounded-3xl p-8 sm:p-10 text-center mb-10 shadow-[0_10px_30px_-5px_rgba(15,23,42,0.05)] relative overflow-hidden">
            <!-- Decorative soft background glow based on result -->
            <div class="absolute inset-x-0 top-0 h-44 opacity-40 pointer-events-none"
                 style="background: radial-gradient(circle at 50% 0, {{ $attempt->passed ? 'rgba(16, 185, 129, 0.18)' : 'rgba(239, 68, 68, 0.18)' }}, rgba(255,255,255,0));"></div>

            <!-- SVG Score Progress Ring -->
            <div class="relative flex items-center justify-center w-36 h-36 mx-auto mb-6">
                <!-- SVG Outer Ring -->
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <!-- Background Track -->
                    <circle
                        cx="50"
                        cy="50"
                        r="40"
                        class="stroke-slate-100"
                        stroke-width="7.5"
                        fill="transparent"
                    />
                    <!-- Active Progress -->
                    <circle
                        cx="50"
                        cy="50"
                        r="40"
                        style="stroke: {{ $attempt->passed ? '#10B981' : '#EF4444' }}; stroke-dasharray: 251.3; stroke-dashoffset: {{ 251.3 - (251.3 * $attempt->score / 100) }};"
                        stroke-width="7.5"
                        stroke-linecap="round"
                        fill="transparent"
                        class="transition-all duration-1000 ease-out"
                    />
                </svg>
                <!-- Score Text Inside -->
                <div class="absolute flex flex-col items-center">
                    <span class="text-4xl font-extrabold tracking-tight text-slate-800">
                        {{ round($attempt->score) }}%
                    </span>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-1">
                        Score
                    </span>
                </div>
            </div>

            <!-- Exam Title -->
            <h1 class="text-2xl font-extrabold text-slate-800 mb-4 tracking-tight leading-tight">
                {{ $attempt->exam->title }}
            </h1>

            <!-- Pass/Fail Status Banner -->
            <div class="mb-8">
                @if($attempt->passed)
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl text-sm font-semibold shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Congratulations! Passed Successfully</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-rose-50 border border-rose-100 text-rose-800 rounded-2xl text-sm font-semibold shadow-sm">
                        <svg class="w-5 h-5 text-rose-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2 2 2m0-4l-2 2-2-2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Failed (Passing Score Required: {{ $attempt->exam->passing_score }}%)</span>
                    </div>
                @endif
            </div>

            <!-- Perfect Score Achievement -->
            @if($attempt->score == 100)
                <div class="mb-8 max-w-md mx-auto">
                    <div class="inline-flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 text-amber-800 rounded-2xl text-sm font-semibold shadow-md animate-pulse">
                        <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <div class="text-left">
                            <div class="font-bold text-amber-900">Perfect Score!</div>
                            <div class="text-xs text-amber-700 font-normal">You answered everything correctly! Exam marked complete.</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-100">
                <!-- Correct Card -->
                <div class="bg-emerald-50/40 border border-emerald-100/50 rounded-2xl p-4 flex flex-col items-center transition-all duration-300 hover:scale-[1.02] hover:bg-emerald-50/60">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 mb-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800">
                        {{ $attempt->quizAnswers->where('is_correct', true)->count() }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-wider">Correct</span>
                </div>

                <!-- Incorrect Card -->
                <div class="bg-rose-50/40 border border-rose-100/50 rounded-2xl p-4 flex flex-col items-center transition-all duration-300 hover:scale-[1.02] hover:bg-rose-50/60">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600 mb-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800">
                        {{ $attempt->quizAnswers->where('is_correct', false)->count() }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-wider">Wrong</span>
                </div>

                <!-- Total Card -->
                <div class="bg-slate-50/80 border border-slate-100 rounded-2xl p-4 flex flex-col items-center transition-all duration-300 hover:scale-[1.02] hover:bg-slate-100/80">
                    <div class="w-10 h-10 rounded-xl bg-slate-200/80 flex items-center justify-center text-slate-600 mb-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800">
                        {{ $attempt->quizAnswers->count() }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase mt-0.5 tracking-wider">Total</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-10">
                <a href="/exams" class="inline-flex items-center justify-center gap-2 px-6 py-3 w-full sm:w-auto bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 font-semibold rounded-2xl shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to Quizzes</span>
                </a>
                @if(!$attempt->exam->max_attempts || \App\Models\QuizAttempt::where('user_id', auth()->id())->where('exam_id', $attempt->exam->id)->count() < $attempt->exam->max_attempts)
                    <a href="/exams/{{ $attempt->exam->id }}/take" class="inline-flex items-center justify-center gap-2 px-7 py-3 w-full sm:w-auto bg-gradient-to-r from-indigo-500 to-violet-600 hover:from-indigo-600 hover:to-violet-700 text-white font-bold rounded-2xl shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all duration-250">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 7.89H18V4" />
                        </svg>
                        <span>Retake Quiz</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Question Review Section -->
        <section class="mt-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Review Details</h2>
                    <p class="text-xs text-slate-400 mt-1">Go over your responses and correct answers</p>
                </div>
                <span class="inline-flex items-center px-3.5 py-1 bg-slate-50 text-slate-500 text-xs font-bold rounded-full border border-slate-200">
                    {{ $attempt->quizAnswers->count() }} Questions
                </span>
            </div>

            @if($attempt->quizAnswers->count() > 0)
                <div class="space-y-6">
                    @foreach($attempt->quizAnswers as $index => $answer)
                        <div class="bg-white border {{ $answer->is_correct ? 'border-emerald-100/80 shadow-[0_4px_20px_rgba(16,185,129,0.02)]' : 'border-rose-100/80 shadow-[0_4px_20px_rgba(239,68,68,0.02)]' }} rounded-3xl overflow-hidden transition-all duration-300 hover:shadow-md border-l-4 {{ $answer->is_correct ? 'border-l-emerald-500' : 'border-l-rose-500' }} p-6">

                            <!-- Question Header (Q No + Points) -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-lg">
                                    Question {{ sprintf('%02d', $index + 1) }}
                                </span>

                                @if($answer->is_correct)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-xl text-xs font-bold border border-emerald-100">
                                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>{{ $answer->points_earned }} / {{ $answer->question->points }} pts</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 rounded-xl text-xs font-bold border border-rose-100">
                                        <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span>{{ $answer->points_earned }} / {{ $answer->question->points }} pts</span>
                                    </span>
                                @endif
                            </div>

                            <!-- Question Title -->
                            <h3 class="text-[17px] font-bold text-slate-800 mb-2 tracking-tight">
                                {{ $answer->question->title }}
                            </h3>

                            <!-- Question Text -->
                            @if($answer->question->question_text)
                                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-4 text-[14px] text-slate-600 leading-relaxed font-sans">
                                    {!! nl2br(e($answer->question->question_text)) !!}
                                </div>
                            @endif

                            <!-- Answer Options Cards -->
                            <div class="space-y-3 mt-4">
                                <!-- User's Answer Block -->
                                <div class="flex items-center gap-3.5 p-4 rounded-2xl border transition-all {{ $answer->is_correct ? 'bg-emerald-50/40 border-emerald-100/60 text-emerald-950' : 'bg-rose-50/40 border-rose-100/60 text-rose-950' }}">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center {{ $answer->is_correct ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }} shrink-0 shadow-sm">
                                        @if($answer->is_correct)
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="text-sm font-medium">
                                        <span class="text-[9px] uppercase font-bold text-slate-400 block mb-0.5 tracking-wider">Your Response</span>
                                        <span class="font-semibold text-slate-800 text-[14px]">{{ $answer->option->option_text ?? 'No Answer' }}</span>
                                    </div>
                                </div>

                                <!-- Correct Answer Block (Only if user is wrong) -->
                                @if(!$answer->is_correct && $answer->question->correctOption)
                                    <div class="flex items-center gap-3.5 p-4 rounded-2xl border bg-emerald-50/30 border-emerald-100/50 text-emerald-950 transition-all">
                                        <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium">
                                            <span class="text-[9px] uppercase font-bold text-slate-400 block mb-0.5 tracking-wider">Correct Option</span>
                                            <span class="font-semibold text-slate-800 text-[14px]">{{ $answer->question->correctOption->option_text }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Explanation Section -->
                            @if($answer->question->explanation)
                                <div class="mt-5 p-4 bg-indigo-50/40 border border-indigo-100/50 rounded-2xl flex gap-3 items-start">
                                    <div class="mt-0.5 bg-indigo-100 text-indigo-600 rounded-lg p-1.5 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-[10px] font-bold text-indigo-900 uppercase tracking-widest mb-1">Explanation</h4>
                                        <p class="text-[13px] text-indigo-800 font-normal leading-relaxed">
                                            {{ $answer->question->explanation }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
