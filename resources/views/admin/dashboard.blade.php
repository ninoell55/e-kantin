{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard - Kantin Admin')

@section('styles')
<style>
    /* PAGE HEADER */
    .page-header { margin-bottom: 28px !important; }
    .page-title { font-size: 22px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 4px !important; }

    /* STAT GRID */
    .stat-grid { display: grid !important; grid-template-columns: repeat(4, 1fr) !important; gap: 16px !important; margin-bottom: 24px !important; }

    .stat-card {
        background: #fff !important; border-radius: 14px !important;
        border: 1px solid #e8eaf0 !important; padding: 20px !important;
        display: flex !important; align-items: center !important; gap: 16px !important;
        transition: transform 0.2s, box-shadow 0.2s !important;
        animation: fadeUp 0.4s ease both !important;
    }
    .stat-card:hover { transform: translateY(-3px) !important; box-shadow: 0 8px 24px rgba(26,31,60,0.1) !important; }
    .stat-card:nth-child(1) { animation-delay: 0.05s !important; }
    .stat-card:nth-child(2) { animation-delay: 0.1s !important; }
    .stat-card:nth-child(3) { animation-delay: 0.15s !important; }
    .stat-card:nth-child(4) { animation-delay: 0.2s !important; }

    .stat-icon {
        width: 52px !important; height: 52px !important; border-radius: 14px !important;
        display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important;
    }
    .stat-icon svg { width: 24px !important; height: 24px !important; }
    .icon-blue  { background: #e8eeff !important; color: #3d4fd6 !important; }
    .icon-green { background: #e6f7ee !important; color: #16a34a !important; }
    .icon-amber { background: #fff7e6 !important; color: #d97706 !important; }
    .icon-red   { background: #fef2f2 !important; color: #dc2626 !important; }
    .stat-info { display: flex !important; flex-direction: column !important; gap: 3px !important; }
    .stat-label { font-size: 11px !important; font-weight: 600 !important; color: var(--gray-400) !important; text-transform: uppercase !important; letter-spacing: 0.06em !important; }
    .stat-value { font-size: 24px !important; font-weight: 700 !important; color: var(--navy) !important; line-height: 1.1 !important; }
    .stat-note  { font-size: 11px !important; color: var(--gray-400) !important; margin-top: 2px !important; }

    /* MAIN GRID */
    .main-grid { display: grid !important; grid-template-columns: 1fr 320px !important; gap: 20px !important; margin-bottom: 20px !important; }
    .bottom-grid { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 20px !important; }

    /* CARD */
    .card { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; overflow: hidden !important; animation: fadeUp 0.4s ease both !important; }
    .card-header { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 18px 20px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .card-title { font-size: 15px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .card-body { padding: 20px !important; }

    /* CHART BAR */
    .chart-wrap { display: flex !important; align-items: flex-end !important; gap: 10px !important; height: 160px !important; padding: 0 4px !important; }
    .chart-col { display: flex !important; flex-direction: column !important; align-items: center !important; gap: 6px !important; flex: 1 !important; }
    .chart-bar-wrap { flex: 1 !important; display: flex !important; align-items: flex-end !important; width: 100% !important; }
    .chart-bar {
        width: 100% !important; border-radius: 6px 6px 0 0 !important;
        background: var(--accent) !important; min-height: 4px !important;
        transition: height 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        position: relative !important; cursor: pointer !important;
    }
    .chart-bar:hover { opacity: 0.8 !important; }
    .chart-bar.bar-paid { background: #16a34a !important; }
    .chart-bar.bar-unpaid { background: #f59e0b !important; }
    .chart-bar.bar-overdue { background: #dc2626 !important; }
    .chart-bar-tooltip {
        display: none; position: absolute !important; bottom: calc(100% + 6px) !important;
        left: 50% !important; transform: translateX(-50%) !important;
        background: var(--navy) !important; color: #fff !important;
        font-size: 11px !important; padding: 4px 8px !important; border-radius: 6px !important;
        white-space: nowrap !important; z-index: 10 !important;
    }
    .chart-bar:hover .chart-bar-tooltip { display: block !important; }
    .chart-label { font-size: 11px !important; color: var(--gray-400) !important; }

    /* STATUS PILLS */
    .status-pill { display: inline-block !important; padding: 3px 10px !important; border-radius: 99px !important; font-size: 11px !important; font-weight: 700 !important; }
    .status-paid    { background: #e6f7ee !important; color: #15803d !important; }
    .status-unpaid  { background: #fff7e6 !important; color: #d97706 !important; }
    .status-overdue { background: #fef2f2 !important; color: #dc2626 !important; }

    /* DONUT */
    .donut-wrap { display: flex !important; align-items: center !important; gap: 24px !important; }
    .donut-svg { flex-shrink: 0 !important; }
    .donut-legend { display: flex !important; flex-direction: column !important; gap: 10px !important; }
    .legend-item { display: flex !important; align-items: center !important; gap: 8px !important; font-size: 13px !important; }
    .legend-dot { width: 10px !important; height: 10px !important; border-radius: 50% !important; flex-shrink: 0 !important; }

    /* QUICK ACTIONS */
    .quick-actions { display: flex !important; flex-direction: column !important; gap: 8px !important; }
    .quick-btn {
        display: flex !important; align-items: center !important; gap: 12px !important;
        padding: 12px 14px !important; border-radius: 10px !important; border: 1px solid #e8eaf0 !important;
        background: #fff !important; text-decoration: none !important; color: var(--navy) !important;
        font-size: 14px !important; font-weight: 500 !important; cursor: pointer !important;
        transition: background 0.15s, border-color 0.15s, transform 0.15s !important; font-family: var(--font) !important;
    }
    .quick-btn:hover { background: #f4f5f9 !important; border-color: var(--accent) !important; transform: translateX(3px) !important; }
    .quick-btn svg { width: 16px !important; height: 16px !important; color: var(--accent) !important; flex-shrink: 0 !important; }
    .quick-btn-icon { width: 34px !important; height: 34px !important; border-radius: 8px !important; display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important; }
    .quick-btn-icon svg { width: 16px !important; height: 16px !important; }

    /* NOTIFICATIONS */
    .notif-list { display: flex !important; flex-direction: column !important; gap: 10px !important; }
    .notif-item { display: flex !important; align-items: flex-start !important; gap: 10px !important; padding: 12px !important; border-radius: 10px !important; border: 1px solid transparent !important; }
    .notif-warn { background: #fff7e6 !important; border-color: #fde68a !important; }
    .notif-ok   { background: #e6f7ee !important; border-color: #bbf7d0 !important; }
    .notif-info { background: #e8eeff !important; border-color: #c5cdf8 !important; }
    .notif-icon { width: 30px !important; height: 30px !important; border-radius: 8px !important; display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important; }
    .notif-icon svg { width: 15px !important; height: 15px !important; }
    .notif-warn .notif-icon { background: #fde68a !important; color: #d97706 !important; }
    .notif-ok   .notif-icon { background: #bbf7d0 !important; color: #15803d !important; }
    .notif-info .notif-icon { background: #c5cdf8 !important; color: #3d4fd6 !important; }
    .notif-title { font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 2px !important; }
    .notif-sub   { font-size: 12px !important; color: var(--gray-400) !important; }

    /* VENDOR TABLE */
    .vendor-table { width: 100% !important; border-collapse: collapse !important; font-size: 13px !important; }
    .vendor-table th { padding: 10px 14px !important; text-align: left !important; font-size: 11px !important; font-weight: 600 !important; color: var(--gray-400) !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; border-bottom: 1px solid #e8eaf0 !important; background: #f8f9fc !important; }
    .vendor-table td { padding: 12px 14px !important; color: var(--navy) !important; border-bottom: 1px solid #f0f1f5 !important; vertical-align: middle !important; }
    .vendor-table tbody tr:last-child td { border-bottom: none !important; }
    .vendor-table tbody tr:hover { background: #fafbff !important; }
    .td-name { font-weight: 600 !important; }
    .td-cat  { color: var(--gray-400) !important; }
    .td-amt  { font-weight: 600 !important; color: var(--accent) !important; }
    .td-date { color: var(--gray-400) !important; font-size: 12px !important; }
    .btn-sm-detail { display: inline-flex !important; align-items: center !important; padding: 4px 10px !important; border-radius: 6px !important; font-size: 11px !important; font-weight: 500 !important; background: #e8eeff !important; color: var(--accent) !important; text-decoration: none !important; }
    .btn-sm-remind { display: inline-flex !important; align-items: center !important; padding: 4px 10px !important; border-radius: 6px !important; font-size: 11px !important; font-weight: 500 !important; background: #fff7e6 !important; color: #d97706 !important; text-decoration: none !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }

    /* SUMMARY */
    .summary-rows { display: flex !important; flex-direction: column !important; gap: 12px !important; }
    .summary-row { display: flex !important; justify-content: space-between !important; align-items: center !important; font-size: 14px !important; }
    .summary-label { color: var(--gray-400) !important; }
    .summary-value { font-weight: 600 !important; color: var(--navy) !important; }
    .summary-value.green { color: #16a34a !important; }
    .summary-value.amber { color: #d97706 !important; }
    .progress-wrap { margin-top: 16px !important; }
    .progress-bar-bg { height: 8px !important; background: #f0f1f5 !important; border-radius: 99px !important; overflow: hidden !important; display: flex !important; }
    .progress-bar-fill { height: 100% !important; border-radius: 99px !important; transition: width 1s ease !important; }
    .progress-label { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 6px !important; text-align: center !important; }

    /* INFO LIST */
    .info-list { display: flex !important; flex-direction: column !important; gap: 10px !important; }
    .info-item { display: flex !important; align-items: center !important; gap: 10px !important; padding: 10px 12px !important; border-radius: 8px !important; background: #f8f9fc !important; border: 1px solid #e8eaf0 !important; font-size: 13px !important; color: var(--navy) !important; }
    .info-item svg { width: 15px !important; height: 15px !important; color: var(--accent) !important; flex-shrink: 0 !important; }

    /* ANIMATION */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes countUp {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .card:nth-child(1) { animation-delay: 0.1s !important; }
    .card:nth-child(2) { animation-delay: 0.15s !important; }
    .card:nth-child(3) { animation-delay: 0.2s !important; }
    .card:nth-child(4) { animation-delay: 0.25s !important; }
</style>
@endsection

@section('content')

{{-- PAGE HEADER --}}
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-sub">Selamat datang, {{ Auth::user()->name }} 👋</p>
</div>

{{-- STAT CARDS --}}
<div class="stat-grid">
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
            <span class="stat-value" data-target="{{ $totalPenjual ?? 0 }}">{{ $totalPenjual ?? 0 }}</span>
            <span class="stat-note">Vendor aktif</span>
        </div>
    </div>

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
            <span class="stat-note">Terdaftar</span>
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
            <span class="stat-label">Pembayaran Bulan Ini</span>
            <span class="stat-value">Rp {{ number_format(($totalTagihan ?? 0) / 1000, 0, ',', '.') }}K</span>
            <span class="stat-note">Dari sewa</span>
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
            <span class="stat-note">Customer aktif</span>
        </div>
    </div>
</div>

{{-- MAIN GRID --}}
<div class="main-grid">

    {{-- CHART --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Pemasukan Sewa per Bulan</span>
            <span style="font-size:12px !important; color:var(--gray-400) !important;">{{ now()->year }}</span>
        </div>
        <div class="card-body">
            <div class="chart-wrap" id="barChart">
                @php
                    $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    $chartData = $monthlyRevenue ?? array_fill(0, 12, 0);
                    $maxVal = max($chartData) ?: 1;
                @endphp
                @foreach($months as $i => $month)
                @php $pct = ($chartData[$i] / $maxVal) * 100; @endphp
                <div class="chart-col">
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height: {{ max($pct, 3) }}%; background: {{ $i === (int)now()->format('n')-1 ? '#3d4fd6' : '#c5cdf8' }} !important;">
                            <div class="chart-bar-tooltip">Rp {{ number_format($chartData[$i], 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <span class="chart-label">{{ $month }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- KANAN: DONUT + QUICK ACTIONS + NOTIF --}}
    <div style="display:flex !important; flex-direction:column !important; gap:16px !important;">

        {{-- STATUS PEMBAYARAN DONUT --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Status Pembayaran</span>
            </div>
            <div class="card-body" style="padding:16px 20px !important;">
                @php
                    $paidCount    = $paidCount    ?? 0;
                    $unpaidCount  = $unpaidCount  ?? 0;
                    $overdueCount = $overdueCount ?? 0;
                    $totalBills   = $paidCount + $unpaidCount + $overdueCount ?: 1;
                    $paidPct    = round(($paidCount / $totalBills) * 100);
                    $unpaidPct  = round(($unpaidCount / $totalBills) * 100);
                    $overduePct = 100 - $paidPct - $unpaidPct;
                    // SVG donut
                    $r = 40; $cx = 52; $cy = 52; $circ = 2 * M_PI * $r;
                    $paidDash    = ($paidPct / 100) * $circ;
                    $unpaidDash  = ($unpaidPct / 100) * $circ;
                    $overdueDash = ($overduePct / 100) * $circ;
                    $paidOffset    = 0;
                    $unpaidOffset  = -$paidDash;
                    $overdueOffset = -$paidDash - $unpaidDash;
                @endphp
                <div class="donut-wrap">
                    <svg width="104" height="104" class="donut-svg" viewBox="0 0 104 104">
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f0f1f5" stroke-width="14"/>
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#16a34a" stroke-width="14"
                            stroke-dasharray="{{ $paidDash }} {{ $circ - $paidDash }}"
                            stroke-dashoffset="{{ $paidOffset }}" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f59e0b" stroke-width="14"
                            stroke-dasharray="{{ $unpaidDash }} {{ $circ - $unpaidDash }}"
                            stroke-dashoffset="{{ $unpaidOffset }}" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#dc2626" stroke-width="14"
                            stroke-dasharray="{{ $overdueDash }} {{ $circ - $overdueDash }}"
                            stroke-dashoffset="{{ $overdueOffset }}" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        <text x="{{ $cx }}" y="{{ $cy - 4 }}" text-anchor="middle" font-size="16" font-weight="700" fill="#1a1f3c">{{ $paidCount }}/{{ $totalBills }}</text>
                        <text x="{{ $cx }}" y="{{ $cy + 14 }}" text-anchor="middle" font-size="10" fill="#9ca3b8">Terbayar</text>
                    </svg>
                    <div class="donut-legend">
                        <div class="legend-item"><div class="legend-dot" style="background:#16a34a !important;"></div><span>Lunas ({{ $paidCount }})</span></div>
                        <div class="legend-item"><div class="legend-dot" style="background:#f59e0b !important;"></div><span>Menunggu ({{ $unpaidCount }})</span></div>
                        <div class="legend-item"><div class="legend-dot" style="background:#dc2626 !important;"></div><span>Overdue ({{ $overdueCount }})</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- NOTIFIKASI --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Pemberitahuan</span></div>
            <div class="card-body" style="padding:14px !important;">
                <div class="notif-list">
                    @if(isset($overdueVendors) && count($overdueVendors) > 0)
                        @foreach($overdueVendors as $ov)
                        <div class="notif-item notif-warn">
                            <div class="notif-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </div>
                            <div><div class="notif-title">Pembayaran jatuh tempo</div><div class="notif-sub">{{ $ov->shop->name ?? '-' }} belum bayar sewa bulan ini</div></div>
                        </div>
                        @endforeach
                    @endif
                    @if(isset($recentPaid) && count($recentPaid) > 0)
                        @foreach($recentPaid as $rp)
                        <div class="notif-item notif-ok">
                            <div class="notif-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            </div>
                            <div><div class="notif-title">Pembayaran diterima</div><div class="notif-sub">{{ $rp->shop->name ?? '-' }} konfirmasi bulan {{ $rp->month }}</div></div>
                        </div>
                        @endforeach
                    @endif
                    @if((!isset($overdueVendors) || count($overdueVendors) === 0) && (!isset($recentPaid) || count($recentPaid) === 0))
                    <div class="notif-item notif-info">
                        <div class="notif-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div><div class="notif-title">Semua pembayaran lancar</div><div class="notif-sub">Tidak ada notifikasi terbaru</div></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

{{-- BOTTOM GRID --}}
<div class="bottom-grid">

    {{-- DAFTAR VENDOR --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Vendor & Pembayaran</span>
            <a href="{{ route('admin.vendor.index') }}" style="font-size:12px !important; color:var(--accent) !important; text-decoration:none !important;">Lihat semua →</a>
        </div>
        <table class="vendor-table">
            <thead>
                <tr>
                    <th>Nama Vendor</th>
                    <th>Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vendors ?? [] as $vendor)
                @php
                    $bill = $vendor->shop->currentBill ?? null;
                    $vs = $bill ? $bill->status : 'unpaid';
                    if ($vs === 'unpaid' && $bill && now()->gt(\Carbon\Carbon::parse($bill->due_date))) $vs = 'overdue';
                @endphp
                <tr>
                    <td>
                        <div class="td-name">{{ $vendor->name }}</div>
                        <div class="td-cat">{{ $vendor->shop->name ?? '-' }}</div>
                    </td>
                    <td class="td-amt">Rp {{ number_format($bill->amount ?? 0, 0, ',', '.') }}</td>
                    <td><span class="status-pill status-{{ $vs }}">{{ strtoupper($vs) }}</span></td>
                    <td>
                        @if($bill)
                            <a href="{{ route('admin.invoice.detail', $bill->id) }}" class="btn-sm-detail">Detail</a>
                        @else
                            <span style="color:var(--gray-400) !important; font-size:12px !important;">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center !important; padding:24px !important; color:var(--gray-400) !important; font-size:13px !important;">Belum ada vendor</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- KANAN: RINGKASAN + AKSI CEPAT --}}
    <div style="display:flex !important; flex-direction:column !important; gap:16px !important;">

        {{-- RINGKASAN --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Ringkasan Bulan Ini</span></div>
            <div class="card-body">
                @php
                    $targetSewa   = $targetSewa ?? 0;
                    $terbayar     = $totalTagihan ?? 0;
                    $menunggu     = $menungguTagihan ?? 0;
                    $pct          = $targetSewa > 0 ? min(round(($terbayar / $targetSewa) * 100), 100) : 0;
                    $pctMenunggu  = $targetSewa > 0 ? min(round(($menunggu / $targetSewa) * 100), 100) : 0;
                @endphp
                <div class="summary-rows">
                    <div class="summary-row">
                        <span class="summary-label">Total target sewa</span>
                        <span class="summary-value">Rp {{ number_format($targetSewa, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Terbayar</span>
                        <span class="summary-value green">Rp {{ number_format($terbayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Menunggu pembayaran</span>
                        <span class="summary-value amber">Rp {{ number_format($menunggu, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="progress-wrap">
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width:{{ $pct }}% !important; background:#16a34a !important;"></div>
                        <div class="progress-bar-fill" style="width:{{ $pctMenunggu }}% !important; background:#f59e0b !important;"></div>
                    </div>
                    <div class="progress-label">{{ $pct }}% terbayar</div>
                </div>
            </div>
        </div>

        {{-- AKSI CEPAT --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Aksi Cepat</span></div>
            <div class="card-body" style="padding:14px !important;">
                <div class="quick-actions">
                    <a href="{{ route('admin.vendor.create') }}" class="quick-btn">
                        <div class="quick-btn-icon" style="background:#e8eeff !important; color:#3d4fd6 !important;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/>
                            </svg>
                        </div>
                        Tambah Vendor
                    </a>
                    <a href="{{ route('admin.invoice.index') }}" class="quick-btn">
                        <div class="quick-btn-icon" style="background:#e6f7ee !important; color:#16a34a !important;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>
                        Lihat Invoice
                    </a>
                    <a href="{{ route('admin.category.index') }}" class="quick-btn">
                        <div class="quick-btn-icon" style="background:#fff7e6 !important; color:#d97706 !important;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                            </svg>
                        </div>
                        Kelola Kategori
                    </a>
                    <a href="{{ route('admin.costumer.index') }}" class="quick-btn">
                        <div class="quick-btn-icon" style="background:#fef2f2 !important; color:#dc2626 !important;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                            </svg>
                        </div>
                        Kelola Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Animate bars on load
document.addEventListener('DOMContentLoaded', function() {
    const bars = document.querySelectorAll('.chart-bar');
    bars.forEach((bar, i) => {
        const h = bar.style.height;
        bar.style.height = '0%';
        setTimeout(() => { bar.style.height = h; }, 100 + i * 60);
    });
});
</script>
@endsection