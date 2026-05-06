@extends('layouts.app')

@section('title', 'My Questions - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title Row -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)]">My Questions</h1>
        <a href="/questions/create" class="btn-primary">
            Create Question
        </a>
    </div>

    <!-- Questions List -->
    @if(isset($questions) && $questions->count() > 0)
        <div class="space-y-0">
            @foreach($questions as $question)
                <div class="py-5 border-b border-[var(--border)] last:border-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <a href="/questions/{{ $question->id }}" class="text-[17px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-2">
                                {{ $question->title }}
                            </a>
                            <p class="text-[13px] text-[var(--muted)] mb-2">
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
                        <div class="flex gap-2 ml-4">
                            <a href="/questions/{{ $question->id }}/edit" class="text-sm text-[var(--accent)] hover:underline">
                                Edit
                            </a>
                            <form method="POST" action="/questions/{{ $question->id }}" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-[var(--danger)] hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-[var(--muted)] mb-4">No questions created yet.</p>
            <a href="/questions/create" class="btn-primary">
                Create Your First Question
            </a>
        </div>
    @endif
</div>
@endsection