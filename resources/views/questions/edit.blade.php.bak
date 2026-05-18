@extends('layouts.app')

@section('title', 'Edit Question - Arts Of Code')

@section('content')
<div class="max-w-[850px] mx-auto animate-fade-up">
    
    <!-- Return Navigation & Page Title -->
    <div class="mb-8">
        <a href="/questions" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-[var(--accent)] hover:text-[var(--accent-hover)] transition-colors mb-3">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Question Bank
        </a>
        <div class="flex items-center gap-3">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--accent-light);border-radius:10px;color:var(--accent);">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h1 class="text-[26px] font-extrabold text-[var(--text)] tracking-tight">تعديل Question: <span class="text-[var(--accent)]">{{ $question->title }}</span></h1>
        </div>
    </div>

    <!-- Question Form Card -->
    <div class="card p-8 md:p-10 shadow-lg relative overflow-hidden bg-white">
        
        <!-- Premium gradient accent border -->
        <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <h4 class="text-sm font-bold text-red-800 mb-2">Please fix the following errors:</h4>
                <ul class="text-[13px] text-red-700 space-y-1 list-disc pl-4 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/questions/{{ $question->id }}" id="question-form">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Question Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $question->title) }}"
                    class="input text-[15px] py-3.5 px-4 font-medium"
                    required
                    placeholder="e.g. Tree Traversal Complexity..."
                >
                @error('title')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question Text -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Question Body / Code Prompt</label>
                <textarea
                    name="question_text"
                    rows="4"
                    class="input resize-vertical text-[14px] py-3 px-4 leading-relaxed font-mono"
                    required
                    placeholder="Enter the main problem description. You can paste code blocks here..."
                >{{ old('question_text', $question->question_text) }}</textarea>
                @error('question_text')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 2-Column Grid: Question Type and Points -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                
                <!-- Question Type -->
                <div>
                    <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Question Type</label>
                    <select name="type" id="question-type" class="input font-bold text-slate-800" required onchange="toggleQuestionFields()">
                        <option value="mcq" {{ old('type', $question->type) == 'mcq' ? 'selected' : '' }}>Multiple Choice</option>
                        <option value="true_false" {{ old('type', $question->type) == 'true_false' ? 'selected' : '' }}>✓ True / False</option>
                        <option value="short_answer" {{ old('type', $question->type) == 'short_answer' ? 'selected' : '' }}>✍ Short Answer / Essay</option>
                    </select>
                    @error('type')
                        <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Points -->
                <div>
                    <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Awarded Points</label>
                    <input
                        type="number"
                        name="points"
                        value="{{ old('points', $question->points) }}"
                        class="input font-extrabold text-indigo-600"
                        required
                        min="1"
                    >
                    @error('points')
                        <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Explanation -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-2">Correct Answer Explanation (Optional)</label>
                <textarea
                    name="explanation"
                    rows="2"
                    class="input resize-vertical text-[13.5px] py-3 px-4 leading-relaxed"
                    placeholder="Provide details on why the correct answer is correct..."
                >{{ old('explanation', $question->explanation) }}</textarea>
                @error('explanation')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categories Selection Grid -->
            <div class="mb-6">
                <label class="block text-[12px] font-extrabold tracking-wider text-slate-700 uppercase mb-3">التصنيفات</label>
                @php
                    $categories = \App\Models\Category::all();
                    $selectedCategories = $question->categories->pluck('id')->toArray();
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

            <!-- MCQ Options Section -->
            <div id="mcq-options" class="mb-8 p-6 bg-slate-50 border border-slate-200 rounded-2xl" style="display: {{ old('type', $question->type) == 'mcq' ? 'block' : 'none' }};">
                <label class="block text-[13px] font-extrabold tracking-wider text-slate-800 uppercase mb-1">Define MCQ Options</label>
                <p class="text-[12px] text-slate-500 mb-4">Input option choices and select the circular button next to the correct answer.</p>
                
                <div class="space-y-3.5">
                    @for($i = 0; $i < 4; $i++)
                        @php
                            $existingOption = $question->options->get($i);
                        @endphp
                        <div class="flex gap-3 items-center bg-white p-2.5 rounded-xl border border-slate-100 hover:border-indigo-100 transition-all">
                            <label class="flex items-center justify-center p-2.5 cursor-pointer" title="Mark as correct answer">
                                <input
                                    type="radio"
                                    name="correct_option"
                                    value="{{ $i }}"
                                    {{ (old("correct_option") == $i) || ($existingOption && $existingOption->is_correct) ? 'checked' : '' }}
                                    class="w-5 h-5 border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600"
                                >
                            </label>
                            <input
                                type="text"
                                name="options[{{ $i }}][text]"
                                value="{{ old("options.$i.text", $existingOption->option_text ?? '') }}"
                                class="input flex-1 font-semibold text-slate-700 bg-slate-50/50 hover:bg-white"
                                placeholder="Choice Option {{ $i + 1 }}"
                            >
                        </div>
                    @endfor
                </div>
                @error('options')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- True/False Answer Card Selector -->
            <div id="true-false-options" class="mb-8 p-6 bg-slate-50 border border-slate-200 rounded-2xl" style="display: {{ old('type', $question->type) == 'true_false' ? 'block' : 'none' }};">
                <label class="block text-[13px] font-extrabold tracking-wider text-slate-800 uppercase mb-1">Correct Answer</label>
                <p class="text-[12px] text-slate-500 mb-4">Select which statement represents the true correct answer.</p>
                
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $currentTrueFalseAnswer = null;
                        if($question->type == 'true_false' && $question->options->count() > 0) {
                            $trueOption = $question->options->where('option_text', 'True')->first();
                            $currentTrueFalseAnswer = $trueOption && $trueOption->is_correct ? '1' : '0';
                        }
                    @endphp
                    <label class="flex items-center justify-center gap-3 p-4 bg-white border border-slate-200 hover:border-emerald-300 rounded-xl hover:bg-emerald-50/20 cursor-pointer transition-all duration-200 select-none">
                        <input
                            type="radio"
                            name="correct_answer"
                            value="1"
                            {{ old('correct_answer', $currentTrueFalseAnswer ?? '1') == '1' ? 'checked' : '' }}
                            class="w-5 h-5 text-emerald-600 border-slate-300 focus:ring-emerald-500 accent-emerald-600"
                        >
                        <span class="text-[14.5px] font-bold text-slate-700">🟢 TRUE</span>
                    </label>
                    <label class="flex items-center justify-center gap-3 p-4 bg-white border border-slate-200 hover:border-red-300 rounded-xl hover:bg-red-50/20 cursor-pointer transition-all duration-200 select-none">
                        <input
                            type="radio"
                            name="correct_answer"
                            value="0"
                            {{ old('correct_answer', $currentTrueFalseAnswer ?? '1') == '0' ? 'checked' : '' }}
                            class="w-5 h-5 text-red-600 border-slate-300 focus:ring-red-500 accent-red-600"
                        >
                        <span class="text-[14.5px] font-bold text-slate-700">🔴 FALSE</span>
                    </label>
                </div>
                @error('correct_answer')
                    <p class="text-sm text-[var(--danger)] mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
                <button type="submit" class="btn-primary font-bold px-7 py-3.5 shadow-md flex items-center gap-1.5" style="border-radius: 10px;">
                    Save Changes
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
                <a href="/questions" class="btn-outline font-bold px-6 py-3.5 hover:bg-slate-50" style="border-radius: 10px; border-color: slate-300; color: slate-600 !important;">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Toggle Script -->
    <script>
        function toggleQuestionFields() {
            const questionType = document.getElementById('question-type').value;
            const mcqOptions = document.getElementById('mcq-options');
            const trueFalseOptions = document.getElementById('true-false-options');
            const mcqInputs = mcqOptions.querySelectorAll('input[type="text"]');
            const mcqRadios = mcqOptions.querySelectorAll('input[type="radio"]');
            const trueFalseInputs = trueFalseOptions.querySelectorAll('input[type="radio"]');

            if (questionType === 'mcq') {
                mcqOptions.style.display = 'block';
                trueFalseOptions.style.display = 'none';

                // Enable and make MCQ inputs required
                mcqInputs.forEach(input => {
                    input.disabled = false;
                    input.required = true;
                });
                mcqRadios.forEach(input => {
                    input.disabled = false;
                });

                // Disable True/False inputs
                trueFalseInputs.forEach(input => {
                    input.disabled = true;
                    input.required = false;
                });
            } else if (questionType === 'true_false') {
                mcqOptions.style.display = 'none';
                trueFalseOptions.style.display = 'block';

                // Disable MCQ inputs
                mcqInputs.forEach(input => {
                    input.disabled = true;
                    input.required = false;
                });
                mcqRadios.forEach(input => {
                    input.disabled = true;
                });

                // Enable and make True/False inputs required
                trueFalseInputs.forEach(input => {
                    input.disabled = false;
                    input.required = true;
                });
            } else {
                mcqOptions.style.display = 'none';
                trueFalseOptions.style.display = 'none';

                // Disable all inputs
                mcqInputs.forEach(input => {
                    input.disabled = true;
                    input.required = false;
                });
                mcqRadios.forEach(input => {
                    input.disabled = true;
                });
                trueFalseInputs.forEach(input => {
                    input.disabled = true;
                    input.required = false;
                });
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleQuestionFields();
        });
    </script>
</div>
@endsection