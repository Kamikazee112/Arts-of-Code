@extends('layouts.app')

@section('title', $question->title . ' - Arts Of Code')

@section('content')
    <div class="max-w-[800px] mx-auto">
        <!-- Back Button -->
        <a href="/questions"
            class="text-sm text-[var(--muted)] hover:text-[var(--accent)] transition-colors mb-6 inline-block">
            ← Back to Questions
        </a>

        <!-- Question Details -->
        <div class="card p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-[22px] font-medium text-[var(--text)]">
                    {{ $question->title }}
                </h1>
                <div class="action-group">
                    <a href="/questions/{{ $question->id }}/edit" class="btn-sm btn-sm-edit" style="padding: 7px 14px; font-size: 13px;">
                        Edit
                    </a>
                    <form method="POST" action="/questions/{{ $question->id }}"
                        onsubmit="return confirm('Are you sure you want to delete this question?');"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sm btn-sm-delete" style="padding: 7px 14px; font-size: 13px;">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex gap-2 mb-4">
                <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                    {{ strtoupper($question->type) }}
                </span>
                <span class="badge bg-[var(--bg)] text-[var(--muted)] px-2 py-1 rounded text-xs">
                    {{ $question->points }} pts
                </span>
            </div>

            <p class="text-[16px] text-[var(--text)] mb-4">
                {{ $question->question_text }}
            </p>

            @if($question->explanation)
                <div class="bg-[var(--bg)] p-4 rounded-lg">
                    <h3 class="text-[13px] font-medium text-[var(--text)] mb-2">Explanation</h3>
                    <p class="text-sm text-[var(--muted)]">
                        {{ $question->explanation }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Options -->
        @if($question->options->count() > 0)
            <div class="card p-6">
                <h2 class="text-[16px] font-medium text-[var(--text)] mb-4">Options</h2>
                <div class="space-y-3">
                    @foreach($question->options as $option)
                        <div
                            class="flex items-center gap-3 p-3 rounded-lg {{ $option->is_correct ? 'bg-green-50 border border-green-200' : 'bg-[var(--bg)]' }}">
                            <div
                                class="w-6 h-6 rounded-full flex items-center justify-center {{ $option->is_correct ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                @if($option->is_correct)
                                    ✓
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </div>
                            <span class="text-sm {{ $option->is_correct ? 'text-green-700 font-medium' : 'text-[var(--text)]' }}">
                                {{ $option->option_text }}
                            </span>
                            @if($option->is_correct)
                                <span class="text-xs text-green-600 ml-auto">(Correct)</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection