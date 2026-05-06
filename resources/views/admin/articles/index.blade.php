@extends('admin.layout')

@section('title', 'Articles - Admin')

@section('admin-content')
<div>
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Articles</h1>

    <!-- Filter Tabs -->
    <div class="flex gap-6 mb-6 border-b border-[var(--border)]">
        <a
            href="/admin/articles"
            class="pb-2 text-sm {{ !request()->has('status') ? 'text-[var(--accent)] border-b-2 border-[var(--accent)]' : 'text-[var(--muted)]' }}"
        >
            All
        </a>
        <a
            href="/admin/articles?status=pending"
            class="pb-2 text-sm {{ request('status') === 'pending' ? 'text-[var(--accent)] border-b-2 border-[var(--accent)]' : 'text-[var(--muted)]' }}"
        >
            Pending
        </a>
        <a
            href="/admin/articles?status=approved"
            class="pb-2 text-sm {{ request('status') === 'approved' ? 'text-[var(--accent)] border-b-2 border-[var(--accent)]' : 'text-[var(--muted)]' }}"
        >
            Approved
        </a>
        <a
            href="/admin/articles?status=rejected"
            class="pb-2 text-sm {{ request('status') === 'rejected' ? 'text-[var(--accent)] border-b-2 border-[var(--accent)]' : 'text-[var(--muted)]' }}"
        >
            Rejected
        </a>
    </div>

    <!-- Articles Table -->
    @if(isset($articles) && $articles->count() > 0)
        <div class="card overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[var(--border)]">
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Title</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Author</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Submitted</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Status</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr class="border-b border-[var(--border)] last:border-0">
                            <td class="py-4 px-4">
                                <a href="/articles/{{ $article->slug }}" class="link font-medium">
                                    {{ $article->title }}
                                </a>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                {{ $article->user->name }}
                            </td>
                            <td class="py-4 px-4 text-sm text-[var(--muted)]">
                                {{ $article->created_at->diffForHumans() }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="badge {{ $article->status === 'pending' ? 'status-pending' : ($article->status === 'approved' ? 'status-approved' : 'status-rejected') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <!-- View -->
                                    <a href="/articles/{{ $article->slug }}" class="text-sm text-[var(--accent)] hover:underline">
                                        View
                                    </a>

                                    <!-- Approve/Reject (Pending only) -->
                                    @if($article->status === 'pending')
                                        <form method="POST" action="/admin/articles/{{ $article->id }}/approve" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-success text-xs py-1 px-2">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/articles/{{ $article->id }}/reject" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-danger text-xs py-1 px-2">
                                                Reject
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Edit -->
                                    <a href="/admin/articles/{{ $article->id }}/edit" class="text-sm text-[var(--muted)] hover:text-[var(--accent)]">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form method="POST" action="/admin/articles/{{ $article->id }}" onsubmit="return confirm('Are you sure you want to delete this article?');" class="inline">
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
        @if($articles->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $articles->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-8 text-center text-[var(--muted)]">
            No articles found.
        </div>
    @endif
</div>
@endsection