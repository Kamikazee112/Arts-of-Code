<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arts Of Code')</title>

    <!-- Google Fonts - Inter + JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="description" content="Arts Of Code — A community for problem solvers and competitive programmers.">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* =============================================
           DESIGN TOKENS — Arts Of Code Modern Theme
        ============================================= */
        :root {
            /* Backgrounds */
            --bg:          #F8FAFC;
            --surface:     #FFFFFF;
            --surface-2:   #F1F5F9;

            /* Text */
            --text:        #0F172A;
            --text-2:      #334155;
            --muted:       #64748B;

            /* Accent */
            --accent:      #6366F1;
            --accent-hover:#4F46E5;
            --accent-light:#EEF2FF;
            --accent-ring: rgba(99, 102, 241, 0.18);

            /* Gradients */
            --brand-gradient:       linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
            --brand-gradient-hover: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);

            /* Status */
            --success:     #10B981;
            --success-bg:  #ECFDF5;
            --danger:      #EF4444;
            --danger-bg:   #FEF2F2;
            --warning:     #0EA5E9;
            --warning-bg:  #F0F9FF;
            --info:        #06B6D4;
            --info-bg:     #ECFEFF;

            /* Borders & Shadows */
            --border:      #E2E8F0;
            --border-2:    #CBD5E1;
            --shadow-sm:   0 1px 3px rgba(15,23,42,0.04), 0 1px 2px rgba(15,23,42,0.03);
            --shadow-md:   0 4px 20px -2px rgba(15,23,42,0.07), 0 2px 8px -1px rgba(15,23,42,0.04);
            --shadow-lg:   0 20px 30px -5px rgba(15,23,42,0.10), 0 10px 12px -5px rgba(15,23,42,0.04);

            /* Radii */
            --radius-sm:   8px;
            --radius:      14px;
            --radius-lg:   20px;
        }

        /* ---- Keyframes ---- */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(14px) scale(0.993); }
            to   { opacity: 1; transform: translateY(0)   scale(1); }
        }
        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.6; }
        }

        /* ---- Base ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
            font-size: 15px;
            line-height: 1.65;
            color: var(--text);
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        main {
            animation: fadeSlideUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) both;
            will-change: transform, opacity;
        }

        .animate-fade-up {
            animation: fadeSlideUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        .animate-pulse { animation: pulse-soft 2s ease-in-out infinite; }

        a, button, input, select, textarea, .card, .badge { transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border-2); border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--muted); }

        /* ---- Selection ---- */
        ::selection { background: var(--accent-light); color: var(--accent); }

        /* ---- Focus Ring ---- */
        :focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; border-radius: 4px; }

        /* ---- Images ---- */
        img, video { max-width: 100%; display: block; }

        /* =============================================
           LAYOUT UTILITIES
        ============================================= */
        .container-app  { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        @media (min-width: 640px)  { .container-app { padding: 0 1.5rem; } }
        @media (min-width: 1024px) { .container-app { padding: 0 2rem; } }

        /* =============================================
           INPUTS
        ============================================= */
        .input {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text);
            background: var(--surface);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input::placeholder { color: var(--muted); }
        .input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-ring);
        }

        /* =============================================
           BUTTONS
        ============================================= */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            background: var(--brand-gradient);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            font-family: inherit; font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 12px rgba(99,102,241,0.22);
            transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
            white-space: nowrap;
        }
        .btn-primary:hover  { background: var(--brand-gradient-hover); transform: translateY(-2px); box-shadow: 0 8px 22px rgba(99,102,241,0.32); color: #fff !important; }
        .btn-primary:active { transform: translateY(0); }

        .btn-outline {
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            background: transparent;
            color: var(--accent) !important;
            border: 1.5px solid var(--accent);
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-family: inherit; font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
            white-space: nowrap;
        }
        .btn-outline:hover  { background: var(--accent-light); transform: translateY(-2px); box-shadow: 0 4px 12px var(--accent-ring); color: var(--accent-hover) !important; border-color: var(--accent-hover); }
        .btn-outline:active { transform: translateY(0); }

        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            background: var(--danger); color: #fff !important;
            border: none; border-radius: var(--radius-sm); padding: 9px 18px;
            font-family: inherit; font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 12px rgba(239,68,68,0.2);
            transition: all 0.22s cubic-bezier(0.4,0,0.2,1);
            white-space: nowrap;
        }
        .btn-danger:hover  { background: #DC2626; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(220,38,38,0.32); color: #fff !important; }
        .btn-danger:active { transform: translateY(0); }

        /* Small action buttons */
        .btn-sm {
            display: inline-flex; align-items: center; justify-content: center; gap: 4px;
            font-size: 12px; font-weight: 700; font-family: inherit;
            padding: 6px 13px; border-radius: 7px; cursor: pointer;
            text-decoration: none; white-space: nowrap; line-height: 1.2;
            box-shadow: 0 1px 2px rgba(0,0,0,0.06);
            transition: all 0.18s cubic-bezier(0.4,0,0.2,1);
        }
        .btn-sm:hover  { transform: translateY(-1px); box-shadow: 0 3px 6px rgba(0,0,0,0.1); }
        .btn-sm:active { transform: translateY(0); }

        .btn-sm-edit    { background: var(--accent);  color: #fff !important; border: 1px solid var(--accent-hover); }
        .btn-sm-edit:hover { background: var(--accent-hover); color: #fff !important; }

        .btn-sm-delete  { background: #EF4444; color: #fff !important; border: 1px solid #DC2626; }
        .btn-sm-delete:hover { background: #DC2626; color: #fff !important; }

        .btn-sm-view    { background: #475569; color: #fff !important; border: 1px solid #334155; }
        .btn-sm-view:hover { background: #334155; color: #fff !important; }

        .btn-sm-success { background: #22C55E; color: #fff !important; border: 1px solid #16A34A; }
        .btn-sm-success:hover { background: #16A34A; color: #fff !important; }

        /* =============================================
           LINKS, BADGES, CARDS
        ============================================= */
        .link { color: var(--accent); text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .link:hover { color: var(--accent-hover); text-decoration: underline; text-underline-offset: 3px; }

        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 700;
            padding: 3px 10px; border-radius: 99px;
            letter-spacing: 0.03em;
        }
        .badge-default  { background: var(--accent-light); color: var(--accent); }
        .badge-success  { background: var(--success-bg);   color: var(--success); }
        .badge-danger   { background: var(--danger-bg);    color: var(--danger); }
        .badge-warning  { background: var(--warning-bg);   color: var(--warning); }
        .badge-muted    { background: var(--surface-2);    color: var(--muted); border: 1px solid var(--border); }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.3s cubic-bezier(0.16,1,0.3,1), transform 0.3s cubic-bezier(0.16,1,0.3,1), border-color 0.25s;
        }
        .card:hover      { box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .card-hover:hover { border-color: var(--accent); transform: translateY(-4px); box-shadow: var(--shadow-lg); }

        /* =============================================
           FLASH MESSAGES
        ============================================= */
        .flash-message {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 13px; font-weight: 600;
            padding: 12px 18px; border-radius: var(--radius-sm);
            border-left: 4px solid; margin-bottom: 16px;
        }
        .flash-success { background: var(--success-bg); border-color: var(--success); color: #166534; }
        .flash-error   { background: var(--danger-bg);  border-color: var(--danger);  color: #991B1B; }
        .flash-info    { background: var(--info-bg);    border-color: var(--info);    color: #075985; }

        /* =============================================
           STATUS BADGES
        ============================================= */
        .status-pending               { background: var(--warning-bg); color: var(--warning); }
        .status-approved, .status-published { background: var(--success-bg); color: var(--success); }
        .status-rejected, .status-draft     { background: var(--danger-bg);  color: var(--danger); }

        /* =============================================
           PROSE / ARTICLE CONTENT
        ============================================= */
        .prose-content { line-height: 1.85; font-size: 16px; color: var(--text-2); }
        .prose-content h2 { font-size: 22px; font-weight: 800; color: var(--text); margin: 36px 0 14px; letter-spacing: -0.015em; }
        .prose-content h3 { font-size: 18px; font-weight: 700; color: var(--text); margin: 28px 0 10px; }
        .prose-content p  { margin-bottom: 18px; }
        .prose-content a  { color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }
        .prose-content code { font-family: 'JetBrains Mono', monospace; font-size: 13px; background: var(--accent-light); color: var(--accent); padding: 2px 7px; border-radius: 5px; }
        .prose-content pre { background: #0F172A; color: #E2E8F0; padding: 22px 24px; border-radius: var(--radius); overflow-x: auto; font-family: 'JetBrains Mono', monospace; font-size: 13px; line-height: 1.7; margin: 28px 0; box-shadow: var(--shadow-md); }
        .prose-content pre code { background: none; padding: 0; color: inherit; }
        .prose-content blockquote { border-left: 4px solid var(--accent); margin: 28px 0; padding: 12px 20px; background: var(--accent-light); border-radius: 0 var(--radius-sm) var(--radius-sm) 0; color: var(--text-2); font-style: italic; }
        .prose-content img { max-width: 100%; border-radius: var(--radius); margin: 20px 0; box-shadow: var(--shadow-md); }

        /* =============================================
           MISC
        ============================================= */
        .section-label { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); }
        .divider { border: none; border-top: 1px solid var(--border); margin: 0; }
        .action-group { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }

        /* =============================================
           RESPONSIVE SIDEBAR + LAYOUT
        ============================================= */
        .app-layout { display: flex; min-height: calc(100vh - 60px); }

        /* Sidebar hidden by default on mobile */
        .app-sidebar {
            width: 260px;
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            min-height: calc(100vh - 60px);
            position: sticky;
            top: 60px;
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), width 0.3s;
        }

        .app-main {
            flex: 1;
            min-width: 0;
            padding: 1.5rem 1rem;
            overflow-x: hidden;
        }

        @media (min-width: 640px)  { .app-main { padding: 2rem 1.5rem; } }
        @media (min-width: 1024px) { .app-main { padding: 2rem 2.5rem; } }

        /* On small screens: hide sidebar, use full width */
        @media (max-width: 767px) {
            .app-sidebar {
                display: none;
            }
            .app-main {
                padding: 1.25rem 1rem;
            }
        }

        /* Tables responsive wrapper */
        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-responsive table { min-width: 600px; }
        [x-cloak] { display: none !important; }
    </style>

    @yield('styles')
</head>

<body class="bg-[var(--bg)] text-[var(--text)] antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 h-[60px] bg-[var(--surface)]/95 backdrop-blur-sm border-b border-[var(--border)] shadow-[0_1px_8px_rgba(15,23,42,0.06)]"
        x-data="{ mobileMenuOpen: false }">
        <div class="max-w-[1200px] mx-auto px-6 h-full flex items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 font-semibold text-[15px] text-[var(--text)] hover:text-[var(--accent)] transition-colors tracking-tight">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;background:var(--accent);border-radius:8px;">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </span>
                Arts Of Code
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLink = fn($label,$path,$match) => '<a href="'.$path.'" class="px-3 py-1.5 rounded-md text-[13.5px] font-medium transition-all '.( request()->is($match) ? 'bg-[var(--accent-light)] text-[var(--accent)]' : 'text-[var(--muted)] hover:text-[var(--text)] hover:bg-[var(--bg)]' ).'">'.$label.'</a>';
                @endphp
                {!! $navLink('Articles','/articles','articles*') !!}
                @if(auth()->check() && auth()->user()->role === 'admin')
                    {!! $navLink('Questions','/questions','questions*') !!}
                @endif
                {!! $navLink('Quizzes','/exams','exams*') !!}
                {!! $navLink('Achievements','/achievements','achievements*') !!}
                @auth
                    {!! $navLink('Dashboard','/dashboard','dashboard*') !!}
                @endauth
            </div>

            <!-- Right Actions -->
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="/login" class="text-[13.5px] font-medium text-[var(--muted)] hover:text-[var(--accent)] transition-colors">Login</a>
                    <a href="/register" class="btn-primary" style="padding:7px 16px;font-size:13px;">Create Account</a>
                @endguest

                @auth
                    <a href="/articles/create" class="btn-outline" style="padding:7px 14px;font-size:13px;">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Write
                    </a>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center gap-2 text-[13.5px] font-medium text-[var(--text)] hover:text-[var(--accent)] transition-colors px-2 py-1.5 rounded-md hover:bg-[var(--bg)]">
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:var(--accent-light);color:var(--accent);border-radius:99px;font-size:12px;font-weight:600;">
                                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                            </span>
                            {{ auth()->user()->username }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[var(--muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-52 bg-[var(--surface)] border border-[var(--border)] rounded-xl shadow-[var(--shadow-lg)] py-1.5 z-50">
                            <a href="/users/{{ auth()->user()->id }}" class="flex items-center gap-2.5 px-4 py-2.5 text-[13px] text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="/admin/dashboard" class="flex items-center gap-2.5 px-4 py-2.5 text-[13px] text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    Admin Dashboard
                                </a>
                            @endif
                            <a href="/settings" class="flex items-center gap-2.5 px-4 py-2.5 text-[13px] text-[var(--text)] hover:bg-[var(--bg)] transition-colors">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Settings
                            </a>
                            <div class="border-t border-[var(--border)] my-1"></div>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-[13px] text-[var(--danger)] hover:bg-[var(--danger-bg)] transition-colors">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Buttons (sidebar toggle + hamburger) -->
            <div class="flex items-center gap-1 md:hidden">
                <!-- Sidebar Toggle -->
                <button @click="$dispatch('sidebar-open')" class="p-2 rounded-lg text-[var(--muted)] hover:bg-[var(--bg)] hover:text-[var(--accent)] transition-colors" aria-label="Open navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h7" />
                    </svg>
                </button>
                <!-- Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-[var(--muted)] hover:bg-[var(--bg)] transition-colors" aria-label="Open menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-[var(--surface)] border-t border-[var(--border)] py-4 px-6 shadow-md">
            <div class="flex flex-col gap-1">
                <a href="/articles" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] hover:text-[var(--accent)] transition-colors font-medium">Articles</a>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="/questions" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] hover:text-[var(--accent)] transition-colors font-medium">Questions</a>
                @endif
                <a href="/exams" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] hover:text-[var(--accent)] transition-colors font-medium">Quizzes</a>
                <a href="/achievements" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] hover:text-[var(--accent)] transition-colors font-medium">Achievements</a>
                <div class="border-t border-[var(--border)] my-2"></div>
                @guest
                    <a href="/login" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] font-medium">Login</a>
                    <a href="/register" class="btn-primary text-center mt-1">Create Account</a>
                @endguest
                @auth
                    <a href="/articles/create" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] font-medium">Write Article</a>
                    <a href="/users/{{ auth()->user()->id }}" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] font-medium">Profile</a>
                    <a href="/settings" class="px-3 py-2.5 rounded-lg text-[14px] text-[var(--text)] hover:bg-[var(--bg)] font-medium">Settings</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg text-[14px] text-[var(--danger)] hover:bg-[var(--danger-bg)] font-medium">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-success flex items-center justify-between" x-data="{ show: true }" x-show="show"
                x-transition>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-error flex items-center justify-between" x-data="{ show: true }" x-show="show"
                x-transition>
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="max-w-[1100px] mx-auto px-6 mt-4">
            <div class="flash-message flash-info flex items-center justify-between" x-data="{ show: true }" x-show="show"
                x-transition>
                <span>{{ session('info') }}</span>
                <button @click="show = false" class="text-[var(--muted)] hover:text-[var(--text)]">&times;</button>
            </div>
        </div>
    @endif

    <!-- Mobile Sidebar Drawer Overlay -->
    <div x-data="{ open: false }"
         x-on:sidebar-open.window="open = true"
         style="display:none"
         x-show="open"
         x-cloak>
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/40 z-40 md:hidden"
             @click="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>
        <!-- Drawer -->
        <div class="fixed top-0 left-0 h-full w-[280px] bg-[var(--surface)] shadow-xl z-50 md:hidden overflow-y-auto"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            <div class="flex items-center justify-between p-4 border-b border-[var(--border)]">
                <span class="font-bold text-[var(--text)] text-[15px]">Navigation</span>
                <button @click="open = false" class="p-1.5 rounded-lg text-[var(--muted)] hover:bg-[var(--bg)]">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            @include('components.sidebar')
        </div>
    </div>

    <!-- Main Content -->
    <div class="app-layout">
        <!-- Sidebar -->
        <aside class="app-sidebar">
            @include('components.sidebar')
        </aside>

        <!-- Main Content Area -->
        <main class="app-main">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="border-t border-[var(--border)] bg-[var(--surface)]">
        <div class="max-w-[1200px] mx-auto px-6 py-5 flex items-center justify-between">
            <p class="text-[12px] text-[var(--muted)] font-medium">© 2025 Arts Of Code</p>
            <p class="text-[12px] text-[var(--muted)]">Built for problem solvers</p>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
