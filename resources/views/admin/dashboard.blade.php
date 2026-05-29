{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard - Kantin Admin')

@section('styles')
<style>
    .dashboard-container { animation: fadeUp 0.4s ease both; max-width: 100%; overflow-x: hidden; }
    
    .dash-header { display: flex !important; justify-content: space-between !important; align-items: center !important; margin-bottom: 24px !important; flex-wrap: wrap !important; gap: 16px !important; }
    .dash-welcome h1 { font-size: 24px !important; font-weight: 700 !important; color: var(--navy) !important; margin: 0 0 4px 0 !important; }
    .dash-welcome p { font-size: 13px !important; color: var(--gray-400) !important; margin: 0 !important; }
    .dash-filters { display: flex !important; align-items: center !important; gap: 12px !important; }
    .select-period { padding: 10px 32px 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 12px !important; font-size: 13px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; appearance: none !important; outline: none !important; cursor: pointer !important; }

    /* BENTO GRID */
    .bento-grid { display: grid !important; grid-template-columns: 4.5fr 7.5fr !important; gap: 20px !important; margin-bottom: 20px !important; }
    .stat-2x2-grid { display: grid !important; grid-template-columns: repeat(2, 1fr) !important; gap: 20px !important; height: 100% !important; }

    /* STAT CARD */
    .stat-card { background: #fff !important; border-radius: 20px !important; border: 1px solid #e8eaf0 !important; padding: 20px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; min-height: 140px !important; transition: transform 0.2s, box-shadow 0.2s !important; }
    .stat-card:hover { transform: translateY(-3px) !important; box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important; }
    .stat-top { display: flex !important; justify-content: space-between !important; align-items: flex-start !important; margin-bottom: 12px !important; }
    .stat-title { font-size: 12px !important; font-weight: 600 !important; color: var(--gray-400) !important; }

    /* TOMBOL PANAH */
    .stat-btn {
        width: 36px !important; height: 36px !important; border-radius: 50% !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
        text-decoration: none !important; transition: background 0.2s, transform 0.2s !important;
        flex-shrink: 0 !important;
    }
    .stat-btn svg { width: 16px !important; height: 16px !important; }
    .stat-btn-blue { background: #f4f5f9 !important; color: var(--navy) !important; }
    .stat-btn-gray { background: #f4f5f9 !important; color: var(--navy) !important; }
    .stat-btn:hover { background: #730f00 !important; color: #fff !important; transform: scale(1.08) !important; }

    .stat-bottom { display: flex !important; flex-direction: column !important; gap: 4px !important; }
    .stat-val { font-size: 22px !important; font-weight: 700 !important; color: var(--navy) !important; margin: 0 !important; letter-spacing: -0.02em !important; }
    .stat-note { font-size: 11px !important; color: var(--gray-400) !important; }

    /* CARD */
    .card { background: #fff !important; border-radius: 20px !important; border: 1px solid #e8eaf0 !important; display: flex !important; flex-direction: column !important; overflow: hidden !important; }
    .card-header { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 20px 24px 16px !important; }
    .card-title { font-size: 16px !important; font-weight: 700 !important; color: var(--navy) !important; margin: 0 !important; }
    .card-sub { font-size: 12px !important; color: var(--gray-400) !important; }
    .card-action-btn { width: 32px !important; height: 32px !important; border-radius: 50% !important; background: #f4f5f9 !important; color: var(--navy) !important; display: flex !important; align-items: center !important; justify-content: center !important; text-decoration: none !important; transition: background 0.2s, color 0.2s !important; flex-shrink: 0 !important; }
    .card-action-btn svg { width: 14px !important; height: 14px !important; }
    .card-action-btn:hover { background: #730f00 !important; color: #fff !important; }
    .card-body { padding: 0 24px 24px !important; flex: 1 !important; display: flex !important; flex-direction: column !important; justify-content: center !important; }

    /* BAR CHART */
    .chart-container { display: flex !important; gap: 12px !important; align-items: stretch !important; height: 200px !important; width: 100% !important; margin-top: 10px !important; }
    .chart-y-axis { display: flex !important; flex-direction: column !important; justify-content: space-between !important; padding-bottom: 24px !important; text-align: right !important; width: 45px !important; }
    .axis-val { font-size: 10px !important; color: var(--gray-400) !important; font-weight: 600 !important; }
    .chart-bars-wrapper { flex: 1 !important; position: relative !important; display: flex !important; align-items: flex-end !important; gap: 8px !important; border-bottom: 1px dashed #e8eaf0 !important; padding-bottom: 4px !important; }
    .gridline { position: absolute !important; left: 0 !important; right: 0 !important; border-top: 1px dashed #f0f1f5 !important; z-index: 1 !important; pointer-events: none !important; }
    .bar-col { flex: 1 !important; height: 100% !important; display: flex !important; flex-direction: column !important; justify-content: flex-end !important; align-items: center !important; z-index: 2 !important; }
    .bar-track { width: 100% !important; height: 100% !important; display: flex !important; align-items: flex-end !important; justify-content: center !important; }
    .bar-fill { width: 100% !important; max-width: 38px !important; border-radius: 6px 6px 0 0 !important; min-height: 4px !important; transition: height 0.8s cubic-bezier(0.25, 1, 0.5, 1) !important; position: relative !important; cursor: pointer !important; }
    .bar-fill:hover { filter: brightness(0.9) !important; }
    .bar-tooltip { display: none !important; position: absolute !important; bottom: calc(100% + 8px) !important; left: 50% !important; transform: translateX(-50%) !important; background: var(--navy) !important; color: #fff !important; font-size: 10px !important; font-weight: 600 !important; padding: 5px 9px !important; border-radius: 6px !important; white-space: nowrap !important; z-index: 20 !important; }
    .bar-fill:hover .bar-tooltip { display: block !important; }
    .bar-label { font-size: 10px !important; font-weight: 600 !important; color: var(--gray-400) !important; margin-top: 8px !important; text-transform: uppercase !important; }

    /* VENDOR TABLE */
    .vendor-table { width: 100% !important; border-collapse: collapse !important; font-size: 13px !important; }
    .vendor-table th { padding: 12px 0 !important; font-size: 11px !important; font-weight: 600 !important; color: var(--gray-400) !important; text-transform: uppercase !important; border-bottom: 1.5px solid #e8eaf0 !important; }
    .vendor-table td { padding: 13px 0 !important; color: var(--navy) !important; border-bottom: 1px dashed #f0f1f5 !important; vertical-align: middle !important; }
    .vendor-table tr:last-child td { border-bottom: none !important; }
    .status-pill { display: inline-flex !important; padding: 4px 10px !important; border-radius: 8px !important; font-size: 10px !important; font-weight: 700 !important; }
    .status-paid    { background: #e6f7ee !important; color: #16a34a !important; }
    .status-unpaid  { background: #fff7e6 !important; color: #d97706 !important; }
    .status-overdue { background: #fef2f2 !important; color: #dc2626 !important; }

    /* DONUT */
    .donut-layout { display: flex !important; align-items: center !important; justify-content: center !important; gap: 40px !important; margin-top: 10px !important; }
    .donut-svg-wrap { position: relative !important; width: 160px !important; height: 160px !important; flex-shrink: 0 !important; }
    .donut-legend { display: flex !important; flex-direction: column !important; gap: 14px !important; flex: 1 !important; }
    .legend-row { display: flex !important; align-items: center !important; justify-content: space-between !important; }
    .legend-left { display: flex !important; align-items: center !important; gap: 10px !important; }
    .legend-dot { width: 12px !important; height: 12px !important; border-radius: 50% !important; }
    .legend-lbl { color: var(--gray-400) !important; font-size: 13px !important; font-weight: 500 !important; }
    .legend-val { font-weight: 700 !important; color: var(--navy) !important; font-size: 14px !important; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection

@section('content')
<div class="dashboard-container">

    {{-- HEADER --}}
    <div class="dash-header">
        <div class="dash-welcome">
            <h1>Hello, {{ Auth::user()->name }}! 👋</h1>
            <p>Berikut adalah ringkasan performa e-kantin hari ini.</p>
        </div>
    </div>

    {{-- BENTO GRID --}}
    <div class="bento-grid">

        {{-- KIRI: 4 STAT CARDS 2x2 --}}
        <div class="stat-2x2-grid">

            {{-- Total Pembayaran → invoice --}}
            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Pembayaran</span>
                    <a href="{{ route('admin.invoice.index') }}" class="stat-btn stat-btn-blue" title="Lihat Invoice">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div class="stat-bottom">
                    <h3 class="stat-val">Rp {{ number_format($totalTagihan ?? 0, 0, ',', '.') }}</h3>
                    <span class="stat-note">Bulan ini</span>
                </div>
            </div>

            {{-- Total Penjual → vendor --}}
            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Penjual</span>
                    <a href="{{ route('admin.vendor.index') }}" class="stat-btn stat-btn-gray" title="Kelola Penjual">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div class="stat-bottom">
                    <h3 class="stat-val">{{ $totalPenjual ?? 0 }}</h3>
                    <span class="stat-note">Vendor terdaftar</span>
                </div>
            </div>

            {{-- Total Kategori → category --}}
            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Kategori</span>
                    <a href="{{ route('admin.category.index') }}" class="stat-btn stat-btn-gray" title="Kelola Kategori">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div class="stat-bottom">
                    <h3 class="stat-val">{{ $totalKategori ?? 0 }}</h3>
                    <span class="stat-note">Kategori menu</span>
                </div>
            </div>

            {{-- Total Pengguna → costumer --}}
            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Pengguna</span>
                    <a href="{{ route('admin.costumer.index') }}" class="stat-btn stat-btn-gray" title="Kelola Pengguna">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div class="stat-bottom">
                    <h3 class="stat-val">{{ $totalPengguna ?? 0 }}</h3>
                    <span class="stat-note">Customer aktif</span>
                </div>
            </div>

        </div>

        {{-- KANAN: BAR CHART --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">Pemasukan</h2>
                    <span class="card-sub">Statistik Tahun {{ now()->year }}</span>
                </div>
                <a href="{{ route('admin.invoice.index') }}" class="card-action-btn" title="Lihat Invoice">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                    </svg>
                </a>
            </div>
            <div class="card-body">
                @php
                    $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    $chartData   = array_slice($monthlyRevenue ?? array_fill(0, 12, 0), 4, 8);
                    $chartMonths = array_slice($months, 4, 8);
                    $maxRev = max($chartData) ?: 1;
                    $ySteps = [$maxRev, $maxRev * 0.66, $maxRev * 0.33, 0];
                @endphp
                <div class="chart-container">
                    <div class="chart-y-axis">
                        @foreach($ySteps as $step)
                            <span class="axis-val">{{ $step >= 1000000 ? number_format($step/1000000,1).'M' : number_format($step/1000,0).'K' }}</span>
                        @endforeach
                    </div>
                    <div class="chart-bars-wrapper">
                        <div class="gridline" style="top:0%;"></div>
                        <div class="gridline" style="top:33%;"></div>
                        <div class="gridline" style="top:66%;"></div>
                        @foreach($chartMonths as $i => $month)
                        @php $pct = ($chartData[$i] / $maxRev) * 100; @endphp
                        <div class="bar-col">
                            <div class="bar-track">
                                <div class="bar-fill" data-height="{{ max($pct, 4) }}" style="height:0%; background:#6b8afc !important;">
                                    <div class="bar-tooltip">Rp {{ number_format($chartData[$i], 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <span class="bar-label">{{ $month }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- KIRI BAWAH: VENDOR TABLE --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">Daftar Vendor & Pembayaran</h2>
                    <span class="card-sub">{{ count($vendors ?? []) }} vendor terdaftar</span>
                </div>
                <a href="{{ route('admin.vendor.index') }}" class="card-action-btn" title="Kelola Penjual">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                    </svg>
                </a>
            </div>
            <div class="card-body" style="padding-top:0 !important; overflow-y:auto; max-height:240px;">
                <table class="vendor-table">
                    <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors ?? [] as $vendor)
                        @php
                            $bill = $vendor->shop->currentBill ?? null;
                            $bs   = $bill ? $bill->status : 'unpaid';
                            if ($bs === 'unpaid' && $bill && now()->gt(\Carbon\Carbon::parse($bill->due_date))) $bs = 'overdue';
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight:600;">{{ $vendor->name }}</div>
                                <div style="font-size:11px;color:var(--gray-400);">{{ $vendor->shop->name ?? '-' }}</div>
                            </td>
                            <td style="font-weight:600;">Rp {{ number_format($bill->amount ?? 0, 0, ',', '.') }}</td>
                            <td><span class="status-pill status-{{ $bs }}">{{ strtoupper($bs) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center;padding:20px;color:var(--gray-400);">Belum ada vendor</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- KANAN BAWAH: DONUT STATUS PEMBAYARAN --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">Status Pembayaran</h2>
                    <span class="card-sub">Ringkasan semua tagihan</span>
                </div>
                <a href="{{ route('admin.invoice.index') }}" class="card-action-btn" title="Lihat Invoice">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                    </svg>
                </a>
            </div>
            <div class="card-body">
                @php
                    $pc = $paidCount ?? 0; $uc = $unpaidCount ?? 0; $oc = $overdueCount ?? 0;
                    $tot = $pc + $uc + $oc ?: 1;
                    $pPct = round(($pc/$tot)*100); $uPct = round(($uc/$tot)*100); $oPct = round(($oc/$tot)*100);
                    $r=60; $cx=80; $cy=80; $circ=2*M_PI*$r;
                    $pD=($pPct/100)*$circ; $uD=($uPct/100)*$circ; $oD=($oPct/100)*$circ;
                @endphp
                <div class="donut-layout">
                    <div class="donut-svg-wrap">
                        <svg width="160" height="160" viewBox="0 0 160 160">
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f0f1f5" stroke-width="28"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#6b8afc" stroke-width="28"
                                stroke-dasharray="{{ $pD }} {{ $circ-$pD }}" stroke-dashoffset="0" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#facc15" stroke-width="28"
                                stroke-dasharray="{{ $uD }} {{ $circ-$uD }}" stroke-dashoffset="{{ -$pD }}" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f87171" stroke-width="28"
                                stroke-dasharray="{{ $oD }} {{ $circ-$oD }}" stroke-dashoffset="{{ -$pD-$uD }}" transform="rotate(-90 {{ $cx }} {{ $cy }})"/>
                        </svg>
                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;">
                            <div style="font-weight:700;font-size:20px;color:var(--navy);">{{ $tot }}</div>
                            <div style="font-size:10px;color:var(--gray-400);">Invoice</div>
                        </div>
                    </div>
                    <div class="donut-legend">
                        <div class="legend-row">
                            <div class="legend-left"><div class="legend-dot" style="background:#6b8afc;"></div><span class="legend-lbl">Lunas</span></div>
                            <span class="legend-val">{{ $pPct }}%</span>
                        </div>
                        <div class="legend-row">
                            <div class="legend-left"><div class="legend-dot" style="background:#facc15;"></div><span class="legend-lbl">Menunggu</span></div>
                            <span class="legend-val">{{ $uPct }}%</span>
                        </div>
                        <div class="legend-row">
                            <div class="legend-left"><div class="legend-dot" style="background:#f87171;"></div><span class="legend-lbl">Overdue</span></div>
                            <span class="legend-val">{{ $oPct }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.bar-fill').forEach((bar, i) => {
        const h = bar.getAttribute('data-height');
        setTimeout(() => { bar.style.height = h + '%'; }, 100 + i * 80);
    });
});
</script>
@endsection