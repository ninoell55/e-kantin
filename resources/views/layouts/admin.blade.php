{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kantin Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0; 
        }

        :root {
            --navy: #0f172a;
            --navy-hover: #8f1700;
            --accent: #730f00;
            --accent-bg: rgba(115, 15, 0, 0.12);
            --white: #ffffff;
            --gray-100: #f4f5f9;
            --gray-400: #9ca3b8;
            --sidebar-w: 260px;
            --topbar-h: 68px;
            --font: 'DM Sans', sans-serif;
        }

        html,body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: var(--font);
            background: var(--gray-100);
            overflow: hidden !important;
        }

        .admin-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px 20px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            flex-shrink: 0;
        }

        .brand-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--white);
            flex-shrink: 0;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--white);
        }

        .brand-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 2px;
        }

        .sidebar-nav {
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            transition: all 0.15s ease;
            font-family: var(--font);
        }

        .nav-item:hover {
            background: var(--navy-hover);
            color: var(--white);
        }

        .nav-item.active {
            background: var(--accent-bg);
            color: var(--white);
            position: relative;
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 3px 0 0 3px;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .chevron {
            width: 14px;
            height: 14px;
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
        }

        .nav-sub {
            display: none;
            flex-direction: column;
            padding: 4px 0 4px 42px;
        }

        .nav-group.open .nav-sub {
            display: flex;
        }

        .nav-group.open .chevron {
            transform: rotate(180deg);
        }

        .nav-sub-item {
            display: block;
            padding: 9px 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            border-radius: 7px;
            transition: all 0.15s ease;
        }

        .nav-sub-item:hover {
            background: var(--navy-hover);
            color: var(--white);
        }

        .nav-sub-item.active {
            color: var(--white);
            background: var(--accent-bg);
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            flex-shrink: 0;
        }

        .logout-btn {
            color: #f87171 !important;
        }

        .logout-btn:hover {
            background: rgba(248, 113, 113, 0.12) !important;
        }

        /* MAIN AREA */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* TOPBAR */
        .topbar {
            height: var(--topbar-h);
            min-height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid #e8eaf0;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 12px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left {
            flex: 1;
        }

        .topbar-greeting {
            font-size: 17px;
            font-weight: 700;
            color: #111827;
        }

        .topbar-sub {
            font-size: 12px;
            color: var(--gray-400);
            margin-top: 2px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* NOTIF BELL */
        .notif-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid #e8eaf0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s;
        }

        .notif-btn:hover {
            background: var(--gray-100);
        }

        .notif-btn svg {
            width: 18px;
            height: 18px;
            color: #6b7280;
        }

        .notif-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 17px;
            height: 17px;
            background: #dc2626;
            border-radius: 50%;
            font-size: 9px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        /* NOTIF DROPDOWN */
        .notif-wrap {
            position: relative;
        }

        .notif-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 320px;
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e8eaf0;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            z-index: 300;
            overflow: hidden;
        }

        .notif-dropdown.show {
            display: block;
            animation: dropIn 0.2s ease;
        }

        @keyframes dropIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notif-dropdown-header {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f1f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notif-dropdown-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .notif-dropdown-body {
            max-height: 320px;
            overflow-y: auto;
        }

        .notif-drop-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            border-bottom: 1px solid #f8f9fc;
            transition: background 0.15s;
        }

        .notif-drop-item:last-child {
            border-bottom: none;
        }

        .notif-drop-item:hover {
            background: #f8f9fc;
        }

        .notif-drop-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notif-drop-icon svg {
            width: 15px;
            height: 15px;
        }

        .notif-drop-icon.warn {
            background: #fff7e6;
            color: #d97706;
        }

        .notif-drop-icon.ok {
            background: #e6f7ee;
            color: #16a34a;
        }

        .notif-drop-title {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .notif-drop-sub {
            font-size: 12px;
            color: var(--gray-400);
            margin-top: 2px;
            line-height: 1.4;
        }

        .notif-drop-empty {
            padding: 24px;
            text-align: center;
            color: var(--gray-400);
            font-size: 13px;
        }

        /* USER PROFILE */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 8px;
            border-radius: 99px;
            border: 1.5px solid #e8eaf0;
            background: #fff;
            cursor: pointer;
            transition: background 0.15s;
        }

        .user-profile:hover {
            background: var(--gray-100);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--navy);
            color: var(--white);
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .user-role {
            font-size: 10px;
            color: var(--gray-400);
            letter-spacing: 0.05em;
        }

        /* PAGE CONTENT */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* MODAL */
        .modal-backdrop {
            display: none !important;
            position: fixed !important;
            inset: 0 !important;
            background: rgba(15, 20, 40, 0.45) !important;
            z-index: 200 !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .modal-backdrop.show {
            display: flex !important;
        }

        .modal {
            background: #fff !important;
            border-radius: 16px !important;
            width: 100% !important;
            max-width: 420px !important;
            margin: 16px !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15) !important;
            animation: modalIn 0.2s ease !important;
            overflow: hidden !important;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="admin-wrapper">

        @include('layouts.navigation.admin.sidebar')

        <div class="main-area">
            <header class="topbar">
                {{-- Greeting --}}
                <div class="topbar-left">
                    <div class="topbar-greeting">Selamat datang, {{ Auth::user()->name }}! 👋</div>
                    <div class="topbar-sub">{{ now()->translatedFormat('l, d F Y') }}</div>
                </div>

                <div class="topbar-actions">
                    {{-- NOTIFIKASI --}}
                    <div class="notif-wrap" id="notifWrap">
                        <button class="notif-btn" onclick="toggleNotif()" id="notifBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                            @if(isset($notifCount) && $notifCount > 0)
                            <span class="notif-badge">{{ $notifCount }}</span>
                            @endif
                        </button>

                        <div class="notif-dropdown" id="notifDropdown">
                            <div class="notif-dropdown-header">
                                <span class="notif-dropdown-title">Pemberitahuan</span>
                                @if(isset($notifCount) && $notifCount > 0)
                                <span style="font-size:11px;color:#dc2626;font-weight:600;">{{ $notifCount }} baru</span>
                                @endif
                            </div>
                            <div class="notif-dropdown-body">
                                @if(isset($overdueVendors) && count($overdueVendors) > 0)
                                @foreach($overdueVendors as $ov)
                                <div class="notif-drop-item">
                                    <div class="notif-drop-icon warn">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" y1="8" x2="12" y2="12" />
                                            <line x1="12" y1="16" x2="12.01" y2="16" />
                                        </svg>
                                    </div>
                                    <div class="notif-drop-text">
                                        <div class="notif-drop-title">Pembayaran Jatuh Tempo</div>
                                        <div class="notif-drop-sub">{{ $ov->shop->name ?? '-' }} belum bayar sewa bulan ini</div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @if(isset($recentPaid) && count($recentPaid) > 0)
                                @foreach($recentPaid as $rp)
                                <div class="notif-drop-item">
                                    <div class="notif-drop-icon ok">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <polyline points="22 4 12 14.01 9 11.01" />
                                        </svg>
                                    </div>
                                    <div class="notif-drop-text">
                                        <div class="notif-drop-title">Pembayaran Diterima</div>
                                        <div class="notif-drop-sub">{{ $rp->shop->name ?? '-' }} konfirmasi bulan {{ $rp->month }}</div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @if((!isset($overdueVendors) || count($overdueVendors) === 0) && (!isset($recentPaid) || count($recentPaid) === 0))
                                <div class="notif-drop-empty">Tidak ada notifikasi baru</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- USER PROFILE --}}
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">{{ Auth::user()->role ?? 'Administrator' }}</span>
                        </div>
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
            document.getElementById(groupId).classList.toggle('open');
        }

        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('show');
        }

        function toggleNotif() {
            document.getElementById('notifDropdown').classList.toggle('show');
        }
        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('notifWrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('notifDropdown').classList.remove('show');
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal-backdrop').forEach(function(el) {
                el.addEventListener('click', function(e) {
                    if (e.target === el) closeModal(el.id);
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>