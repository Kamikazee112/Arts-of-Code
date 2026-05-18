@extends('layouts.app')

@section('title', 'Articles - Arts Of Code')

@section('content')
    <div class="max-w-[900px] mx-auto animate-fade-up">
        
        <!-- Page Title Row -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10 pb-6 border-b border-[var(--border)]">
            <div>
                <div class="flex items-center gap-3.5 mb-1.5">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--accent-light);border-radius:10px;color:var(--accent);">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </span>
                    <h1 class="text-[26px] font-bold text-[var(--text)] tracking-tight">Tech المقالات</h1>
                </div>
                <p class="text-[14.5px] text-[var(--muted)]">
                    Explore deep-dives, coding tutorials, and tech insights from the community.
                </p>
            </div>
            @auth
                <a href="/articles/create" class="btn-primary" style="padding: 10px 20px; font-size: 13.5px; border-radius: 10px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Write Article
                </a>
            @endauth
        </div>

        <!-- Search and Filter Bar -->
        <div class="mb-10">
            <form method="GET" action="/articles" class="mb-6 flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="بحث articles..."
                    class="input flex-1 py-3 px-4 text-sm" style="border-radius: 10px;">
                <button type="submit" class="btn-primary font-bold px-6 py-3" style="border-radius: 10px;">
                    Search
                </button>
                @if($search ?? '')
                    <a href="/articles" class="btn-outline font-bold px-5 py-3 hover:bg-slate-50" style="border-radius: 10px; border-color: slate-300; color: slate-600 !important;">
                        Clear
                    </a>
                @endif
            </form>

            <!-- Styled Filter Chips -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="flex flex-wrap gap-2.5 items-center">
                    <span class="text-[12.5px] font-bold text-slate-400 uppercase tracking-wider mr-2">Filters:</span>
                    <a href="/articles"
                        class="badge rounded-full text-[12.5px] px-4 py-1.5 font-bold transition-all shadow-sm {{ !isset($selectedCategory) ? 'bg-[var(--accent)] text-white border-[var(--accent)]' : 'bg-white text-slate-500 border border-slate-200 hover:border-indigo-400 hover:text-indigo-600' }}">
                        All Articles
                    </a>

                    @foreach($categories as $category)
                        <a href="/articles?category={{ $category->slug }}"
                            class="badge rounded-full text-[12.5px] px-4 py-1.5 font-bold transition-all shadow-sm {{ ($selectedCategory ?? '') === $category->slug ? 'bg-[var(--accent)] text-white border-[var(--accent)]' : 'bg-white text-slate-500 border border-slate-200 hover:border-indigo-400 hover:text-indigo-600' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Article List -->
        @if(isset($articles) && $articles->count() > 0)
            <div class="grid grid-cols-1 gap-6">
                @foreach($articles as $article)
                    <div class="card card-hover p-6 md:p-8 flex flex-col justify-between relative overflow-hidden transition-all duration-300" style="border-left: 4px solid var(--accent);">
                        <div>
                            <!-- Author & Date Header Row -->
                            <div class="flex flex-wrap items-center justify-between gap-2.5 mb-4">
                                <div class="flex items-center gap-2">
                                    <!-- User Avatar Circle -->
                                    <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 rounded-full text-[11px] font-bold text-slate-600 uppercase border border-slate-200">
                                        {{ substr($article->user->username, 0, 1) }}
                                    </span>
                                    <span class="text-[13.5px] font-bold text-slate-700">
                                        {{ $article->user->username }}
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-[12.5px] font-semibold text-slate-400">
                                        {{ $article->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <!-- Meta Tags Row (Comments & Likes) -->
                                <div class="flex gap-2">
                                    <span class="badge badge-muted text-[10.5px] px-2.5 py-1 flex items-center gap-1 font-bold">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        {{ $article->comments->count() }} {{ $article->comments->count() === 1 ? 'Comment' : 'Comments' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Article Title -->
                            <a href="/articles/{{ $article->slug }}"
                                class="text-[21px] font-extrabold text-[var(--text)] hover:text-[var(--accent)] transition-all block mb-3 leading-tight tracking-tight">
                                {{ $article->title }}
                            </a>

                            <!-- Excerpt Text -->
                            <p class="text-[14px] text-slate-600 leading-relaxed mb-5 max-w-[760px]">
                                {{ Str::limit(strip_tags($article->body), 160) }}
                            </p>
                        </div>

                        <!-- Card Footer Row (Categories & Read Button) -->
                        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-100 pt-4 mt-2">
                            <!-- Category Pill Badges -->
                            <div class="flex flex-wrap gap-1.5">
                                @if($article->categories->count() > 0)
                                    @foreach($article->categories as $cat)
                                        <span class="inline-flex items-center gap-1 badge badge-default text-[10.5px] px-2.5 py-0.5 font-bold uppercase shadow-sm">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $cat->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge badge-muted text-[10.5px] px-2.5 py-0.5 font-bold uppercase">
                                        Uncategorized
                                    </span>
                                @endif
                            </div>

                            <!-- Read Button -->
                            <a href="/articles/{{ $article->slug }}" class="inline-flex items-center gap-1 text-[13.5px] font-extrabold text-[var(--accent)] hover:text-[var(--accent-hover)] transition-all">
                                Read Article
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="transition-transform group-hover:translate-x-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card p-12 text-center flex flex-col items-center justify-center border-dashed border-2">
                <span class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 text-indigo-300 rounded-2xl mb-4">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </span>
                <h3 class="text-xl font-bold text-[var(--text)] mb-2">No المقالات Found</h3>
                <p class="text-sm text-[var(--muted)] max-w-sm mb-6">There are no published tech posts matching your criteria. Be the first to share your knowledge!</p>
                @auth
                    <a href="/articles/create" class="btn-primary font-bold px-6 py-3" style="border-radius: 10px;">
                        Write Your First Article
                    </a>
                @endauth
            </div>
        @endif
    </div>
@endsection