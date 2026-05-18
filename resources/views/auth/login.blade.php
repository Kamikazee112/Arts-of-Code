@extends('layouts.app')

@section('title', 'Sign In - Arts Of Code')

@section('content')
    <div class="flex items-center justify-center min-h-[calc(100vh-200px)] py-12">
        <div class="w-full max-w-[400px] mx-auto">
            <!-- Brand Header -->
            <div class="text-center mb-8">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;background:var(--accent);border-radius:12px;margin-bottom:16px;">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </span>
                <h1 class="text-[24px] font-bold text-[var(--text)] tracking-tight">مرحباً بعودتك</h1>
                <p class="text-[14px] text-[var(--muted)] mt-1">سجّل الدخول إلى حسابك في Arts Of Code</p>
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

                <form method="POST" action="/login">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="البريد الإلكتروني" required autofocus>
                        @error('email')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold text-[var(--text)] mb-1.5">كلمة المرور</label>
                        <input type="password" name="password" class="input" placeholder="••••••••" required>
                        @error('password')
                            <p class="text-[12px] text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between items-center mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" style="accent-color:var(--accent);width:15px;height:15px;">
                            <span class="text-[13px] text-[var(--text-2)]">تذكرني</span>
                        </label>
                        <a href="/forgot-password" class="link text-[13px]">هل نسيت كلمة المرور؟</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full justify-center" style="padding:11px 18px;font-size:15px;">
                        تسجيل الدخول
                    </button>
                </form>
            </div>

            <!-- Register Link -->
            <p class="text-center mt-6 text-[14px] text-[var(--muted)]">
                لا تملك حساباً؟
                <a href="/register" class="link">إنشاء حساب →</a>
            </p>
        </div>
    </div>
@endsection