@extends('layouts.app')

@section('title', $exam->title . ' - Arts Of Code')

@section('content')
    <div class="max-w-[800px] mx-auto animate-fade-up">
        
        <!-- Quiz Header Card -->
        <div class="card p-6 md:p-8 bg-white border border-slate-200/60 shadow-xl rounded-2xl relative overflow-hidden mb-8">
            <!-- Subtle accent top strip -->
            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-indigo-500 to-purple-600"></div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-5">
                <div>
                    <h1 class="text-[26px] font-extrabold text-[#0f172a] tracking-tight mb-2">
                        {{ $exam->title }}
                    </h1>
                    @if($exam->description)
                        <p class="text-[14.5px] text-slate-500 leading-relaxed max-w-[520px]">
                            {{ $exam->description }}
                        </p>
                    @endif
                </div>

                @if($exam->time_limit)
                    <div class="flex items-center gap-2 px-4 py-2.5 bg-indigo-50 border border-indigo-100 rounded-xl text-indigo-700 font-extrabold text-[13.5px] shadow-sm flex-shrink-0">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="animate-pulse">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Time Limit: {{ $exam->time_limit }} mins
                    </div>
                @endif
            </div>

            <!-- Quiz Stats badges row -->
            <div class="flex flex-wrap items-center gap-3 pt-4 border-t border-slate-100 text-[13px] font-bold text-slate-400">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 border border-slate-200/60 rounded-lg">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $exam->questions->count() }} Questions
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 border border-slate-200/60 rounded-lg">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Passing Score: {{ $exam->passing_score }}%
                </span>
            </div>
        </div>

        <!-- Quiz Form -->
        <form method="POST" action="/exams/{{ $exam->id }}/submit">
            @csrf

            <div class="space-y-6">
                @foreach($exam->questions as $index => $question)
                    <div x-data="{ selectedOption: '' }" class="card p-6 md:p-8 bg-white border border-slate-200/60 shadow-md rounded-2xl transition-all duration-200 hover:shadow-lg">
                        
                        <!-- Question Header -->
                        <div class="flex items-start gap-4 mb-6">
                            <!-- Question Index Circle -->
                            <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center text-[15px] font-extrabold flex-shrink-0 shadow-sm">
                                {{ $index + 1 }}
                            </div>

                            <div class="flex-1">
                                <h3 class="text-[17px] font-extrabold text-slate-800 leading-snug mb-1">
                                    {{ $question->title }}
                                </h3>
                                <p class="text-[14.5px] text-slate-600 leading-relaxed font-semibold">
                                    {{ $question->question_text }}
                                </p>
                                
                                <!-- Meta badges -->
                                <div class="flex gap-2 mt-3">
                                    <span class="badge bg-slate-50 text-slate-400 border border-slate-200/60 px-2.5 py-1 text-[11px] font-extrabold uppercase shadow-sm">
                                        {{ strtoupper($question->type === 'mcq' ? 'MCQ' : ($question->type === 'true_false' ? 'T/F' : 'SHORT ANSWER')) }}
                                    </span>
                                    <span class="badge bg-indigo-50/50 text-indigo-600 border border-indigo-100/60 px-2.5 py-1 text-[11px] font-extrabold uppercase shadow-sm flex items-center gap-1">
                                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                        {{ $question->points }} pts
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Answer Options (MCQ & True/False styled beautifully as Select Cards) -->
                        @if($question->type === 'mcq')
                            <div class="space-y-3 pl-0 sm:pl-14">
                                @foreach($question->options as $option)
                                    <label 
                                        @click="selectedOption = '{{ $option->id }}'"
                                        class="flex items-center gap-4 p-4 border rounded-xl cursor-pointer transition-all duration-200 select-none group"
                                        :class="selectedOption == '{{ $option->id }}' 
                                            ? 'border-indigo-600 bg-indigo-50/20 ring-2 ring-indigo-600/10 shadow-sm' 
                                            : 'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50/50'"
                                    >
                                        <!-- Custom Radio Input Circle -->
                                        <div class="relative flex items-center justify-center w-5 h-5 border-2 rounded-full transition-all duration-200 flex-shrink-0"
                                            :class="selectedOption == '{{ $option->id }}' 
                                                ? 'border-indigo-600 bg-indigo-600' 
                                                : 'border-slate-300 bg-white group-hover:border-slate-400'"
                                        >
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                class="absolute opacity-0 w-full h-full cursor-pointer" required>
                                            <!-- Center Dot -->
                                            <div class="w-1.5 h-1.5 bg-white rounded-full transition-transform duration-200 scale-0"
                                                :class="selectedOption == '{{ $option->id }}' ? 'scale-100' : 'scale-0'"
                                            ></div>
                                        </div>

                                        <span class="text-[14.5px] font-bold transition-colors"
                                            :class="selectedOption == '{{ $option->id }}' ? 'text-indigo-950' : 'text-slate-700'"
                                        >
                                            {{ $option->option_text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif($question->type === 'true_false')
                            <div class="space-y-3 pl-0 sm:pl-14">
                                @foreach($question->options as $option)
                                    <label 
                                        @click="selectedOption = '{{ $option->id }}'"
                                        class="flex items-center gap-4 p-4 border rounded-xl cursor-pointer transition-all duration-200 select-none group"
                                        :class="selectedOption == '{{ $option->id }}' 
                                            ? 'border-indigo-600 bg-indigo-50/20 ring-2 ring-indigo-600/10 shadow-sm' 
                                            : 'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50/50'"
                                    >
                                        <!-- Custom Radio Input Circle -->
                                        <div class="relative flex items-center justify-center w-5 h-5 border-2 rounded-full transition-all duration-200 flex-shrink-0"
                                            :class="selectedOption == '{{ $option->id }}' 
                                                ? 'border-indigo-600 bg-indigo-600' 
                                                : 'border-slate-300 bg-white group-hover:border-slate-400'"
                                        >
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                class="absolute opacity-0 w-full h-full cursor-pointer" required>
                                            <!-- Center Dot -->
                                            <div class="w-1.5 h-1.5 bg-white rounded-full transition-transform duration-200 scale-0"
                                                :class="selectedOption == '{{ $option->id }}' ? 'scale-100' : 'scale-0'"
                                            ></div>
                                        </div>

                                        <span class="text-[14.5px] font-bold transition-colors"
                                            :class="selectedOption == '{{ $option->id }}' ? 'text-indigo-950' : 'text-slate-700'"
                                        >
                                            {{ $option->option_text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif($question->type === 'short_answer')
                            <div class="pl-0 sm:pl-14">
                                <textarea 
                                    name="answers[{{ $question->id }}]" 
                                    class="input min-h-[90px] resize-vertical text-[14px] py-3 px-4 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200"
                                    style="border-radius: 10px;"
                                    placeholder="Type your constructive and complete answer here..." 
                                    required
                                ></textarea>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Submit Button (No raw emojis, solid color, hover scale) -->
            <div class="mt-10 text-center">
                <button type="submit" class="btn-primary font-bold px-8 py-3.5 text-[15px] shadow-lg shadow-indigo-600/10 hover:shadow-xl hover:shadow-indigo-600/20 transition-all transform active:scale-95" style="border-radius: 10px; width: 100%; max-width: 280px; display: inline-block;">
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>
@endsection