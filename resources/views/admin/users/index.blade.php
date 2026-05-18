@extends('admin.layout')

@section('title', 'Users - Admin')

@section('admin-content')
<div>
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Users</h1>

    <!-- Search -->
    <form method="GET" action="/admin/users" class="mb-6">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search users..."
            class="input max-w-md"
        >
    </form>

    <!-- Users Table -->
    @if(isset($users) && $users->count() > 0)
        <div class="card overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[var(--border)]">
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Username</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Name</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Email address</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Articles</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Joined</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Status</th>
                        <th class="text-left py-3 px-4 text-[12px] text-[var(--muted)] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-[var(--border)] last:border-0">
                            <td class="py-4 px-4">
                                <a href="/users/{{ $user->username }}" class="link font-medium">
                                    {{ $user->username }}
                                </a>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                {{ $user->name }}
                            </td>
                            <td class="py-4 px-4 text-sm text-[var(--muted)]">
                                {{ $user->email }}
                            </td>
                            <td class="py-4 px-4 text-sm text-center">
                                {{ $user->articles_count ?? 0 }}
                            </td>
                            <td class="py-4 px-4 text-sm text-[var(--muted)]">
                                {{ $user->created_at->format('M Y') }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="badge {{ $user->is_blocked ?? false ? 'status-blocked' : 'status-active' }}">
                                    {{ $user->is_blocked ?? false ? 'Blocked' : 'Active' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="action-group">
                                    <!-- View Profile -->
                                    <a href="/users/{{ $user->username }}" class="btn-sm btn-sm-view">
                                        View Profile
                                    </a>

                                    <!-- Block/Unblock -->
                                    @if($user->is_blocked ?? false)
                                        <form method="POST" action="/admin/users/{{ $user->id }}/unblock" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-sm-success">
                                                Unblock
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="/admin/users/{{ $user->id }}/block" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-sm-warning">
                                                Block
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Delete Account -->
                                    <form method="POST" action="/admin/users/{{ $user->id }}" onsubmit="return confirm('Are you sure you want to delete this account?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-sm-delete">
                                            Delete Account
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
        @if($users->hasPages())
            <div class="mt-6 flex justify-center gap-4">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="card p-8 text-center text-[var(--muted)]">
            No users found.
        </div>
    @endif
</div>
@endsection