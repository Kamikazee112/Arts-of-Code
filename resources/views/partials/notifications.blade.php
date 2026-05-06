<!-- Notification Toast Stack -->
<div class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-2" x-data="{ show: true }">
    <!-- Flash Messages -->
    @if(session('success'))
        <div
            class="bg-white border border-[var(--border)] rounded-lg p-4 min-w-[280px] max-w-[360px] shadow-lg"
            style="border-left: 3px solid #16A34A"
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 4000)"
        >
            <div class="flex justify-between items-start">
                <span class="text-sm text-[var(--text)]">{{ session('success') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)] ml-2">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div
            class="bg-white border border-[var(--border)] rounded-lg p-4 min-w-[280px] max-w-[360px] shadow-lg"
            style="border-left: 3px solid var(--danger)"
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 4000)"
        >
            <div class="flex justify-between items-start">
                <span class="text-sm text-[var(--text)]">{{ session('error') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)] ml-2">&times;</button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div
            class="bg-white border border-[var(--border)] rounded-lg p-4 min-w-[280px] max-w-[360px] shadow-lg"
            style="border-left: 3px solid var(--accent)"
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 4000)"
        >
            <div class="flex justify-between items-start">
                <span class="text-sm text-[var(--text)]">{{ session('info') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)] ml-2">&times;</button>
            </div>
        </div>
    @endif

    <!-- User Notifications -->
    @auth
        @if(isset($notifications) && $notifications->count() > 0)
            @foreach($notifications as $notification)
                <div
                    class="bg-white border border-[var(--border)] rounded-lg p-4 min-w-[280px] max-w-[360px] shadow-lg"
                    style="border-left: 3px solid var(--accent)"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 4000)"
                >
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-sm text-[var(--text)] mb-2">
                                {{ $notification->data['message'] ?? 'Notification' }}
                            </p>
                            <form method="POST" action="/notifications/{{ $notification->id }}/read">
                                @csrf
                                <button type="submit" class="text-xs text-[var(--accent)] hover:underline">
                                    Mark as read
                                </button>
                            </form>
                        </div>
                        <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)] ml-2">&times;</button>
                    </div>
                </div>
            @endforeach
        @endif
    @endauth
</div>