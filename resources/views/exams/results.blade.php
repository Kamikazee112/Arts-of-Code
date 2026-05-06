@extends('layouts.app')

@section('title', 'Results - ' . $attempt->exam->title . ' - Arts Of Code')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Results Summary Card -->
    <div class="card p-8 text-center mb-10">
        <!-- Score -->
        <div class="text-[48px] font-medium mb-4" style="color: {{ $attempt->passed ? 'var(--accent)' : 'var(--danger)' }}">
            {{ round($attempt->score) }}%
        </div>

        <!-- Exam Title -->
        <div class="text-[16px] text-[var(--muted)] mb-6">
            {{ $attempt->exam->title }}
        </div>

        <!-- Pass/Fail Status -->
        <div class="mb-6">
            @if($attempt->passed)
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    ✓ Passed
                </span>
            @else
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                    ✗ Failed (Passing: {{ $attempt->exam->passing_score }}%)
                </span>
            @endif
        </div>

        <!-- Perfect Score Achievement -->
        @if($attempt->score == 100)
            <div class="mb-6">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                    🏆 Perfect Score! Exam marked as complete
                </span>
            </div>
        @endif

        <!-- Stats Row -->
        <div class="flex justify-center gap-8 pt-6 border-t border-[var(--border)]">
            <div>
                <div class="text-[18px] font-medium" style="color: #16A34A">
                    ✓ {{ $attempt->quizAnswers->where('is_correct', true)->count() }}
                </div>
                <div class="text-[13px] text-[var(--muted)]">Correct</div>
            </div>

            <div>
                <div class="text-[18px] font-medium" style="color: var(--danger)">
                    ✗ {{ $attempt->quizAnswers->where('is_correct', false)->count() }}
                </div>
                <div class="text-[13px] text-[var(--muted)]">Wrong</div>
            </div>

            <div>
                <div class="text-[18px] font-medium text-[var(--text)]">
                    {{ $attempt->quizAnswers->count() }}
                </div>
                <div class="text-[13px] text-[var(--muted)]">Total</div>
            </div>
        </div>

        <!-- Action Links -->
        <div class="flex justify-center gap-4 mt-8">
            <a href="/exams" class="text-[var(--muted)] hover:text-[var(--text)] transition-colors">
                Back to Quizzes
            </a>
            @if(!$attempt->exam->max_attempts || \App\Models\QuizAttempt::where('user_id', auth()->id())->where('exam_id', $attempt->exam->id)->count() < $attempt->exam->max_attempts)
                <a href="/exams/{{ $attempt->exam->id }}/take" class="btn-outline">
                    Retake Quiz
                </a>
            @endif
        </div>
    </div>

    <!-- Question Review Section -->
    <section>
        <h2 class="text-[18px] font-medium text-[var(--text)] mb-6">Review</h2>

        @if($attempt->quizAnswers->count() > 0)
            <div class="space-y-0">
                @foreach($attempt->quizAnswers as $index => $answer)
                    <div
                        class="py-5 border-b border-[var(--border)] pl-4"
                        style="border-left: 3px solid {{ $answer->is_correct ? '#16A34A' : 'var(--danger)' }}"
                    >
                        <!-- Question Label -->
                        <div class="text-[12px] text-[var(--muted)] uppercase mb-2">
                            Q{{ $index + 1 }}
                        </div>

                        <!-- Question Text -->
                        <div class="text-[15px] font-medium mb-3">
                            {{ $answer->question->title }}
                        </div>

                        <p class="text-sm text-[var(--muted)] mb-3">
                            {{ $answer->question->question_text }}
                        </p>

                        <!-- Answer Status -->
                        @if($answer->is_correct)
                            <div class="text-sm mb-2" style="color: #16A34A">
                                ✓ Your answer: {{ $answer->option->option_text ?? 'N/A' }}
                            </div>
                        @else
                            <div class="text-sm mb-2" style="color: var(--danger)">
                                ✗ Your answer: {{ $answer->option->option_text ?? 'N/A' }}
                            </div>
                            @if($answer->question->correctOption)
                                <div class="text-sm mb-2" style="color: #16A34A">
                                    ✓ Correct answer: {{ $answer->question->correctOption->option_text }}
                                </div>
                            @endif
                        @endif

                        <!-- Points -->
                        <div class="text-xs text-[var(--muted)]">
                            {{ $answer->points_earned }} / {{ $answer->question->points }} points
                        </div>

                        <!-- Explanation -->
                        @if($answer->question->explanation)
                            <div class="text-sm text-[var(--muted)] italic mt-3 p-3 bg-[var(--bg)] rounded">
                                {{ $answer->question->explanation }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection