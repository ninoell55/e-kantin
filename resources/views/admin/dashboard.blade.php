{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard - Kantin Admin')

@section('styles')
<style>
    .page-header { margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .stat-grid { display: grid !important; grid-template-columns: repeat(4, minmax(0, 1fr)) !important; gap: 16px !important; margin-top: 24px !important; }
    .stat-card {
        background: var(--white) !important; border-radius: 14px !important;
        border: 1px solid #e8eaf0 !important; padding: 20px !important;
        display: flex !important; align-items: center !important; gap: 16px !important;
        transition: transform 0.15s, box-shadow 0.15s !important;
    }
    .stat-card:hover { transform: translateY(-2px) !important; box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important; }
    .stat-icon {
        width: 48px !important; height: 48px !important; border-radius: 12px !important;
        display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important;
    }
    .stat-icon svg { width: 22px !important; height: 22px !important; }
    .icon-blue  { background: #e8eeff !important; color: #3d4fd6 !important; }
    .icon-green { background: #e6f7ee !important; color: #16a34a !important; }
    .icon-amber { background: #fff7e6 !important; color: #d97706 !important; }
    .icon-red   { background: #fef2f2 !important; color: #dc2626 !important; }
    .stat-info { display: flex !important; flex-direction: column !important; gap: 4px !important; }
    .stat-label { font-size: 12px !important; color: var(--gray-400) !important; font-weight: 500 !important; text-transform: uppercase !important; letter-spacing: 0.04em !important; }
    .stat-value { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
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
@endsection