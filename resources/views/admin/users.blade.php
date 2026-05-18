@extends('layouts.app')

@section('title', 'Manage Users - Admin - Arts Of Code')

@section('content')
    <div class="max-w-[1000px] mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-[28px] font-medium text-[var(--text)]">Manage Users</h1>
            <a href="/admin/dashboard" class="text-[var(--muted)] hover:text-[var(--accent)] transition-colors">
                ← Back to Dashboard
            </a>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="card p-6">
                <div class="text-[32px] font-medium text-[var(--accent)] mb-2">{{ $users->count() }}</div>
                <div class="text-[14px] text-[var(--muted)]">Total Users</div>
            </div>
            <div class="card p-6">
                <div class="text-[32px] font-medium text-green-600 mb-2">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="text-[14px] text-[var(--muted)]">Admins</div>
            </div>
            <div class="card p-6">
                <div class="text-[32px] font-medium text-blue-600 mb-2">{{ $users->where('role', 'user')->count() }}</div>
                <div class="text-[14px] text-[var(--muted)]">Regular Users</div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form method="GET" action="/admin/users" class="flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search users by username or email..." class="input flex-1">
                <button type="submit" class="btn-primary">
                    Search
                </button>
                @if($search ?? '')
                    <a href="/admin/users" class="btn-outline">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Users List -->
        <div class="card">
            <div class="p-4 border-b border-[var(--border)]">
                <h2 class="text-[18px] font-medium text-[var(--text)]">All Users</h2>
            </div>

            @if($users->count() > 0)
                <div class="divide-y divide-[var(--border)]">
                    @foreach($users as $user)
                        <div class="p-4 flex items-center justify-between hover:bg-[var(--bg)] transition-colors">
                            <div class="flex items-center gap-4">
                                <!-- Avatar -->
                                <div
                                    class="w-10 h-10 rounded-full bg-[var(--accent)] flex items-center justify-center text-white font-medium">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>

                                <!-- User Info -->
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-[16px] font-medium text-[var(--text)]">
                                            {{ $user->username }}
                                        </h3>
                                        @if($user->role === 'admin')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">
                                                Admin
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                                User
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-[13px] text-[var(--muted)]">
                                        {{ $user->email }} · Joined {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="action-group">
                                @if($user->role === 'user')
                                    <form method="POST" action="/admin/users/{{ $user->id }}/promote"
                                        onsubmit="return confirm('Are you sure you want to promote {{ $user->username }} to admin?');">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-sm-success">
                                            Promote to Admin
                                        </button>
                                    </form>
                                @elseif($user->id !== auth()->id())
                                    <form method="POST" action="/admin/users/{{ $user->id }}/demote"
                                        onsubmit="return confirm('Are you sure you want to demote {{ $user->username }} from admin?');">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-sm-delete">
                                            Demote to User
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[12px] text-[var(--muted)]">Current admin</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center">
                    <p class="text-[var(--muted)]">No users found.</p>
                </div>
            @endif
        </div>
    </div>
@endsection