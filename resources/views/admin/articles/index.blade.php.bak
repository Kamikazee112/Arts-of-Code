@extends('admin.layout')

@section('title', 'Articles - Admin')

@section('admin-content')
<div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-[22px] font-bold text-[var(--text)] tracking-tight">المقالات</h1>
        <div class="text-[13px] text-[var(--muted)]">
            Manage and moderate all community articles
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-1 mb-6 bg-[var(--surface-2)] p-1 rounded-xl border border-[var(--border)] w-fit">
        @php
            $tabs = [
                ['label' => 'All',      'status' => null],
                ['label' => 'Pending',  'status' => 'pending'],
                ['label' => 'Approved', 'status' => 'approved'],
                ['label' => 'Rejected', 'status' => 'rejected'],
            ];
        @endphp
        @foreach($tabs as $tab)
            @php
                $isActive = request('status') === $tab['status'] || (!request()->has('status') && $tab['status'] === null);
                $href = $tab['status'] ? '/admin/articles?status=' . $tab['status'] : '/admin/articles';
            @endphp
            <a href="{{ $href }}"
               class="px-4 py-1.5 rounded-lg text-[13px] font-semibold transition-all {{ $isActive ? 'bg-white text-[var(--accent)] shadow-sm border border-[var(--border)]' : 'text-[var(--muted)] hover:text-[var(--text)]' }}">
                {{ $tab['label'] }}
            </a>
        @endforeach
    </div>

    <!-- Articles Table -->
    @if(isset($articles) && $articles->count() > 0)
        <div class="card overflow-hidden">
            <div class="table-responsive">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[var(--border)] bg-[var(--surface-2)]">
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider">Title</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden sm:table-cell">Author</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider hidden md:table-cell">إرسالted</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 text-[11px] font-bold text-[var(--muted)] uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="border-b border-[var(--border)] last:border-0 hover:bg-[var(--surface-2)] transition-colors">
                                <td class="py-3.5 px-4">
                                    <a href="/articles/{{ $article->slug }}" class="link font-semibold text-[13.5px] line-clamp-1">
                                        {{ $article->title }}
                                    </a>
                                </td>
                                <td class="py-3.5 px-4 text-[13px] text-[var(--text-2)] hidden sm:table-cell">
                                    {{ $article->user->name }}
                                </td>
                                <td class="py-3.5 px-4 text-[13px] text-[var(--muted)] hidden md:table-cell">
                                    {{ $article->created_at->diffForHumans() }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="badge {{ $article->status === 'pending' ? 'status-pending' : ($article->status === 'approved' ? 'status-approved' : 'status-rejected') }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="action-group">
                                        <!-- View -->
                                        <a href="/articles/{{ $article->slug }}" class="btn-sm btn-sm-view">View</a>

                                        <!-- Approve/Reject (Pending only) -->
                                        @if($article->status === 'pending')
                                            <form method="POST" action="/admin/articles/{{ $article->id }}/approve" class="inline">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-sm-success">Approve</button>
                                            </form>
                                            <form method="POST" action="/admin/articles/{{ $article->id }}/reject" class="inline">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-sm-warning">Reject</button>
                                            </form>
                                        @endif

                                        <!-- Edit -->
                                        <a href="/admin/articles/{{ $article->id }}/edit" class="btn-sm btn-sm-edit">تعديل</a>

                                        <!-- Delete -->
                                        <form method="POST" action="/admin/articles/{{ $article->id }}" onsubmit="return confirm('Delete this article?');" class="inline">
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
        @if($articles->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $articles->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-12 text-center flex flex-col items-center">
            <span class="inline-flex items-center justify-center w-14 h-14 bg-indigo-50 text-indigo-300 rounded-2xl mb-4">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </span>
            <p class="text-[15px] font-medium text-[var(--text)] mb-1">No articles found</p>
            <p class="text-[13px] text-[var(--muted)]">There are no articles matching the selected filter.</p>
        </div>
    @endif
</div>
@endsection