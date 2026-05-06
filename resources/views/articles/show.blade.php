@extends('layouts.app')

@section('title', $article->title . ' - Arts Of Code')

@section('styles')
<style>
    .prose-content {
        line-height: 1.8;
        font-size: 16px;
        color: var(--text);
    }

    .prose-content h2 {
        font-size: 20px;
        font-weight: 500;
        margin: 32px 0 12px;
    }

    .prose-content h3 {
        font-size: 17px;
        font-weight: 500;
        margin: 24px 0 8px;
    }

    .prose-content p {
        margin-bottom: 16px;
    }

    .prose-content a {
        color: var(--accent);
    }

    .prose-content code {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        background: #F4F4F5;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .prose-content pre {
        background: #18181B;
        color: #E4E4E7;
        padding: 20px;
        border-radius: 8px;
        overflow-x: auto;
        font-size: 13px;
        line-height: 1.6;
        margin: 24px 0;
    }

    .prose-content pre code {
        background: none;
        padding: 0;
        color: inherit;
    }

    .prose-content blockquote {
        border-left: 3px solid var(--accent);
        margin: 24px 0;
        padding-left: 16px;
        color: var(--muted);
        font-style: italic;
    }

    .prose-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 16px 0;
    }
</style>
@endsection

@section('content')
<div class="max-w-[720px] mx-auto">
    <!-- Article Header -->
    <article>
        <!-- Tags -->
        @if($article->tags->count() > 0)
            <div class="flex gap-2 mb-4">
                @foreach($article->tags as $tag)
                    <span class="badge bg-[var(--bg)] text-[var(--muted)] px-3 py-1 rounded text-sm">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Title -->
        <h1 class="text-[28px] font-medium text-[var(--text)] mb-2">
            {{ $article->title }}
        </h1>

        <!-- Meta -->
        <div class="text-[14px] text-[var(--muted)] mb-4">
            by {{ $article->user->username }} · {{ $article->created_at->format('M d, Y') }} · {{ $article->read_time ?? 5 }} min read
        </div>

        <!-- Divider -->
        <hr class="border-t border-[var(--border)] mb-8">

        <!-- Article Body -->
        <div class="prose-content">
            {!! $article->body !!}
        </div>

        <!-- Action Row -->
        @auth
            <div class="flex gap-4 my-8">
                <!-- Like Button -->
                <form method="POST" action="/articles/{{ $article->slug }}/like">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 border border-[var(--border)] rounded-lg text-sm hover:border-[var(--accent)] hover:text-[var(--accent)] transition-colors {{ $article->isLikedBy(auth()->id()) ? 'border-[var(--accent)] text-[var(--accent)] bg-[var(--bg)]' : '' }}"
                    >
                        👍 Like ({{ $article->likesCount() }})
                    </button>
                </form>

                <!-- Edit Button (Author) -->
                @if(auth()->id() === $article->user_id)
                    <a href="/articles/{{ $article->slug }}/edit" class="px-4 py-2 text-sm text-[var(--muted)] hover:text-[var(--accent)] transition-colors">
                        Edit
                    </a>
                @endif

                <!-- Delete Button (Author) -->
                @if(auth()->id() === $article->user_id)
                    <form method="POST" action="/articles/{{ $article->slug }}" onsubmit="return confirm('Are you sure you want to delete this article?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm text-[var(--danger)] hover:underline">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        @endauth
    </article>

    <!-- Comments Section -->
    <section class="mt-12">
        <h2 class="text-[16px] font-medium text-[var(--text)] mb-6">
            Comments ({{ $article->comments->count() + $article->comments->sum('replies.count') ?? 0 }})
        </h2>

        @auth
            <!-- Comment Form -->
            <form method="POST" action="/articles/{{ $article->slug }}/comments" class="mb-8">
                @csrf
                <textarea
                    name="body"
                    placeholder="Write a comment..."
                    class="input min-h-[80px] resize-vertical"
                    required
                ></textarea>
                <button type="submit" class="btn-primary mt-3">
                    Post Comment
                </button>
            </form>
        @else
            <p class="text-[var(--muted)] mb-8">
                <a href="/login" class="link">Login</a> to leave a comment.
            </p>
        @endauth

        <!-- Comments List -->
        @if($article->comments->count() > 0)
            <div class="space-y-6">
                @foreach($article->comments as $comment)
                    <div class="card p-4">
                        <!-- Comment Header -->
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-[var(--text)]">
                                    {{ $comment->user->username }}
                                </span>
                                <span class="text-xs text-[var(--muted)]">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            @if(auth()->id() === $comment->user_id)
                                <form method="POST" action="/comments/{{ $comment->id }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-[var(--danger)] hover:underline">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Comment Body -->
                        <p class="text-sm text-[var(--text)] mb-3">
                            {{ $comment->body }}
                        </p>

                        <!-- Reply Button -->
                        @auth
                            <button
                                x-data="{ showReplyForm: false }"
                                @click="showReplyForm = !showReplyForm"
                                class="text-xs text-[var(--accent)] hover:underline"
                            >
                                Reply
                            </button>

                            <!-- Reply Form -->
                            <div x-show="showReplyForm" class="mt-3">
                                <form method="POST" action="/articles/{{ $article->slug }}/comments">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea
                                        name="body"
                                        placeholder="Write a reply..."
                                        class="input min-h-[60px] resize-vertical"
                                        required
                                    ></textarea>
                                    <button type="submit" class="btn-primary mt-2 text-sm">
                                        Reply
                                    </button>
                                </form>
                            </div>
                        @endauth

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-3 pl-4 border-l-2 border-[var(--border)]">
                                @foreach($comment->replies as $reply)
                                    <div class="flex items-start gap-2">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-sm font-medium text-[var(--text)]">
                                                    {{ $reply->user->username }}
                                                </span>
                                                <span class="text-xs text-[var(--muted)]">
                                                    {{ $reply->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-[var(--text)]">
                                                {{ $reply->body }}
                                            </p>
                                            @if(auth()->id() === $reply->user_id)
                                                <form method="POST" action="/comments/{{ $reply->id }}" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-[var(--danger)] hover:underline mt-1">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-[var(--muted)] text-center py-8">
                No comments yet. Be the first to comment!
            </div>
        @endif
    </section>
</div>
@endsection