<div class="w-64 bg-[var(--surface)] border-r border-[var(--border)] h-screen sticky top-14 overflow-y-auto">
    <div class="p-4">
        <h2 class="text-[16px] font-medium text-[var(--text)] mb-4">Categories</h2>

        @php
            $categories = \App\Models\Category::with(['articles' => function($query) {
                $query->where('status', 'published');
            }, 'exams'])->get();
            $user = auth()->user();
        @endphp

        @if($categories->count() > 0)
            <div class="space-y-4">
                @foreach($categories as $category)
                    @php
                        if($user) {
                            $status = $category->getCompletionStatusForUser($user->id);
                        } else {
                            $status = [
                                'total' => $category->articles->count() + $category->exams->count(),
                                'completed' => 0,
                                'percentage' => 0,
                                'is_complete' => false,
                            ];
                        }
                    @endphp

                    <div class="border border-[var(--border)] rounded-lg overflow-hidden">
                        <!-- Category Header -->
                        <a href="/categories/{{ $category->slug }}"
                           class="block p-3 bg-[var(--bg)] border-b border-[var(--border)] hover:bg-[var(--border)] transition-colors">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-[14px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                                        {{ $category->name }}
                                    </h3>
                                    @if($status['is_complete'])
                                        <span class="text-green-600">✓</span>
                                    @endif
                                </div>
                                @if($user)
                                    <div class="text-[12px] text-[var(--muted)]">
                                        {{ $status['completed'] }}/{{ $status['total'] }}
                                    </div>
                                @endif
                            </div>
                        </a>

                        <!-- Articles Section -->
                        @if($category->articles->count() > 0)
                            <div class="p-3 border-b border-[var(--border)]">
                                <h4 class="text-[13px] font-medium text-[var(--text)] mb-2">Articles</h4>
                                <div class="space-y-2">
                                    @foreach($category->articles as $article)
                                        @php
                                            $isCompleted = $user ? $article->isCompletedBy($user->id) : false;
                                        @endphp
                                        <div class="flex items-center justify-between text-[12px]">
                                            <a href="/articles/{{ $article->slug }}"
                                               class="text-[var(--text)] hover:text-[var(--accent)] truncate flex-1"
                                               title="{{ $article->title }}">
                                                {{ Str::limit($article->title, 20) }}
                                            </a>
                                            @if($isCompleted)
                                                <span class="text-green-600 ml-2">✓</span>
                                            @elseif($user)
                                                <form method="POST" action="/articles/{{ $article->id }}/complete" class="ml-2">
                                                    @csrf
                                                    <button type="submit" class="text-[var(--accent)] hover:underline text-xs">
                                                        Mark Complete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Exams Section -->
                        @if($category->exams->count() > 0)
                            <div class="p-3">
                                <h4 class="text-[13px] font-medium text-[var(--text)] mb-2">Exams</h4>
                                <div class="space-y-2">
                                    @foreach($category->exams as $exam)
                                        @php
                                            $isCompleted = $user ? $exam->isCompletedBy($user->id) : false;
                                        @endphp
                                        <div class="flex items-center justify-between text-[12px]">
                                            <a href="/exams/{{ $exam->id }}"
                                               class="text-[var(--text)] hover:text-[var(--accent)] truncate flex-1"
                                               title="{{ $exam->title }}">
                                                {{ Str::limit($exam->title, 20) }}
                                            </a>
                                            @if($isCompleted)
                                                <span class="text-green-600 ml-2">✓</span>
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
            <div class="text-center py-8 text-[var(--muted)]">
                No categories available
            </div>
        @endif

        @guest
            <div class="mt-4 p-3 bg-[var(--bg)] rounded-lg text-center">
                <p class="text-[12px] text-[var(--muted)] mb-2">
                    <a href="/login" class="text-[var(--accent)] hover:underline">Login</a> to track your progress
                </p>
            </div>
        @endguest
    </div>
</div>