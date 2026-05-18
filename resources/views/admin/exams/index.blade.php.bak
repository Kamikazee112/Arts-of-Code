@extends('admin.layout')

@section('title', 'Exams - Admin')

@section('admin-content')
<div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-[22px] font-bold text-[var(--text)] tracking-tight">Exams</h1>
            <p class="text-[13px] text-[var(--muted)] mt-0.5">Create and manage all platform quizzes</p>
        </div>
        <a href="/admin/exams/create" class="btn-primary self-start sm:self-auto">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Create Exam
        </a>
    </div>

    <!-- Exams Table -->
    @if(isset($exams) && $exams->count() > 0)
        <div class="card overflow-hidden">
            <div class="table-responsive">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[var(--border)] bg-[var(--surface-2)]">
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider">Title</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden sm:table-cell">Questions</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden md:table-cell">Duration</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden lg:table-cell">Attempts</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden lg:table-cell">Created</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exams as $exam)
                            <tr class="border-b border-[var(--border)] last:border-0 hover:bg-[var(--surface-2)] transition-colors">
                                <td class="py-3.5 px-4">
                                    <span class="text-[13.5px] font-semibold text-[var(--text)]">{{ $exam->title }}</span>
                                </td>
                                <td class="py-3.5 px-4 hidden sm:table-cell">
                                    <span class="badge badge-default text-[11px]">{{ $exam->questions_count ?? 0 }} Qs</span>
                                </td>
                                <td class="py-3.5 px-4 text-[13px] text-[var(--muted)] hidden md:table-cell">
                                    {{ $exam->duration ?? '—' }} {{ $exam->duration ? 'min' : '' }}
                                </td>
                                <td class="py-3.5 px-4 text-[13px] text-[var(--muted)] hidden lg:table-cell">
                                    {{ $exam->attempts_count ?? 0 }}
                                </td>
                                <td class="py-3.5 px-4 text-[13px] text-[var(--muted)] hidden lg:table-cell">
                                    {{ $exam->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="action-group">
                                        <a href="/admin/exams/{{ $exam->id }}/results" class="btn-sm btn-sm-view">Results</a>
                                        <a href="/admin/exams/{{ $exam->id }}/edit" class="btn-sm btn-sm-edit">Edit</a>
                                        <form method="POST" action="/admin/exams/{{ $exam->id }}"
                                            onsubmit="return confirm('Are you sure you want to delete this exam?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-sm-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($exams->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $exams->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-12 text-center flex flex-col items-center">
            <span class="inline-flex items-center justify-center w-14 h-14 bg-cyan-50 text-cyan-300 rounded-2xl mb-4">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </span>
            <p class="text-[15px] font-medium text-[var(--text)] mb-1">No exams found</p>
            <p class="text-[13px] text-[var(--muted)] mb-5">Get started by creating your first quiz.</p>
            <a href="/admin/exams/create" class="btn-primary">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Create First Exam
            </a>
        </div>
    @endif
</div>
@endsection