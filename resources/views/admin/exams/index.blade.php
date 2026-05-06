@extends('admin.layout')

@section('title', 'Exams - Admin')

@section('admin-content')
<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)]">Exams</h1>

        <a href="/admin/exams/create" class="btn-primary">
            Create Exam
        </a>
    </div>

    <!-- Exams Table -->
    @if(isset($exams) && $exams->count() > 0)
        <div class="card overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[var(--border)]">
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Title</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Questions</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Duration</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Attempts</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Created</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $exam)
                        <tr class="border-b border-[var(--border)] last:border-0">
                            <td class="py-4 px-4 font-medium">
                                {{ $exam->title }}
                            </td>
                            <td class="py-4 px-4 text-sm">
                                {{ $exam->questions_count ?? 0 }}
                            </td>
                            <td class="py-4 px-4 text-sm text-[var(--muted)]">
                                {{ $exam->duration }} min
                            </td>
                            <td class="py-4 px-4 text-sm text-center">
                                {{ $exam->attempts_count ?? 0 }}
                            </td>
                            <td class="py-4 px-4 text-sm text-[var(--muted)]">
                                {{ $exam->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <!-- View Results -->
                                    <a href="/admin/exams/{{ $exam->id }}/results" class="text-sm text-[var(--accent)] hover:underline">
                                        View Results
                                    </a>

                                    <!-- Edit -->
                                    <a href="/admin/exams/{{ $exam->id }}/edit" class="text-sm text-[var(--muted)] hover:text-[var(--accent)]">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form method="POST" action="/admin/exams/{{ $exam->id }}" onsubmit="return confirm('Are you sure you want to delete this exam?');" class="inline">
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
        @if($exams->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $exams->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-8 text-center text-[var(--muted)]">
            No exams found. <a href="/admin/exams/create" class="link">Create your first exam</a>.
        </div>
    @endif
</div>
@endsection