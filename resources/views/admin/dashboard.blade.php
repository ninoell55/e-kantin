{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard - Kantin Admin')

@section('content')
<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    @include('layouts.navigation.admin.sidebar')

    {{-- MAIN AREA --}}
    <div class="main-area">

        {{-- TOPBAR --}}
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

        {{-- DASHBOARD CONTENT --}}
        <main class="page-content">

            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
            </div>

            {{-- Stat Cards --}}
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 6h16M4 10h16M4 14h8"/>
                            <rect x="2" y="3" width="20" height="16" rx="2"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Kategori</span>
                        <span class="stat-value">{{ $totalKategori ?? 0 }}</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Pengguna</span>
                        <span class="stat-value">{{ $totalPengguna ?? 0 }}</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Penjual</span>
                        <span class="stat-value">{{ $totalPenjual ?? 0 }}</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Tagihan</span>
                        <span class="stat-value">Rp {{ number_format($totalTagihan ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

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

    body { font-family: var(--font); background: var(--gray-100); }

    /* LAYOUT */
    .admin-wrapper { display: flex; min-height: 100vh; }

    /* SIDEBAR */
    .sidebar {
        width: var(--sidebar-w); min-height: 100vh;
        background: var(--navy); display: flex;
        flex-direction: column; flex-shrink: 0;
        position: fixed; top: 0; left: 0; z-index: 100;
    }
    .sidebar-brand {
        display: flex; align-items: center; gap: 10px;
        padding: 20px 20px 18px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .brand-dot { width: 14px; height: 14px; border-radius: 50%; background: var(--white); flex-shrink: 0; }
    .brand-text { display: flex; flex-direction: column; line-height: 1.2; }
    .brand-title { font-size: 15px; font-weight: 600; color: var(--white); }
    .brand-sub { font-size: 10px; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }

    /* NAV */
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

    /* DROPDOWN */
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

    /* MAIN */
    .main-area { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

    /* TOPBAR */
    .topbar {
        height: var(--topbar-h); background: var(--white);
        border-bottom: 1px solid #e8eaf0;
        display: flex; align-items: center; padding: 0 28px; gap: 16px;
        position: sticky; top: 0; z-index: 50;
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

    /* PAGE CONTENT */
    .page-content { padding: 28px; flex: 1; }
    .page-header { margin-bottom: 24px; }
    .page-title { font-size: 20px; font-weight: 600; color: var(--navy); }

    /* STAT CARDS */
    .stat-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
    .stat-card {
        background: var(--white); border-radius: 14px;
        border: 1px solid #e8eaf0; padding: 20px;
        display: flex; align-items: center; gap: 16px;
    }
    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .stat-icon svg { width: 22px; height: 22px; }
    .icon-blue  { background: #e8eeff; color: #3d4fd6; }
    .icon-green { background: #e6f7ee; color: #16a34a; }
    .icon-amber { background: #fff7e6; color: #d97706; }
    .icon-red   { background: #fef2f2; color: #dc2626; }
    .stat-info { display: flex; flex-direction: column; gap: 4px; }
    .stat-label { font-size: 12px; color: var(--gray-400); font-weight: 500; }
    .stat-value { font-size: 20px; font-weight: 600; color: var(--navy); }
</style>
@endsection