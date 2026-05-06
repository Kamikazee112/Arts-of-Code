@extends('layouts.app')

@section('title', 'Articles - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title Row -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[22px] font-medium text-[var(--text)]">Articles</h1>

        @auth
            <a href="/articles/create" class="btn-outline">
                Write Article
            </a>
        @endauth
    </div>

    <!-- Search and Filter Bar -->
    <div class="mb-8">
        <form method="GET" action="/articles" class="mb-4 flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Search articles..."
                class="input flex-1"
            >
            <button type="submit" class="btn-primary">
                Search
            </button>
            @if($search ?? '')
                <a href="/articles" class="btn-outline">
                    Clear
                </a>
            @endif
        </form>

        @if(isset($categories) && $categories->count() > 0)
            <div class="flex flex-wrap gap-2">
                <a href="/articles" class="badge rounded-full border border-[var(--border)] text-[13px] px-3 py-1 {{ !isset($selectedCategory) ? 'bg-[var(--accent)] text-white border-[var(--accent)]' : 'bg-white text-[var(--muted)]' }}">
                    All
                </a>

                @foreach($categories as $category)
                    <a
                        href="/articles?category={{ $category->slug }}"
                        class="badge rounded-full border border-[var(--border)] text-[13px] px-3 py-1 {{ ($selectedCategory ?? '') === $category->slug ? 'bg-[var(--accent)] text-white border-[var(--accent)]' : 'bg-white text-[var(--muted)]' }}"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Article List -->
    @if(isset($articles) && $articles->count() > 0)
        <div class="space-y-0">
            @foreach($articles as $article)
                <div class="py-5 border-b border-[var(--border)] last:border-0">
                    <a href="/articles/{{ $article->slug }}" class="text-[17px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors block mb-2">
                        {{ $article->title }}
                    </a>
                    <p class="text-[13px] text-[var(--muted)]">
                        by {{ $article->user->username }} · {{ $article->created_at->diffForHumans() }}
                        @if($article->categories->count() > 0)
                            · {{ $article->categories->pluck('name')->implode(', ') }}
                        @endif
                        @if($article->comments->count() > 0)
                            · {{ $article->comments->count() }} {{ $article->comments->count() === 1 ? 'comment' : 'comments' }}
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-[var(--muted)]">
                @if($search || $selectedCategory)
                    No articles found matching your search.
                @else
                    No articles found.
                @endif
            </p>
        </div>
    @endif
</div>
@endsection