@extends('layouts.app')

@section('title', 'Create Account - Arts Of Code')

@section('content')
    <div class="flex items-center justify-center min-h-[calc(100vh-200px)] py-12">
        <div class="w-full max-w-[420px] mx-auto">
            <!-- Brand Header -->
            <div class="text-center mb-8">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;background:var(--accent);border-radius:12px;margin-bottom:16px;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </span>
                <h1 class="text-[24px] font-bold text-[var(--text)] tracking-tight">Create your account</h1>
                <p class="text-[14px] text-[var(--muted)] mt-1">Join the Arts Of Code community</p>
            </div>

            <div class="card p-8">
                <!-- Error Display -->
                @if($errors->any())
                    <div class="flash-message flash-error mb-6">
                        <div>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="/register">
                    @csrf

                    <!-- Name Input -->
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="input" placeholder="John Doe" required autofocus>
                        @error('name')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username Input -->
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="input" placeholder="johndoe" required>
                        <p class="text-[11px] text-[var(--muted)] mt-1.5">
                            Used in your public profile URL: /users/<em>username</em>
                        </p>
                        @error('username')
                            <p class="text-[12px] text-[var(--danger)] mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="you@example.com" required>
                        @error('email')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">Password</label>
                        <input type="password" name="password" class="input" placeholder="Min. 8 characters" required>
                        @error('password')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-6">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input" placeholder="••••••••" required>
                        @error('password_confirmation')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full justify-center" style="padding:11px 18px;font-size:15px;">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- Login Link -->
            <p class="text-center mt-6 text-[14px] text-[var(--muted)]">
                Already have an account?
                <a href="/login" class="link">Sign in →</a>
            </p>
        </div>
    </div>
@endsection