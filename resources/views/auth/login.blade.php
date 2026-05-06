@extends('layouts.app')

@section('title', 'Sign In - Arts Of Code')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)]">
    <div class="card p-10 max-w-[400px] w-full mx-auto">
        <!-- Title -->
        <h1 class="text-[22px] font-medium text-[var(--text)] mb-6">Sign In</h1>

        <!-- Form -->
        <form method="POST" action="/login">
            @csrf

            <!-- Error Display -->
            @if($errors->any())
                <div class="mb-6 p-4 border border-[var(--danger)] rounded-lg">
                    <ul class="text-sm text-[var(--danger)]">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="input"
                    required
                    autofocus
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

            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-[var(--text)]">Remember me</span>
                </label>

                <a href="/forgot-password" class="text-sm text-[var(--accent)] hover:underline">
                    Forgot password?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full py-3 text-[15px]">
                Sign In
            </button>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-6 text-[14px] text-[var(--muted)]">
            Don't have an account?
            <a href="/register" class="text-[var(--accent)] hover:underline">Register</a>
        </div>
    </div>
</div>
@endsection