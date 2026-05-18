@extends('layouts.app')

@section('title', 'Edit Quiz - Arts Of Code')

@section('content')
<div class="max-w-[850px] mx-auto animate-fade-up">
    
    <!-- Breadcrumb return and Page Title -->
    <div class="mb-8">
        <a href="/exams" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[var(--accent)] hover:text-[var(--accent-hover)] transition-colors mb-3">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Quizzes
        </a>
        <div class="flex items-center gap-3">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--accent-light);border-radius:10px;color:var(--accent);">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </span>
            <h1 class="text-[26px] font-extrabold text-[var(--text)] tracking-tight">تعديل Quiz: <span class="text-[var(--accent)]">{{ $exam->title }}</span></h1>
        </div>
    </div>

    <!-- Quiz Form Container -->
    <div class="card p-8 md:p-10 shadow-lg relative overflow-hidden bg-white">
        
        <!-- Decorative subtle top border accent -->
        <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

        <form method="POST" action="/exams/{{ $exam->id }}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Quiz Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $exam->title) }}"
                    class="input text-[15px] py-3.5 px-4 font-medium"
                    required
                    placeholder="e.g. Master Graphs and Trees..."
                >
                @error('title')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Description (Optional)</label>
                <textarea
                    name="description"
                    rows="3"
                    class="input resize-vertical text-[14px] py-3 px-4 leading-relaxed"
                    placeholder="Provide a brief summary of what this quiz covers..."
                >{{ old('description', $exam->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 3-Column Numeric Grid (Compact & Pro) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                
                <!-- Time Limit -->
                <div>
                    <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Time Limit (mins)</label>
                    <input
                        type="number"
                        name="time_limit"
                        value="{{ old('time_limit', $exam->time_limit) }}"
                        class="input"
                        min="1"
                        placeholder="Unlimited Attempts"
                    >
                    @error('time_limit')
                        <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Passing Score -->
                <div>
                    <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Passing Score (%)</label>
                    <input
                        type="number"
                        name="passing_score"
                        value="{{ old('passing_score', $exam->passing_score) }}"
                        class="input font-bold text-indigo-600"
                        required
                        min="0"
                        max="100"
                    >
                    @error('passing_score')
                        <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Max Attempts -->
                <div>
                    <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Max Attempts</label>
                    <input
                        type="number"
                        name="max_attempts"
                        value="{{ old('max_attempts', $exam->max_attempts) }}"
                        class="input"
                        min="1"
                        placeholder="Unlimited"
                    >
                    @error('max_attempts')
                        <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Publish Switch Card (Premium SaaS style Toggle Container) -->
            <div class="mb-6">
                <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100/50 cursor-pointer transition-all duration-200">
                    <div class="flex-1 pr-4">
                        <span class="block text-sm font-bold text-slate-800">Publish Challenge</span>
                        <span class="block text-[12.5px] text-slate-500 mt-0.5">Toggle this on to make the quiz instantly visible and active for users in available quizzes.</span>
                    </div>
                    <div class="relative inline-flex items-center">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $exam->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600 cursor-pointer"
                        >
                    </div>
                </label>
            </div>

            <!-- Categories Selection Grid -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-3">التصنيفات</label>
                @php
                    $categories = \App\Models\Category::all();
                    $selectedCategories = $exam->categories->pluck('id')->toArray();
                @endphp
                @if($categories->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                            <label class="flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl hover:bg-slate-50 cursor-pointer transition-all">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600"
                                >
                                <span class="text-[13.5px] font-semibold text-slate-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-[var(--muted)]">No categories available yet. <a href="/admin/categories" class="link">إنشاء categories first</a></p>
                @endif
                @error('categories')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Questions Selection Scrollable Box (Rich Badged rows) -->
            <div class="mb-8">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-3">Select الأسئلة For Quiz</label>
                @if($questions->count() > 0)
                    <div class="space-y-2.5 max-h-[300px] overflow-y-auto border border-slate-200 rounded-xl p-4 bg-slate-50/50">
                        @foreach($questions as $question)
                            @php
                                $isSelected = $exam->questions->contains($question->id);
                            @endphp
                            <label class="flex items-start gap-3.5 p-3 hover:bg-white border border-transparent hover:border-slate-100 rounded-xl cursor-pointer transition-all duration-150">
                                <input
                                    type="checkbox"
                                    name="questions[]"
                                    value="{{ $question->id }}"
                                    {{ $isSelected ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600 mt-1.5"
                                >
                                <div class="flex-1">
                                    <div class="text-[14px] font-bold text-slate-800 leading-snug">
                                        {{ $question->title }}
                                    </div>
                                    <div class="text-[12.5px] text-slate-500 mt-0.5 line-clamp-1">
                                        {{ $question->question_text }}
                                    </div>
                                    <div class="flex gap-2 mt-2">
                                        @if($question->type === 'mcq')
                                            <span class="badge badge-default text-[10px] px-2 py-0.5 font-bold uppercase shadow-sm">
                                                MCQ
                                            </span>
                                        @elseif($question->type === 'true_false')
                                            <span class="badge badge-success text-[10px] px-2 py-0.5 font-bold uppercase shadow-sm">
                                                ✓ T/F
                                            </span>
                                        @else
                                            <span class="badge badge-warning text-[10px] px-2 py-0.5 font-bold uppercase shadow-sm">
                                                Essay
                                            </span>
                                        @endif
                                        <span class="badge badge-muted text-[10px] px-2 py-0.5 font-bold uppercase flex items-center gap-1">
                                            <svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            {{ $question->points }} pts
                                        </span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-[12px] text-[var(--muted)] mt-2 font-medium">Select at least one question from the pool above.</p>
                @else
                    <div class="text-center py-10 border border-slate-200 rounded-xl bg-slate-50">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-indigo-50 text-indigo-300 rounded-xl mb-2 mx-auto">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <p class="text-[var(--muted)] text-sm mb-3">No questions available yet.</p>
                        <a href="/questions/create" class="btn-primary text-xs font-bold px-4 py-2" style="border-radius: 8px;">
                            Create Question
                        </a>
                    </div>
                @endif
                @error('questions')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button & Cancel Action -->
            <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
                <button type="submit" class="btn-primary font-bold px-7 py-3.5 shadow-md flex items-center gap-1.5" style="border-radius: 10px;" {{ $questions->count() === 0 ? 'disabled' : '' }}>
                    Save Changes
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
                <a href="/exams" class="btn-outline font-bold px-6 py-3.5 hover:bg-slate-50" style="border-radius: 10px; border-color: slate-300; color: slate-600 !important;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection