@extends('layouts.app')

@section('title', 'Edit Question - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title -->
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Edit Question</h1>

    <!-- Question Form -->
    <div class="card p-6">
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h4 class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</h4>
                <ul class="text-sm text-red-700">
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
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $question->title) }}"
                    class="input"
                    required
                    placeholder="Question title..."
                >
                @error('title')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question Text -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Question</label>
                <textarea
                    name="question_text"
                    rows="3"
                    class="input resize-vertical"
                    required
                    placeholder="Enter your question..."
                >{{ old('question_text', $question->question_text) }}</textarea>
                @error('question_text')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question Type -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Question Type</label>
                <select name="type" id="question-type" class="input" required onchange="toggleQuestionFields()">
                    <option value="mcq" {{ old('type', $question->type) == 'mcq' ? 'selected' : '' }}>Multiple Choice</option>
                    <option value="true_false" {{ old('type', $question->type) == 'true_false' ? 'selected' : '' }}>True/False</option>
                    <option value="short_answer" {{ old('type', $question->type) == 'short_answer' ? 'selected' : '' }}>Short Answer</option>
                </select>
                @error('type')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Points -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Points</label>
                <input
                    type="number"
                    name="points"
                    value="{{ old('points', $question->points) }}"
                    class="input"
                    required
                    min="1"
                >
                @error('points')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Explanation -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Explanation (Optional)</label>
                <textarea
                    name="explanation"
                    rows="2"
                    class="input resize-vertical"
                    placeholder="Explain the correct answer..."
                >{{ old('explanation', $question->explanation) }}</textarea>
                @error('explanation')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categories Selection -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Categories</label>
                <div class="space-y-2">
                    @php
                        $categories = \App\Models\Category::all();
                        $selectedCategories = $question->categories->pluck('id')->toArray();
                    @endphp
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <label class="flex items-center gap-2 p-2 border border-[var(--border)] rounded hover:bg-[var(--bg)] cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}
                                    class="w-4 h-4"
                                >
                                <span class="text-sm text-[var(--text)]">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    @else
                        <p class="text-sm text-[var(--muted)]">No categories available yet. <a href="/admin/categories" class="link">Create categories first</a></p>
                    @endif
                </div>
                @error('categories')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- MCQ Options -->
            <div id="mcq-options" class="mb-4" style="display: {{ old('type', $question->type) == 'mcq' ? 'block' : 'none' }};">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Options</label>
                <div class="space-y-3">
                    @for($i = 0; $i < 4; $i++)
                        @php
                            $existingOption = $question->options->get($i);
                        @endphp
                        <div class="flex gap-2 items-center">
                            <input
                                type="radio"
                                name="correct_option"
                                value="{{ $i }}"
                                {{ (old("correct_option") == $i) || ($existingOption && $existingOption->is_correct) ? 'checked' : '' }}
                                class="w-4 h-4"
                            >
                            <input
                                type="text"
                                name="options[{{ $i }}][text]"
                                value="{{ old("options.$i.text", $existingOption->option_text ?? '') }}"
                                class="input flex-1"
                                placeholder="Option {{ $i + 1 }}"
                            >
                        </div>
                    @endfor
                </div>
                <p class="text-xs text-[var(--muted)] mt-2">Select the radio button next to the correct answer.</p>
                @error('options')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- True/False Answer -->
            <div id="true-false-options" class="mb-4" style="display: {{ old('type', $question->type) == 'true_false' ? 'block' : 'none' }};">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Correct Answer</label>
                <div class="flex gap-4">
                    @php
                        $currentTrueFalseAnswer = null;
                        if($question->type == 'true_false' && $question->options->count() > 0) {
                            $trueOption = $question->options->where('option_text', 'True')->first();
                            $currentTrueFalseAnswer = $trueOption && $trueOption->is_correct ? '1' : '0';
                        }
                    @endphp
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="correct_answer"
                            value="1"
                            {{ old('correct_answer', $currentTrueFalseAnswer ?? '1') == '1' ? 'checked' : '' }}
                            class="w-4 h-4"
                        >
                        <span>True</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="correct_answer"
                            value="0"
                            {{ old('correct_answer', $currentTrueFalseAnswer ?? '1') == '0' ? 'checked' : '' }}
                            class="w-4 h-4"
                        >
                        <span>False</span>
                    </label>
                </div>
                <p class="text-xs text-[var(--muted)] mt-2">Select the correct answer.</p>
                @error('correct_answer')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary">
                Update Question
            </button>
        </form>
    </div>

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