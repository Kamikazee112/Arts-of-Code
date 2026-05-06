@extends('layouts.app')

@section('title', 'Test Sidebar')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-medium text-[var(--text)] mb-6">Test Sidebar Page</h1>

    <div class="bg-[var(--surface)] border border-[var(--border)] rounded-lg p-6">
        <h2 class="text-lg font-medium text-[var(--text)] mb-4">Sidebar Test</h2>
        <p class="text-[var(--muted)] mb-4">
            This page demonstrates the sidebar with categories, articles, and exams.
            The sidebar should appear on the left side of the screen (for authenticated users).
        </p>

        <div class="space-y-4">
            <div class="p-4 bg-[var(--bg)] rounded-lg">
                <h3 class="font-medium text-[var(--text)] mb-2">Features:</h3>
                <ul class="list-disc list-inside text-[var(--muted)] space-y-1">
                    <li>Categories with progress tracking</li>
                    <li>Articles and exams listed under each category</li>
                    <li>Mark items as complete</li>
                    <li>Achievement system for completing categories</li>
                    <li>Real-time progress updates</li>
                </ul>
            </div>

            <div class="p-4 bg-[var(--bg)] rounded-lg">
                <h3 class="font-medium text-[var(--text)] mb-2">How to use:</h3>
                <ol class="list-decimal list-inside text-[var(--muted)] space-y-1">
                    <li>View categories in the sidebar on the left</li>
                    <li>Click on articles or exams to view them</li>
                    <li>Mark items as complete using the "Mark Complete" button</li>
                    <li>Watch the progress bar update in real-time</li>
                    <li>Complete all items in a category to earn an achievement</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection