<div class="w-[260px] shrink-0 bg-[var(--surface)] border-r border-[var(--border)] min-h-[calc(100vh-60px)] sticky top-[60px] overflow-y-auto">
    <div class="p-5">
        <h2 class="section-label mb-4">Learning Path</h2>

        @php
            $categories = \App\Models\Category::with([
                'articles' => function ($query) {
                    $query->where('status', 'published');
                },
                'exams'
            ])->get();
            $user = auth()->user();
        @endphp

        @if($categories->count() > 0)
            <div class="space-y-3">
                @foreach($categories as $category)
                    @php
                        if ($user) {
                            $status = $category->getCompletionStatusForUser($user->id);
                        } else {
                            $status = [
                                'total'       => $category->articles->count() + $category->exams->count(),
                                'completed'   => 0,
                                'percentage'  => 0,
                                'is_complete' => false,
                            ];
                        }
                        $pct = $status['percentage'] ?? 0;
                    @endphp

                    <div class="rounded-xl border border-[var(--border)] overflow-hidden bg-[var(--surface-2)] hover:border-[var(--border-2)] transition-colors">
                        <!-- Category Header -->
                        <a href="/categories/{{ $category->slug }}"
                            class="flex items-center justify-between p-3 hover:bg-[var(--bg)] transition-colors">
                            <div class="flex items-center gap-2 min-w-0">
                                @if($status['is_complete'])
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;background:var(--success-bg);border-radius:99px;flex-shrink:0;">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="var(--success)" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                @else
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;background:var(--accent-light);border-radius:99px;flex-shrink:0;">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="var(--accent)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </span>
                                @endif
                                <h3 class="text-[13px] font-semibold text-[var(--text)] truncate">{{ $category->name }}</h3>
                            </div>
                            @if($user)
                                <span class="text-[11px] font-medium text-[var(--muted)] shrink-0 ml-2">{{ $status['completed'] }}/{{ $status['total'] }}</span>
                            @endif
                        </a>

                        @if($user && $status['total'] > 0)
                            <!-- Progress bar -->
                            <div style="height:3px;background:var(--border);margin:0 12px 10px;">
                                <div style="height:100%;width:{{ $pct }}%;background:{{ $status['is_complete'] ? 'var(--success)' : 'var(--accent)' }};border-radius:99px;transition:width 0.4s ease;"></div>
                            </div>
                        @endif

                        <!-- Articles Section -->
                        @if($category->articles->count() > 0)
                            <div class="px-3 pb-2">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[var(--muted)] mb-1.5">Articles</p>
                                <div class="space-y-1">
                                    @foreach($category->articles as $article)
                                        @php $isCompleted = $user ? $article->isCompletedBy($user->id) : false; @endphp
                                        <div class="flex items-center justify-between gap-1">
                                            <a href="/articles/{{ $article->slug }}"
                                                class="text-[12px] text-[var(--text-2)] hover:text-[var(--accent)] truncate flex-1 py-0.5 transition-colors"
                                                title="{{ $article->title }}">
                                                {{ Str::limit($article->title, 22) }}
                                            </a>
                                            @if($isCompleted)
                                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="var(--success)" stroke-width="2.5" class="shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            @elseif($user)
                                                <form method="POST" action="/articles/{{ $article->id }}/complete">
                                                    @csrf
                                                    <button type="submit" class="text-[10px] text-[var(--accent)] hover:underline shrink-0 font-medium">✓</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Exams Section -->
                        @if($category->exams->count() > 0)
                            <div class="px-3 pb-3 {{ $category->articles->count() > 0 ? 'pt-2 border-t border-[var(--border)]' : '' }}">
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-[var(--muted)] mb-1.5">Quizzes</p>
                                <div class="space-y-1">
                                    @foreach($category->exams as $exam)
                                        @php $isCompleted = $user ? $exam->isCompletedBy($user->id) : false; @endphp
                                        <div class="flex items-center justify-between gap-1">
                                            <a href="/exams/{{ $exam->id }}"
                                                class="text-[12px] text-[var(--text-2)] hover:text-[var(--accent)] truncate flex-1 py-0.5 transition-colors"
                                                title="{{ $exam->title }}">
                                                {{ Str::limit($exam->title, 22) }}
                                            </a>
                                            @if($isCompleted)
                                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="var(--success)" stroke-width="2.5" class="shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10 text-[var(--muted)]">
                <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mx-auto mb-2 opacity-40"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <p class="text-[12px]">No paths available</p>
            </div>
        @endif

        @guest
            <div class="mt-5 p-3.5 bg-[var(--accent-light)] rounded-xl border border-[var(--border)]">
                <p class="text-[12px] text-[var(--accent)] font-medium mb-1">Track your progress</p>
                <p class="text-[11px] text-[var(--muted)]">
                    <a href="/login" class="link">Login</a> to mark articles complete and monitor learning.
                </p>
            </div>
        @endguest
    </div>
</div>