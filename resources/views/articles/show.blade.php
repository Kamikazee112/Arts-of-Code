@extends('layouts.app')

@section('title', $article->title . ' - Arts Of Code')

@section('styles')
    <style>
        .prose-content {
            line-height: 1.95;
            font-size: 16.5px;
            color: #334155; /* Slate-700 for premium readability */
            font-family: 'Inter', -apple-system, sans-serif;
        }

        .prose-content h2 {
            font-size: 22px;
            font-weight: 800;
            color: #1e293b;
            margin: 36px 0 16px;
            letter-spacing: -0.025em;
        }

        .prose-content h3 {
            font-size: 18px;
            font-weight: 700;
            color: #334155;
            margin: 28px 0 12px;
        }

        .prose-content p {
            margin-bottom: 20px;
        }

        .prose-content a {
            color: var(--accent);
            text-decoration: underline;
            font-weight: 600;
        }

        .prose-content code {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 14px;
            background: #f1f5f9;
            color: #0f172a;
            padding: 3px 7px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .prose-content pre {
            background: #0f172a;
            color: #f8fafc;
            padding: 24px;
            border-radius: 14px;
            overflow-x: auto;
            font-size: 14px;
            line-height: 1.65;
            margin: 28px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #1e293b;
        }

        .prose-content pre code {
            background: none;
            padding: 0;
            color: inherit;
            border: none;
        }

        .prose-content blockquote {
            border-left: 4px solid var(--accent);
            margin: 32px 0;
            padding: 8px 0 8px 20px;
            color: #64748b;
            font-style: italic;
            font-size: 17px;
            background: #f8fafc;
            border-radius: 0 8px 8px 0;
        }

        .prose-content img {
            max-width: 100%;
            border-radius: 12px;
            margin: 28px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto animate-fade-up">
        
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="/articles" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[var(--accent)] hover:text-[var(--accent-hover)] transition-colors">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Tech Articles
            </a>
        </div>

        <!-- Article Card Body -->
        <article class="card p-8 md:p-12 shadow-xl bg-white relative overflow-hidden mb-10">
            <!-- Subtle accent top strip -->
            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

            <!-- Tags -->
            @if($article->categories->count() > 0)
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($article->categories as $cat)
                        <span class="inline-flex items-center gap-1.5 badge badge-default text-[11px] px-3 py-1 font-bold uppercase shadow-sm">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $cat->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Title -->
            <h1 class="text-[32px] md:text-[38px] font-extrabold text-[#0f172a] leading-tight tracking-tight mb-4">
                {{ $article->title }}
            </h1>

            <!-- Meta Header Row -->
            <div class="flex items-center gap-3.5 mb-8 pb-6 border-b border-slate-100">
                <!-- User Initials Circle -->
                <span class="inline-flex items-center justify-center w-10 h-10 bg-slate-100 rounded-full text-[13px] font-extrabold text-slate-600 uppercase border border-slate-200">
                    {{ substr($article->user->username, 0, 1) }}
                </span>
                <div>
                    <span class="block text-[14.5px] font-bold text-slate-800 leading-none mb-1">
                        by {{ $article->user->username }}
                    </span>
                    <span class="block text-[12.5px] font-semibold text-slate-400 inline-flex items-center gap-1">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Published {{ $article->created_at->format('M d, Y') }} • {{ $article->read_time ?? 5 }} min read
                    </span>
                </div>
            </div>

            <!-- Article Body -->
            <div class="prose-content">
                {!! $article->body !!}
            </div>

            <!-- Redesigned Action Row (Likes & Author Management) -->
            <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-100 pt-8 mt-10">
                @auth
                    <!-- Like Section -->
                    <form method="POST" action="/articles/{{ $article->slug }}/like" class="inline">
                        @csrf
                        @if($article->isLikedBy(auth()->id()))
                            <button type="submit" class="btn-sm font-bold flex items-center gap-1.5 px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white transition-colors" style="border-radius: 8px; color: white !important;">
                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" class="text-white">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                Liked ({{ $article->likesCount() }})
                            </button>
                        @else
                            <button type="submit" class="btn-sm font-bold flex items-center gap-1.5 px-5 py-2.5 bg-slate-600 hover:bg-slate-700 text-white transition-colors" style="border-radius: 8px; color: white !important;">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Like ({{ $article->likesCount() }})
                            </button>
                        @endif
                    </form>

                    <!-- Author Action Row -->
                    @if(auth()->id() === $article->user_id)
                        <div class="flex items-center gap-2">
                            <!-- Edit Button -->
                            <a href="/articles/{{ $article->slug }}/edit" class="btn-sm btn-sm-edit font-bold px-4 py-2.5 flex items-center gap-1.5" style="border-radius: 10px;">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form method="POST" action="/articles/{{ $article->slug }}"
                                onsubmit="return confirm('Are you sure you want to delete this article?');"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-sm-delete font-bold px-4 py-2.5 flex items-center gap-1.5" style="border-radius: 10px;">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl text-[13.5px] text-slate-500 font-semibold w-full text-center inline-flex items-center justify-center gap-2">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <a href="/login" class="text-indigo-600 underline">Log In</a> to like or manage this article.
                    </div>
                @endauth
            </div>
        </article>

        <!-- Comments Section -->
        <section class="mt-12">
            <div class="flex items-center gap-2.5 mb-6">
                <span class="inline-flex items-center justify-center w-8 h-8 bg-indigo-50 text-indigo-500 rounded-lg">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </span>
                <h2 class="text-[18px] font-extrabold text-slate-800">
                    Discussion ({{ $article->comments->count() + $article->comments->sum('replies.count') ?? 0 }})
                </h2>
            </div>

            @auth
                <!-- Comment Input Card -->
                <div class="card p-5 bg-white border border-slate-200/60 shadow-md mb-8">
                    <form method="POST" action="/articles/{{ $article->slug }}/comments">
                        @csrf
                        <textarea
                            name="body"
                            placeholder="Add to the discussion... Be constructive and kind!"
                            class="input min-h-[90px] resize-vertical text-[14px] py-3 px-4"
                            style="border-radius: 10px;"
                            required
                        ></textarea>
                        <button type="submit" class="btn-primary font-bold px-5 py-2.5 mt-3 flex items-center gap-1" style="border-radius: 8px;">
                            Post Comment
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <div class="card p-6 text-center bg-slate-50 border-dashed border-2 border-slate-200 mb-8 rounded-xl">
                    <p class="text-slate-500 font-semibold text-[14px] inline-flex items-center gap-2">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        You must be <a href="/login" class="text-indigo-600 underline ml-1 mr-1">Logged in</a> to share comments or join the discussion.
                    </p>
                </div>
            @endauth

            <!-- Comments List -->
            @if($article->comments->count() > 0)
                <div class="space-y-5">
                    @foreach($article->comments as $comment)
                        <div class="card p-5 md:p-6 bg-white border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-200">
                            <!-- Comment Header -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <!-- User Initials Circle -->
                                    <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 rounded-full text-[10px] font-extrabold text-slate-600 uppercase border border-slate-200">
                                        {{ substr($comment->user->username, 0, 1) }}
                                    </span>
                                    <span class="text-[14px] font-bold text-slate-800">
                                        {{ $comment->user->username }}
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-[12px] font-semibold text-slate-400">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <p class="text-[14.5px] text-slate-700 leading-relaxed pl-1 mb-4">
                                {{ $comment->body }}
                            </p>

                            <!-- Interactive Actions (Reply & Delete) -->
                            <div x-data="{ showReplyForm: false }">
                                <div class="flex items-center gap-2 mt-2">
                                    @auth
                                        <button @click="showReplyForm = !showReplyForm"
                                            class="btn-sm btn-sm-edit font-bold px-3 py-1.5 flex items-center gap-1 text-[11.5px]" style="border-radius: 6px;">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                            Reply
                                        </button>
                                    @endauth

                                    @if(auth()->id() === $comment->user_id)
                                        <form method="POST" action="/comments/{{ $comment->id }}"
                                            onsubmit="return confirm('Are you sure you want to delete this comment?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-sm-delete font-bold px-3 py-1.5 flex items-center gap-1 text-[11.5px]" style="border-radius: 6px;">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <!-- Nested Reply Input Box -->
                                @auth
                                    <div x-show="showReplyForm" x-transition.duration.250ms class="mt-4 pl-4 border-l-2 border-indigo-100">
                                        <form method="POST" action="/articles/{{ $article->slug }}/comments">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <textarea
                                                name="body"
                                                placeholder="Write your constructive reply..."
                                                class="input min-h-[70px] resize-vertical text-[13.5px] py-2.5 px-3.5"
                                                style="border-radius: 8px;"
                                                required
                                            ></textarea>
                                            <button type="submit" class="btn-primary mt-2 text-xs font-bold px-4 py-2" style="border-radius: 6px;">
                                                Submit Reply
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>

                            <!-- Nested Replies Container -->
                            @if($comment->replies->count() > 0)
                                <div class="mt-5 space-y-4 pl-4 border-l-2 border-indigo-100 ml-2">
                                    @foreach($comment->replies as $reply)
                                        <div class="flex items-start gap-2.5 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100">
                                            <div class="flex-1">
                                                <!-- Reply Header -->
                                                <div class="flex items-center gap-2 mb-2">
                                                    <!-- Initials -->
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-slate-100 rounded-full text-[9px] font-extrabold text-slate-600 uppercase border border-slate-200">
                                                        {{ substr($reply->user->username, 0, 1) }}
                                                    </span>
                                                    <span class="text-[13px] font-bold text-slate-800">
                                                        {{ $reply->user->username }}
                                                    </span>
                                                    <span class="text-slate-300">•</span>
                                                    <span class="text-[11.5px] font-semibold text-slate-400">
                                                        {{ $reply->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Reply Body -->
                                                <p class="text-[13.5px] text-slate-700 leading-relaxed pl-1">
                                                    {{ $reply->body }}
                                                </p>
                                                
                                                <!-- Reply Delete Form -->
                                                @if(auth()->id() === $reply->user_id)
                                                    <form method="POST" action="/comments/{{ $reply->id }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this reply?');"
                                                        class="inline-block mt-2.5">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-sm btn-sm-delete font-bold px-2.5 py-1 flex items-center gap-1 text-[10.5px]" style="border-radius: 6px;">
                                                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="text-white">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
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
                <div class="card p-10 text-center bg-slate-50/50 border border-slate-200/60 rounded-2xl">
                    <span class="inline-flex items-center justify-center w-14 h-14 bg-indigo-50 text-indigo-300 rounded-2xl mb-3">
                        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </span>
                    <p class="text-slate-400 font-semibold text-sm">No comments yet. Be the first to start the discussion!</p>
                </div>
            @endif
        </section>
    </div>
@endsection