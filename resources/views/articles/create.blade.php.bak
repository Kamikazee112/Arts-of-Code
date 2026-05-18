@extends('layouts.app')

@section('title', 'Write Article - Arts Of Code')

@section('content')
    <div class="max-w-[850px] mx-auto animate-fade-up">
        
        <!-- Breadcrumb Navigation -->
        <div class="mb-6">
            <div class="flex items-center gap-2">
                <a href="/" class="text-sm font-semibold text-[var(--accent)] hover:underline">الرئيسية</a>
                <span class="text-slate-300">/</span>
                <a href="/articles" class="text-sm font-semibold text-[var(--accent)] hover:underline">المقالات</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-slate-500">Write Article</span>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-[32px] md:text-[36px] font-extrabold text-[#0f172a] tracking-tight leading-none mb-2 flex items-center gap-3">
                Write Article
                <span class="inline-flex items-center justify-center w-9 h-9 bg-indigo-100 text-indigo-500 rounded-xl">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </span>
            </h1>
            <p class="text-[14.5px] font-semibold text-slate-400">
                Share your expertise, create premium tutorials, and inspire the coder community!
            </p>
        </div>

        <!-- Form Wrapper -->
        <div class="card p-6 md:p-8 bg-white border border-slate-200/60 shadow-lg rounded-2xl relative overflow-hidden mb-10">
            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

            <form method="POST" action="/articles">
                @csrf

                <!-- Error Display -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl">
                        <div class="flex items-center gap-2 mb-2 text-rose-700">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="font-extrabold text-sm">Please correct the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-[13px] text-rose-600 font-bold space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Article Title Input -->
                <div class="mb-8">
                    <label class="block text-[13px] font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Article Title
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter an eye-catching title..."
                        class="w-full bg-slate-50/50 border border-slate-200 rounded-xl py-3.5 px-4 text-[17px] font-extrabold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 outline-none" required>
                    @error('title')
                        <p class="text-sm text-rose-600 font-bold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categories Grid Selection -->
                <div class="mb-8">
                    <label class="block text-[13px] font-extrabold text-slate-700 uppercase tracking-wider mb-3">
                        Select Categories
                    </label>
                    
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    
                    @if($categories->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($categories as $category)
                                @php
                                    $isChecked = in_array($category->id, old('categories', []));
                                @endphp
                                <label x-data="{ checked: {{ $isChecked ? 'true' : 'false' }} }" 
                                    :class="checked ? 'border-indigo-600 bg-indigo-50/20 shadow-sm' : 'border-slate-200 bg-white hover:bg-slate-50'"
                                    class="relative flex items-center justify-between p-3.5 rounded-xl border cursor-pointer transition-all duration-200 select-none group">
                                    
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                        @change="checked = $el.checked"
                                        {{ $isChecked ? 'checked' : '' }} 
                                        class="sr-only">
                                    
                                    <div class="flex items-center gap-3">
                                        <!-- Folder Icon Container -->
                                        <div :class="checked ? 'bg-indigo-100 border-indigo-200 text-indigo-600' : 'bg-slate-100 border-slate-200 text-slate-500'"
                                            class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-lg border transition-all duration-200">
                                            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                            </svg>
                                        </div>
                                        <span :class="checked ? 'text-indigo-950 font-black' : 'text-slate-700 font-bold'"
                                            class="text-[13.5px] transition-colors">
                                            {{ $category->name }}
                                        </span>
                                    </div>

                                    <!-- Custom radio-style circle checked bullet -->
                                    <div :class="checked ? 'border-indigo-600 bg-indigo-600' : 'border-slate-300 bg-white'"
                                        class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all">
                                        <svg x-show="checked" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl text-center">
                            <p class="text-slate-400 font-bold text-sm mb-3">No categories available yet.</p>
                            <a href="/admin/categories" class="inline-flex items-center gap-1 text-sm font-extrabold text-indigo-600 hover:text-indigo-700">
                                Create first category &rarr;
                            </a>
                        </div>
                    @endif
                    
                    @error('categories')
                        <p class="text-sm text-rose-600 font-bold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Article Body Content Workspace -->
                <div class="mb-8">
                    <label class="block text-[13px] font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Article Content
                    </label>
                    <textarea name="body" placeholder="Write your coding guide using markdown syntax..."
                        class="w-full min-h-[380px] bg-slate-50/50 border border-slate-200 rounded-xl py-3.5 px-4 text-[15px] font-bold text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 outline-none resize-y leading-relaxed" required>{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-sm text-rose-600 font-bold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bottom Submission Bar -->
                <div class="flex items-center justify-between border-t border-slate-100 pt-6">
                    <!-- Cancel Button -->
                    <a href="/articles" 
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-700 font-extrabold text-[13px] transition-all border border-slate-200 rounded-xl">
                        Cancel
                    </a>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-sm transition-all transform active:scale-95 shadow-md hover:shadow-lg" 
                        style="border-radius: 12px; color: white !important;">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Submit for Review
                    </button>
                </div>
            </form>
        </div>

        <!-- Submission Policy Banner -->
        <div class="p-4 bg-slate-50 border border-slate-200/60 rounded-xl flex items-start gap-3">
            <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex-shrink-0 mt-0.5">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <div>
                <h4 class="text-[13px] font-extrabold text-slate-800 mb-0.5">Submission Policy</h4>
                <p class="text-[12.5px] text-slate-400 font-semibold leading-relaxed">
                    To keep the tutorial feed premium and expert-only, submitted articles are reviewed by an administrator. Once reviewed and approved, it will be immediately published to the public magazine.
                </p>
            </div>
        </div>
    </div>
@endsection