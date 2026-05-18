@extends('admin.layout')

@section('title', 'Edit Exam - Admin')

@section('admin-content')
    <div>
        <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">تعديل Exam</h1>

        <div class="card p-6 max-w-2xl">
            <form method="POST" action="/admin/exams/{{ $exam->id }}">
                @csrf
                @method('PATCH')

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

                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $exam->title) }}" class="input" required>
                    @error('title')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="input resize-vertical">{{ old('description', $exam->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div class="mb-6">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Duration (minutes)</label>
                    <input type="number" name="duration" value="{{ old('duration', $exam->duration) }}" class="input"
                        min="1" required>
                    @error('duration')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4">
                    <a href="/admin/exams" class="text-[var(--muted)] hover:text-[var(--text)] transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection