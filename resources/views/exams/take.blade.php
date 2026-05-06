@extends('layouts.app')

@section('title', $exam->title . ' - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Quiz Header -->
    <div class="card p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-[22px] font-medium text-[var(--text)]">
                {{ $exam->title }}
            </h1>
            @if($exam->time_limit)
                <div class="text-sm font-medium text-[var(--accent)]">
                    Time Limit: {{ $exam->time_limit }} minutes
                </div>
            @endif
        </div>

        @if($exam->description)
            <p class="text-[14px] text-[var(--muted)] mb-4">
                {{ $exam->description }}
            </p>
        @endif

        <div class="flex gap-4 text-sm text-[var(--muted)]">
            <span>{{ $exam->questions->count() }} questions</span>
            <span>Passing score: {{ $exam->passing_score }}%</span>
        </div>
    </div>

    <!-- Quiz Form -->
    <form method="POST" action="/exams/{{ $exam->id }}/submit">
        @csrf

        <div class="space-y-6">
            @foreach($exam->questions as $index => $question)
                <div class="card p-6">
                    <!-- Question Header -->
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-[var(--accent)] text-white flex items-center justify-center text-sm font-medium flex-shrink-0">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-[16px] font-medium text-[var(--text)] mb-2">
                                {{ $question->title }}
                            </h3>
                            <p class="text-[14px] text-[var(--text)]">
                                {{ $question->question_text }}
                            </p>
                            <div class="flex gap-2 mt-2">
                                <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                    {{ strtoupper($question->type) }}
                                </span>
                                <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                                    {{ $question->points }} pts
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Answer Options -->
                    @if($question->type === 'mcq')
                        <div class="space-y-3 ml-11">
                            @foreach($question->options as $option)
                                <label class="flex items-center gap-3 p-3 border border-[var(--border)] rounded-lg cursor-pointer hover:bg-[var(--bg)] transition-colors">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option->id }}"
                                        class="w-4 h-4"
                                        required
                                    >
                                    <span class="text-sm text-[var(--text)]">
                                        {{ $option->option_text }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->type === 'true_false')
                        <div class="space-y-3 ml-11">
                            @foreach($question->options as $option)
                                <label class="flex items-center gap-3 p-3 border border-[var(--border)] rounded-lg cursor-pointer hover:bg-[var(--bg)] transition-colors">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option->id }}"
                                        class="w-4 h-4"
                                        required
                                    >
                                    <span class="text-sm text-[var(--text)]">
                                        {{ $option->option_text }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->type === 'short_answer')
                        <div class="ml-11">
                            <textarea
                                name="answers[{{ $question->id }}]"
                                class="input min-h-[80px] resize-vertical"
                                placeholder="Type your answer here..."
                                required
                            ></textarea>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-center">
            <button type="submit" class="btn-primary">
                Submit Quiz
            </button>
        </div>
    </form>
</div>
@endsection