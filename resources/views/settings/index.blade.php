@extends('layouts.app')

@section('title', 'Settings - Arts Of Code')

@section('content')
<div class="max-w-[640px] mx-auto">
    <!-- Page Title -->
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Settings</h1>

    <!-- Section 1: Profile -->
    <section class="mb-6">
        <h2 class="text-[13px] uppercase tracking-[0.06em] text-[var(--muted)] mb-3">Profile</h2>

        <div class="card p-6">
            <form method="POST" action="/settings/profile">
                @csrf
                @method('PATCH')

                <!-- Username Input -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Username</label>
                    <input
                        type="text"
                        name="username"
                        value="{{ auth()->user()->username }}"
                        class="input"
                        required
                    >
                    @error('username')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ auth()->user()->email }}"
                        class="input"
                        required
                    >
                    @error('email')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio Textarea -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Bio</label>
                    <textarea
                        name="bio"
                        rows="3"
                        placeholder="A short bio..."
                        class="input resize-vertical"
                    >{{ auth()->user()->bio ?? '' }}</textarea>
                    @error('bio')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Success Message -->
                @if(session('profile_success'))
                    <div class="text-sm text-[#16A34A] mb-4">
                        {{ session('profile_success') }}
                    </div>
                @endif

                <button type="submit" class="btn-primary">
                    Save
                </button>
            </form>
        </div>
    </section>

    <!-- Section 2: Password -->
    <section class="mb-6">
        <h2 class="text-[13px] uppercase tracking-[0.06em] text-[var(--muted)] mb-3">Password</h2>

        <div class="card p-6">
            <form method="POST" action="/settings/password">
                @csrf
                @method('PATCH')

                <!-- Current Password -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Current Password</label>
                    <input
                        type="password"
                        name="current_password"
                        class="input"
                        required
                    >
                    @error('current_password')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">New Password</label>
                    <input
                        type="password"
                        name="password"
                        class="input"
                        required
                    >
                    @error('password')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Confirm New Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="input"
                        required
                    >
                    @error('password_confirmation')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Success Message -->
                @if(session('password_success'))
                    <div class="text-sm text-[#16A34A] mb-4">
                        {{ session('password_success') }}
                    </div>
                @endif

                <button type="submit" class="btn-primary">
                    Save
                </button>
            </form>
        </div>
    </section>

    <!-- Section 3: Danger Zone -->
    <section>
        <h2 class="text-[13px] uppercase tracking-[0.06em] text-[var(--muted)] mb-3">Danger Zone</h2>

        <div class="p-6 border border-[var(--danger)] rounded-lg" x-data="{ showConfirm: false, confirmed: false }">
            <h3 class="font-medium text-[var(--danger)] mb-2">Delete Account</h3>
            <p class="text-sm text-[var(--muted)] mb-4">
                This will permanently delete your account and all your content. This action cannot be undone.
            </p>

            @if(!session('account_deleted'))
                <div x-show="showConfirm" class="mb-4">
                    <input
                        type="text"
                        x-model="confirmed"
                        placeholder="Type DELETE to confirm"
                        class="input"
                    >
                </div>

                <button
                    @click="if (!showConfirm) { showConfirm = true } else if (confirmed === 'DELETE') { $el.closest('form').submit() }"
                    class="btn-danger"
                    :disabled="showConfirm && confirmed !== 'DELETE'"
                    x-text="showConfirm ? 'Confirm Delete' : 'Delete My Account'"
                >
                </button>
            @else
                <div class="text-sm text-[#16A34A]">
                    Your account has been deleted successfully.
                </div>
            @endif

            <form method="POST" action="/settings/account/delete" class="hidden">
                @csrf
            </form>
        </div>
    </section>
</div>
@endsection