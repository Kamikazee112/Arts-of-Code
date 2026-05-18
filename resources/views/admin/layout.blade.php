<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Arts Of Code')</title>

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

        .btn-success {
            background: #16A34A;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-success:hover {
            background: #15803d;
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
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .status-pending {
            background: #FEF9C3;
            color: #854D0E;
        }

        .status-approved {
            background: #DCFCE7;
            color: #166534;
        }

        .status-rejected {
            background: #FEE2E2;
            color: #991B1B;
        }

        .status-active {
            background: #DCFCE7;
            color: #166534;
        }

        .status-blocked {
            background: #FEE2E2;
            color: #991B1B;
        }
    </style>

    @yield('styles')
</head>

<body class="bg-[#FAFAFA] text-[var(--text)]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-[220px] bg-[#18181B] text-[#E4E4E7] fixed left-0 top-0 bottom-0 overflow-y-auto">
            <!-- Logo -->
            <div class="p-4 border-b border-[#27272A]">
                <div class="flex items-center gap-2">
                    <span class="text-white font-medium">Arts Of Code</span>
                    <span class="bg-[var(--accent)] text-white text-[11px] px-2 py-1 rounded">Admin</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-2">
                <a href="/admin"
                    class="block px-4 py-2 text-sm rounded hover:bg-[#27272A] {{ request()->is('admin') ? 'text-white font-medium bg-[#27272A]' : '' }}">
                    Dashboard
                </a>
                <a href="/admin/articles"
                    class="block px-4 py-2 text-sm rounded hover:bg-[#27272A] {{ request()->is('admin/articles*') ? 'text-white font-medium bg-[#27272A]' : '' }}">
                    Articles
                </a>
                <a href="/admin/users"
                    class="block px-4 py-2 text-sm rounded hover:bg-[#27272A] {{ request()->is('admin/users*') ? 'text-white font-medium bg-[#27272A]' : '' }}">
                    Users
                </a>
                <a href="/admin/exams"
                    class="block px-4 py-2 text-sm rounded hover:bg-[#27272A] {{ request()->is('admin/exams*') ? 'text-white font-medium bg-[#27272A]' : '' }}">
                    Exams
                </a>
                <a href="/admin/questions"
                    class="block px-4 py-2 text-sm rounded hover:bg-[#27272A] {{ request()->is('admin/questions*') ? 'text-white font-medium bg-[#27272A]' : '' }}">
                    Questions
                </a>
            </nav>

            <!-- Back to Site -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-[#27272A]">
                <a href="/" class="text-[#9CA3AF] text-sm hover:text-white transition-colors">
                    ← Back to site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-[220px] p-8">
            @yield('admin-content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>