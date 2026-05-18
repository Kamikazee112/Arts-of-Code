@extends('layouts.app')

@section('title', 'My Questions - Arts Of Code')

@section('content')
    <div class="max-w-[900px] mx-auto animate-fade-up">
        
        <!-- Page Title Row -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10 pb-6 border-b border-[var(--border)]">
            <div>
                <div class="flex items-center gap-3.5 mb-1.5">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--accent-light);border-radius:10px;color:var(--accent);">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <h1 class="text-[26px] font-bold text-[var(--text)] tracking-tight">Question Bank</h1>
                </div>
                <p class="text-[14.5px] text-[var(--muted)]">
                    Create, manage, and catalog your quiz and exam questions.
                </p>
            </div>
            @auth
                <a href="/questions/create" class="btn-primary" style="padding: 10px 20px; font-size: 13.5px; border-radius: 10px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Question
                </a>
            @endauth
        </div>

        <!-- Questions List -->
        @if(isset($questions) && $questions->count() > 0)
            <div class="grid grid-cols-1 gap-5">
                @foreach($questions as $question)
                    <div class="card card-hover p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden transition-all duration-300" style="border-left: 4px solid var(--accent);">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3.5 mb-2.5">
                                <a href="/questions/{{ $question->id }}" class="text-[19px] font-extrabold text-[var(--text)] hover:text-[var(--accent)] transition-all tracking-tight">
                                    {{ $question->title }}
                                </a>
                                
                                <!-- Meta Badges -->
                                <div class="flex gap-2">
                                    @if($question->type === 'mcq')
                                        <span class="badge badge-default text-[10.5px] px-2.5 py-0.5 flex items-center gap-1 font-bold uppercase shadow-sm">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h8"/></svg>
                                            Multiple Choice
                                        </span>
                                    @elseif($question->type === 'true_false')
                                        <span class="badge badge-success text-[10.5px] px-2.5 py-0.5 flex items-center gap-1 font-bold uppercase shadow-sm">
                                            ✓ True/False
                                        </span>
                                    @else
                                        <span class="badge badge-warning text-[10.5px] px-2.5 py-0.5 flex items-center gap-1 font-bold uppercase shadow-sm">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            Short Answer
                                        </span>
                                    @endif

                                    <span class="badge badge-muted text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        {{ $question->points }} {{ $question->points > 1 ? 'pts' : 'pt' }}
                                    </span>
                                    
                                    @if($question->type === 'mcq')
                                        <span class="badge badge-muted text-[11px] px-2.5 py-0.5 flex items-center gap-1 font-semibold">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                            {{ $question->options->count() }} Options
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($question->question_text)
                                <p class="text-[13.5px] text-[var(--text-2)] leading-relaxed max-w-[620px]">
                                    {{ Str::limit($question->question_text, 140) }}
                                </p>
                            @else
                                <p class="text-[13px] text-[var(--muted)] italic">
                                    No description provided for this question.
                                </p>
                            @endif
                        </div>

                        <!-- Action Group -->
                        <div class="w-full md:w-auto flex flex-row justify-end items-center gap-2.5 border-t md:border-t-0 border-[var(--border)] pt-4 md:pt-0">
                            <a href="/questions/{{ $question->id }}/edit" class="btn-sm btn-sm-edit font-bold px-4 py-2" style="border-radius: 8px;">
                                Edit
                            </a>
                            <form method="POST" action="/questions/{{ $question->id }}"
                                onsubmit="return confirm('Are you sure you want to delete this question?');"
                                class="inline-flex">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-sm-delete font-bold px-4 py-2" style="border-radius: 8px;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card p-12 text-center flex flex-col items-center justify-center border-dashed border-2">
                <span class="text-4xl mb-4">📂</span>
                <h3 class="text-xl font-bold text-[var(--text)] mb-2">Your Question Bank is Empty</h3>
                <p class="text-sm text-[var(--muted)] max-w-sm mb-6">إنشاء questions first so you can group them into challenging coding exams and quizzes!</p>
                <a href="/questions/create" class="btn-primary font-bold px-6 py-3" style="border-radius: 10px;">
                    Create Your First Question
                </a>
            </div>
        @endif
    </div>
@endsection