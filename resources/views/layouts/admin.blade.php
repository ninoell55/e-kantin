{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kantin Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #1a1f3c;
            --navy-hover:#2e3560;
            --accent:    #3d4fd6;
            --accent-bg: rgba(61,79,214,0.12);
            --white:     #ffffff;
            --gray-100:  #f4f5f9;
            --gray-400:  #9ca3b8;
            --sidebar-w: 260px;
            --topbar-h:  64px;
            --font:      'Poppins', sans-serif;
        }

        /* ── RESET PENTING ── */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: var(--font);
            background: var(--gray-100);
            overflow-x: hidden;
        }

        /* ── LAYOUT ── */
        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden; /* cegah scroll di wrapper */
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            display: flex; align-items: center; gap: 10px;
            padding: 20px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            flex-shrink: 0;
        }
        .brand-dot { width: 14px; height: 14px; border-radius: 50%; background: var(--white); flex-shrink: 0; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.2; }
        .brand-title { font-size: 15px; font-weight: 600; color: var(--white); }
        .brand-sub { font-size: 10px; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }

        .sidebar-nav { padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; flex: 1; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 14px; border-radius: 10px;
            font-size: 14px; font-weight: 500; color: var(--gray-400);
            text-decoration: none; cursor: pointer;
            background: none; border: none; width: 100%; text-align: left;
            transition: background 0.15s, color 0.15s;
        }
        .nav-item:hover { background: var(--navy-hover); color: var(--white); }
        .nav-item.active { background: var(--accent-bg); color: var(--white); position: relative; }
        .nav-item.active::after {
            content: ''; position: absolute; right: 0; top: 20%; bottom: 20%;
            width: 3px; background: var(--accent); border-radius: 3px 0 0 3px;
        }
        .nav-icon { width: 18px; height: 18px; flex-shrink: 0; }
        .chevron { width: 14px; height: 14px; margin-left: auto; transition: transform 0.25s ease; }

        .nav-group { display: flex; flex-direction: column; }
        .nav-sub { display: none; flex-direction: column; padding: 4px 0 4px 42px; }
        .nav-group.open .nav-sub { display: flex; }
        .nav-group.open .chevron { transform: rotate(180deg); }
        .nav-sub-item {
            display: block; padding: 9px 10px;
            font-size: 13px; color: var(--gray-400);
            text-decoration: none; border-radius: 7px;
            transition: background 0.15s, color 0.15s;
        }
        .nav-sub-item:hover { background: var(--navy-hover); color: var(--white); }
        .nav-sub-item.active { color: var(--white); background: var(--navy-hover); }

        /* ── MAIN AREA ── */
        .main-area {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;       /* pas dengan viewport */
            overflow-y: auto;    /* scroll HANYA di sini */
        }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-h);
            min-height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid #e8eaf0;
            display: flex; align-items: center;
            padding: 0 28px; gap: 16px;
            position: sticky; top: 0; z-index: 50; /* sticky dalam .main-area */
        }
        .search-wrap { flex: 1; max-width: 440px; position: relative; }
        .search-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 16px; height: 16px; color: var(--gray-400);
        }
        .search-input {
            width: 100%; padding: 9px 16px 9px 40px;
            border: 1.5px solid #e8eaf0; border-radius: 999px;
            font-family: var(--font); font-size: 14px; color: var(--navy);
            background: var(--gray-100); outline: none; transition: border-color 0.15s;
        }
        .search-input:focus { border-color: var(--accent); background: var(--white); }
        .search-input::placeholder { color: var(--gray-400); }

        .user-profile { display: flex; align-items: center; gap: 12px; margin-left: auto; cursor: pointer; }
        .user-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--navy); color: var(--white);
            font-size: 13px; font-weight: 600;
            display: flex; align-items: center; justify-content: center;
        }
        .user-info { display: flex; flex-direction: column; line-height: 1.2; }
        .user-name { font-size: 14px; font-weight: 600; color: var(--navy); }
        .user-role { font-size: 10px; color: var(--gray-400); letter-spacing: 0.07em; }

        /* ── PAGE CONTENT ── */
        .page-content { padding: 28px; flex: 1; }
    </style>

    {{-- CSS tambahan per halaman --}}
    @yield('styles')
</head>

<body>
<div class="admin-wrapper">

    @include('layouts.navigation.admin.sidebar')

    <div class="main-area">

        <header class="topbar">
            <div class="search-wrap">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="16.5" y1="16.5" x2="21" y2="21"/>
                </svg>
                <input type="text" class="search-input" placeholder="Cari sesuatu...">
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ strtoupper(Auth::user()->role ?? 'Administrator') }}</span>
                </div>
            </div>
        </header>

        <main class="page-content">
            @yield('content')
        </main>

    </div>
</div>

<script>
    function toggleGroup(groupId) {
        const group = document.getElementById(groupId);
        group.classList.toggle('open');
    }
</script>
@yield('scripts')
</body>
</html>