@extends('layouts.app')

@section('title', 'Create Account - Arts Of Code')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)]">
    <div class="card p-10 max-w-[400px] w-full mx-auto">
        <!-- Title -->
        <h1 class="text-[22px] font-medium text-[var(--text)] mb-2">Create Account</h1>
        <p class="text-sm text-[var(--muted)] mb-6">Join the Arts Of Code community.</p>

        <!-- Form -->
        <form method="POST" action="/register">
            @csrf

            <!-- Name Input -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Full Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="input"
                    required
                    autofocus
                >
                @error('name')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username Input -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="input"
                    required
                >
                <p class="text-xs text-[var(--muted)] mt-1">
                    Used in your public profile URL: /users/username
                </p>
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
                    value="{{ old('email') }}"
                    class="input"
                    required
                >
                @error('email')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Password</label>
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

            <!-- Confirm Password Input -->
            <div class="mb-6">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Confirm Password</label>
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

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full py-3 text-[15px]">
                Create Account
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-6 text-[14px] text-[var(--muted)]">
            Already have an account?
            <a href="/login" class="text-[var(--accent)] hover:underline">Sign In</a>
        </div>
    </div>
</div>
@endsection