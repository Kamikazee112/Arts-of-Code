@extends('admin.layout')

@section('title', 'Add Question - Admin')

@section('admin-content')
<div>
    <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Add Question</h1>

    <div class="card p-6 max-w-3xl">
        <form method="POST" action="/admin/questions" x-data="{ questionType: '{{ old('type', 'mcq') }}' }">
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

            <!-- Exam Selection -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Exam</label>
                <select name="exam_id" class="input" required>
                    <option value="">Select an exam</option>
                    @if(isset($exams))
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>
                                {{ $exam->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('exam_id')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question Text -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Question Text</label>
                <textarea
                    name="question"
                    rows="4"
                    class="input resize-vertical"
                    required
                >{{ old('question') }}</textarea>
                @error('question')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question Type -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Type</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="type" value="mcq" {{ old('type', 'mcq') === 'mcq' ? 'checked' : '' }} @input="questionType = 'mcq'" class="mr-2">
                        <span>Multiple Choice</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="type" value="open" {{ old('type') === 'open' ? 'checked' : '' }} @input="questionType = 'open'" class="mr-2">
                        <span>Open Ended</span>
                    </label>
                </div>
                @error('type')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Code Snippet (Optional) -->
            <div class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Code Snippet (optional)</label>
                <textarea
                    name="code_snippet"
                    rows="3"
                    class="input resize-vertical font-mono text-sm"
                    placeholder="Paste code here..."
                >{{ old('code_snippet') }}</textarea>
                @error('code_snippet')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- MCQ Options -->
            <div x-show="questionType === 'mcq'" class="mb-4">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-2">Options</label>

                <div class="space-y-3">
                    <!-- Option A -->
                    <div class="flex gap-2 items-center">
                        <span class="text-sm font-medium w-8">A:</span>
                        <input type="text" name="option_a" value="{{ old('option_a') }}" class="input flex-1" required>
                        <input type="radio" name="correct_answer" value="0" {{ old('correct_answer') === '0' ? 'checked' : '' }} class="ml-2">
                    </div>

                    <!-- Option B -->
                    <div class="flex gap-2 items-center">
                        <span class="text-sm font-medium w-8">B:</span>
                        <input type="text" name="option_b" value="{{ old('option_b') }}" class="input flex-1" required>
                        <input type="radio" name="correct_answer" value="1" {{ old('correct_answer') === '1' ? 'checked' : '' }} class="ml-2">
                    </div>

                    <!-- Option C -->
                    <div class="flex gap-2 items-center">
                        <span class="text-sm font-medium w-8">C:</span>
                        <input type="text" name="option_c" value="{{ old('option_c') }}" class="input flex-1" required>
                        <input type="radio" name="correct_answer" value="2" {{ old('correct_answer') === '2' ? 'checked' : '' }} class="ml-2">
                    </div>

                    <!-- Option D -->
                    <div class="flex gap-2 items-center">
                        <span class="text-sm font-medium w-8">D:</span>
                        <input type="text" name="option_d" value="{{ old('option_d') }}" class="input flex-1" required>
                        <input type="radio" name="correct_answer" value="3" {{ old('correct_answer') === '3' ? 'checked' : '' }} class="ml-2">
                    </div>
                </div>

                <p class="text-xs text-[var(--muted)] mt-2">Select the radio button next to the correct answer.</p>

                @error('option_a')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
                @error('option_b')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
                @error('option_c')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
                @error('option_d')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
                @error('correct_answer')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Open Ended Fields -->
            <div x-show="questionType === 'open'" class="mb-4">
                <!-- Model Answer -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Model Answer</label>
                    <textarea
                        name="model_answer"
                        rows="3"
                        class="input resize-vertical"
                    >{{ old('model_answer') }}</textarea>
                    @error('model_answer')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Explanation -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Explanation</label>
                    <textarea
                        name="explanation"
                        rows="2"
                        class="input resize-vertical"
                    >{{ old('explanation') }}</textarea>
                    @error('explanation')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Points -->
            <div class="mb-6">
                <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Points</label>
                <input
                    type="number"
                    name="points"
                    value="{{ old('points', 1) }}"
                    class="input max-w-xs"
                    min="1"
                    required
                >
                @error('points')
                    <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <a href="/admin/questions" class="text-[var(--muted)] hover:text-[var(--text)] transition-colors">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Save Question
                </button>
            </div>
        </form>
    </div>
</div>
@endsection