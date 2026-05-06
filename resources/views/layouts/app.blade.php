<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arts Of Code')</title>

    <!-- Google Fonts - JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --bg: #FAFAFA;
            --surface: #FFFFFF;
            --text: #1A1A1A;
            --muted: #6B6B6B;
            --accent: #2563EB;
            --border: #E4E4E7;
            --danger: #DC2626;
        }

        * {
            font-family: 'JetBrains Mono', monospace;
        }

        .input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 12px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: outline 0.2s;
        }

        .input:focus {
            outline: 2px solid var(--accent);
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-outline {
            background: transparent;
            color: var(--accent);
            border: 1px solid var(--accent);
            border-radius: 6px;
            padding: 6px 14px;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-outline:hover {
            background: #EFF6FF;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .link {
            color: var(--accent);
            text-decoration: none;
            cursor: pointer;
        }

        .link:hover {
            text-decoration: underline;
        }

        .badge {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .prose-content {
            line-height: 1.8;
            font-size: 16px;
            color: var(--text);
        }

        .prose-content h2 {
            font-size: 20px;
            font-weight: 500;
            margin: 32px 0 12px;
        }

        .prose-content h3 {
            font-size: 17px;
            font-weight: 500;
            margin: 24px 0 8px;
        }

        .prose-content p {
            margin-bottom: 16px;
        }

        .prose-content a {
            color: var(--accent);
        }

        .prose-content code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            background: #F4F4F5;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .prose-content pre {
            background: #18181B;
            color: #E4E4E7;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 13px;
            line-height: 1.6;
            margin: 24px 0;
        }

        .prose-content pre code {
            background: none;
            padding: 0;
            color: inherit;
        }

        .prose-content blockquote {
            border-left: 3px solid var(--accent);
            margin: 24px 0;
            padding-left: 16px;
            color: var(--muted);
            font-style: italic;
        }

        .prose-content img {
            max-width: 100%;
            border-radius: 8px;
            margin: 16px 0;
        }

        .flash-message {
            font-size: 12px;
            padding: 10px 16px;
            border-left: 3px solid;
            background: rgba(0,0,0,0.02);
            margin-bottom: 16px;
        }

        .flash-success {
            border-color: #16A34A;
            color: #166534;
        }

        .flash-error {
            border-color: var(--danger);
            color: #991B1B;
        }

        .flash-info {
            border-color: var(--accent);
            color: #1e40af;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-[var(--bg)] text-[var(--text)]">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 h-14 bg-[var(--surface)] border-b border-[var(--border)]" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-[1100px] mx-auto px-6 h-full flex items-center justify-between">
            <!-- Left: Logo -->
            <a href="/" class="font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                Arts Of Code
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-6">
                <a href="/articles" class="text-sm {{ request()->is('articles*') ? 'text-[var(--accent)]' : 'text-[var(--text)]' }} hover:text-[var(--accent)] transition-colors">
                    Articles
                </a>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="/questions" class="text-sm {{ request()->is('questions*') ? 'text-[var(--accent)]' : 'text-[var(--text)]' }} hover:text-[var(--accent)] transition-colors">
                        Questions
                    </a>
                @endif
                <a href="/exams" class="text-sm {{ request()->is('exams*') ? 'text-[var(--accent)]' : 'text-[var(--text)]' }} hover:text-[var(--accent)] transition-colors">
                    Quizzes
                </a>
                <a href="/achievements" class="text-sm {{ request()->is('achievements*') ? 'text-[var(--accent)]' : 'text-[var(--text)]' }} hover:text-[var(--accent)] transition-colors">
                    Achievements
                </a>

                @guest
                    <a href="/login" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Login
                    </a>
                    <a href="/register" class="btn-outline">
                        Register
                    </a>
                @endguest

                @auth
                    <a href="/dashboard" class="text-sm {{ request()->is('dashboard*') ? 'text-[var(--accent)]' : 'text-[var(--text)]' }} hover:text-[var(--accent)] transition-colors">
                        Dashboard
                    </a>
                    <a href="/articles/create" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Write Article
                    </a>

                    <!-- Notifications (placeholder for future implementation) -->
                    <div class="relative">
                        <button class="relative p-2 text-[var(--muted)] hover:text-[var(--accent)] transition-colors" title="Notifications (coming soon)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                            {{ auth()->user()->username }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-[var(--surface)] border border-[var(--border)] rounded-lg shadow-lg py-2 z-50">
                            <a href="/users/{{ auth()->user()->id }}" class="block px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                Profile
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                    Admin Dashboard
                                </a>
                            @endif
                            <a href="/settings" class="block px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                Settings
                            </a>
                            <form method="POST" action="/logout" class="border-t border-[var(--border)] mt-2 pt-2">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-[var(--text)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden bg-[var(--surface)] border-t border-[var(--border)] py-4 px-6">
            <div class="flex flex-col gap-4">
                <a href="/articles" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                    Articles
                </a>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="/questions" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Questions
                    </a>
                @endif
                <a href="/exams" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                    Quizzes
                </a>
                <a href="/achievements" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                    Achievements
                </a>

                @guest
                    <a href="/login" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Login
                    </a>
                    <a href="/register" class="btn-outline text-center">
                        Register
                    </a>
                @endguest

                @auth
                    <a href="/articles/create" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Write Article
                    </a>
                    <a href="/users/{{ auth()->user()->id }}" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Profile
                    </a>
                    <a href="/settings" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors">
                        Settings
                    </a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-sm text-[var(--text)] hover:text-[var(--accent)] transition-colors text-left">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-success flex items-center justify-between" x-data="{ show: true }" x-show="show" x-transition>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-error flex items-center justify-between" x-data="{ show: true }" x-show="show" x-transition>
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-info flex items-center justify-between" x-data="{ show: true }" x-show="show" x-transition>
                <span>{{ session('info') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <main class="flex-1 px-6 py-8">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="border-t border-[var(--border)] mt-16">
        <div class="max-w-[1100px] mx-auto px-6 py-6 text-center">
            <p class="text-[13px] text-[var(--muted)]">© 2025 Arts Of Code</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>