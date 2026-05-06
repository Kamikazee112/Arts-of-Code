@extends('layouts.app')

@section('title', 'Exams - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title Row -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-[22px] font-medium text-[var(--text)] mb-2">Quizzes</h1>
            <p class="text-[14px] text-[var(--muted)]">
                @if(auth()->user()->role === 'admin')
                    Manage and create quizzes.
                @else
                    Test your knowledge.
                @endif
            </p>
        </div>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="/exams/create" class="btn-primary">
                    Create Quiz
                </a>
            @endif
        @endauth
    </div>

    <!-- My Quizzes (Admin Only) -->
    @auth
        @if(auth()->user()->role === 'admin' && isset($myExams) && $myExams->count() > 0)
            <div class="mb-8">
                <h2 class="text-[13px] uppercase tracking-[0.06em] text-[var(--muted)] mb-4">My Quizzes</h2>
                <div class="space-y-0">
                    @foreach($myExams as $exam)
                        <div class="py-4 border-b border-[var(--border)] last:border-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <a href="/exams/{{ $exam->id }}" class="text-[16px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-1">
                                        {{ $exam->title }}
                                    </a>
                                    <p class="text-[13px] text-[var(--muted)]">
                                        {{ $exam->questions->count() }} questions
                                        @if($exam->time_limit)
                                            · {{ $exam->time_limit }} minutes
                                        @endif
                                        · Passing: {{ $exam->passing_score }}%
                                        @if($exam->is_active)
                                            · <span class="text-green-600">Active</span>
                                        @else
                                            · <span class="text-[var(--muted)]">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <a href="/exams/{{ $exam->id }}/edit" class="text-sm text-[var(--accent)] hover:underline">
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
        <h2 class="text-[13px] uppercase tracking-[0.06em] text-[var(--muted)] mb-4">Available Quizzes</h2>
        @if(isset($exams) && $exams->count() > 0)
            <div class="space-y-0">
                @foreach($exams as $exam)
                    <div class="py-5 border-b border-[var(--border)] last:border-0">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-[17px] font-medium text-[var(--text)] mb-2">
                                    {{ $exam->title }}
                                </h3>
                                <p class="text-[13px] text-[var(--muted)] mb-2">
                                    {{ $exam->questions->count() }} questions
                                    @if($exam->time_limit)
                                        · {{ $exam->time_limit }} minutes
                                    @endif
                                    · Passing: {{ $exam->passing_score }}%
                                </p>
                                @if($exam->description)
                                    <p class="text-sm text-[var(--muted)]">
                                        {{ Str::limit($exam->description, 100) }}
                                    </p>
                                @endif
                            </div>

                            <div class="ml-4">
                                @guest
                                    <span class="text-[13px] text-[var(--muted)] italic">
                                        Login to take this quiz
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
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm {{ $attempts->passed ? 'text-green-600' : 'text-[var(--muted)]' }}">
                                                {{ $attempts->passed ? '✓ Passed' : '✗ Failed' }} — Score: {{ round($attempts->score) }}%
                                            </span>
                                            @if(!$exam->max_attempts || \App\Models\QuizAttempt::where('user_id', auth()->id())->where('exam_id', $exam->id)->count() < $exam->max_attempts)
                                                <a href="/exams/{{ $exam->id }}/take" class="text-sm text-[var(--accent)] hover:underline">
                                                    Retake
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <a href="/exams/{{ $exam->id }}/take" class="btn-primary text-sm">
                                            Take Quiz →
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-[var(--muted)]">No quizzes available yet.</p>
        @endif
    </div>
</div>
@endsection