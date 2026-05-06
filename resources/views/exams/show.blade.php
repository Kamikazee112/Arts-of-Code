@extends('layouts.app')

@section('title', $exam->title . ' - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Back Button -->
    <a href="/exams" class="text-sm text-[var(--muted)] hover:text-[var(--accent)] transition-colors mb-6 inline-block">
        ← Back to Quizzes
    </a>

    <!-- Quiz Details -->
    <div class="card p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <h1 class="text-[22px] font-medium text-[var(--text)]">
                {{ $exam->title }}
            </h1>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="flex gap-2">
                    <a href="/exams/{{ $exam->id }}/edit" class="btn-outline text-sm">
                        Edit
                    </a>
                </div>
            @endif
        </div>

        @if($exam->description)
            <p class="text-[16px] text-[var(--muted)] mb-4">
                {{ $exam->description }}
            </p>
        @endif

        <div class="flex gap-4 mb-4">
            <div class="flex items-center gap-2">
                <span class="text-sm text-[var(--muted)]">Questions:</span>
                <span class="text-sm font-medium text-[var(--text)]">{{ $exam->questions->count() }}</span>
            </div>
            @if($exam->time_limit)
                <div class="flex items-center gap-2">
                    <span class="text-sm text-[var(--muted)]">Time Limit:</span>
                    <span class="text-sm font-medium text-[var(--text)]">{{ $exam->time_limit }} min</span>
                </div>
            @endif
            <div class="flex items-center gap-2">
                <span class="text-sm text-[var(--muted)]">Passing Score:</span>
                <span class="text-sm font-medium text-[var(--text)]">{{ $exam->passing_score }}%</span>
            </div>
            @if($exam->max_attempts)
                <div class="flex items-center gap-2">
                    <span class="text-sm text-[var(--muted)]">Max Attempts:</span>
                    <span class="text-sm font-medium text-[var(--text)]">{{ $exam->max_attempts }}</span>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-2">
            <span class="badge {{ $exam->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} px-2 py-1 rounded text-xs">
                {{ $exam->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>

    <!-- Questions Preview -->
    <div class="card p-6">
        <h2 class="text-[16px] font-medium text-[var(--text)] mb-4">Questions</h2>
        @if($exam->questions->count() > 0)
            <div class="space-y-4">
                @foreach($exam->questions as $index => $question)
                    <div class="border-b border-[var(--border)] pb-4 last:border-0 last:pb-0">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-[var(--accent)] text-white flex items-center justify-center text-sm font-medium flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-[var(--text)] mb-1">
                                    {{ $question->title }}
                                </h3>
                                <p class="text-sm text-[var(--muted)] mb-2">
                                    {{ Str::limit($question->question_text, 100) }}
                                </p>
                                <div class="flex gap-2">
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ strtoupper($question->type) }}
                                    </span>
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ $question->points }} pts
                                    </span>
                                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                        {{ $question->options->count() }} options
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-[var(--muted)]">No questions in this quiz yet.</p>
        @endif
    </div>

    <!-- Take Quiz Button -->
    @if($exam->is_active)
        <div class="mt-6">
            @auth
                @php
                    $attempts = \App\Models\QuizAttempt::where('user_id', auth()->id())
                        ->where('exam_id', $exam->id)
                        ->count();
                @endphp
                @if(!$exam->max_attempts || $attempts < $exam->max_attempts)
                    <a href="/exams/{{ $exam->id }}/take" class="btn-primary">
                        Take Quiz
                    </a>
                @else
                    <p class="text-[var(--muted)]">You have reached the maximum number of attempts for this quiz.</p>
                @endif
            @else
                <a href="/login" class="btn-primary">
                    Login to Take Quiz
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection