@extends('layouts.app')

@section('title', 'Edit Category - Admin')

@section('content')
    <div class="max-w-[800px] mx-auto">
        <!-- Page Title -->
        <h1 class="text-[22px] font-medium text-[var(--text)] mb-8">Edit Category</h1>

        <!-- Category Form -->
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

            <form method="POST" action="/admin/categories/{{ $category->id }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Category Name</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="input" required
                        placeholder="e.g., Graph Theory, Dynamic Programming, Trees">
                    @error('name')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-[13px] font-medium text-[var(--text)] mb-1">Description (Optional)</label>
                    <textarea name="description" rows="3" class="input resize-vertical"
                        placeholder="Describe what this category covers...">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-[var(--danger)] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">
                    Update Category
                </button>
            </form>
        </div>
    </div>
@endsection