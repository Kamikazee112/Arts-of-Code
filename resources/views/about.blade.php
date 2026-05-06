@extends('layouts.app')

@section('title', 'About Us - Arts Of Code')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- Page Title -->
    <h1 class="text-[28px] font-medium text-[var(--text)] mb-4">About Arts Of Code</h1>

    <!-- Introduction -->
    <section class="mb-12">
        <p class="text-[16px] text-[var(--text)] leading-relaxed mb-4">
            Arts Of Code is a community platform designed for competitive programmers, problem solvers, and coding enthusiasts. We believe that coding is both an art and a science, and our mission is to create a space where developers can learn, share, and grow together.
        </p>
        <p class="text-[16px] text-[var(--text)] leading-relaxed">
            Whether you're preparing for coding interviews, participating in competitive programming contests, or simply looking to improve your problem-solving skills, Arts Of Code provides the tools and community you need to succeed.
        </p>
    </section>

    <!-- Features Section -->
    <section class="mb-12">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-6">What We Offer</h2>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Feature 1 -->
            <div class="card p-6">
                <h3 class="text-[16px] font-medium text-[var(--text)] mb-2">📝 Articles & Tutorials</h3>
                <p class="text-[14px] text-[var(--muted)]">
                    Learn from community-written articles covering algorithms, data structures, and problem-solving techniques.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="card p-6">
                <h3 class="text-[16px] font-medium text-[var(--text)] mb-2">🏆 Coding Challenges</h3>
                <p class="text-[14px] text-[var(--muted)]">
                    Test your skills with our curated quizzes and coding challenges designed to improve your problem-solving abilities.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="card p-6">
                <h3 class="text-[16px] font-medium text-[var(--text)] mb-2">📊 Leaderboards</h3>
                <p class="text-[14px] text-[var(--muted)]">
                    Compete with others and track your progress through our comprehensive ranking system.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="card p-6">
                <h3 class="text-[16px] font-medium text-[var(--text)] mb-2">💬 Community</h3>
                <p class="text-[14px] text-[var(--muted)]">
                    Connect with fellow programmers, share insights, and collaborate on solutions through our messaging system.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mb-12">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-6">Our Mission</h2>
        <div class="card p-6">
            <p class="text-[16px] text-[var(--text)] leading-relaxed">
                At Arts Of Code, we strive to democratize competitive programming education. We believe that everyone should have access to high-quality learning resources and a supportive community. Our platform is built on the principles of:
            </p>
            <ul class="mt-4 space-y-2 text-[14px] text-[var(--text)]">
                <li>• <strong>Accessibility:</strong> Making learning resources available to everyone</li>
                <li>• <strong>Quality:</strong> Curating the best content and challenges</li>
                <li>• <strong>Community:</strong> Fostering collaboration and knowledge sharing</li>
                <li>• <strong>Growth:</strong> Encouraging continuous improvement and learning</li>
            </ul>
        </div>
    </section>

    <!-- Get Started Section -->
    <section class="text-center">
        <h2 class="text-[20px] font-medium text-[var(--text)] mb-4">Ready to Start Your Journey?</h2>
        <p class="text-[14px] text-[var(--muted)] mb-6">
            Join thousands of programmers who are already improving their skills on Arts Of Code.
        </p>
        <div class="flex gap-4 justify-center">
            @guest
                <a href="/register" class="btn-primary">
                    Create Account
                </a>
                <a href="/articles" class="btn-outline">
                    Browse Articles
                </a>
            @endguest

            @auth
                <a href="/articles/create" class="btn-primary">
                    Write an Article
                </a>
                <a href="/exams" class="btn-outline">
                    Take a Quiz
                </a>
            @endauth
        </div>
    </section>
</div>
@endsection