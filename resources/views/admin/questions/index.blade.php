@extends('admin.layout')

@section('title', 'Questions - Admin')

@section('admin-content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)]">Questions</h1>

        <a href="/admin/questions/create" class="btn-primary">
            Add Question
        </a>
    </div>

    <!-- Filter by Exam -->
    @if(isset($exams) && $exams->count() > 0)
        <div class="mb-6">
            <form method="GET" action="/admin/questions" class="flex gap-4 items-center">
                <label class="text-sm text-[var(--muted)]">Filter by exam:</label>
                <select name="exam_id" class="input max-w-xs" onchange="this.form.submit()">
                    <option value="">All Exams</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                            {{ $exam->title }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    @endif

    <!-- Questions Table -->
    @if(isset($questions) && $questions->count() > 0)
        <div class="card overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[var(--border)]">
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Question</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Type</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Exam</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr class="border-b border-[var(--border)] last:border-0">
                            <td class="py-4 px-4">
                                <div class="text-sm max-w-md truncate">
                                    {{ $question->question }}
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="badge bg-[#F4F4F5] text-[var(--muted)]">
                                    {{ $question->type === 'mcq' ? 'MCQ' : 'Open' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                {{ $question->exam->title ?? '—' }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <!-- Edit -->
                                    <a href="/admin/questions/{{ $question->id }}/edit" class="text-sm text-[var(--muted)] hover:text-[var(--accent)]">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form method="POST" action="/admin/questions/{{ $question->id }}" onsubmit="return confirm('Are you sure you want to delete this question?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-[var(--danger)] hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($questions->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $questions->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-8 text-center text-[var(--muted)]">
            No questions found. <a href="/admin/questions/create" class="link">Add your first question</a>.
        </div>
    @endif
</div>
@endsection