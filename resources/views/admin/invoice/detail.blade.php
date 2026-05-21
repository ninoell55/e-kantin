{{-- resources/views/admin/invoice/detail.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Invoice - Kantin Admin')

@section('styles')
<style>
    .page-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:24px !important; }
    .page-title { font-size:20px !important; font-weight:600 !important; color:var(--navy) !important; }
    .page-sub { font-size:13px !important; color:var(--gray-400) !important; margin-top:3px !important; }
    .btn-back { display:inline-flex !important; align-items:center !important; gap:7px !important; padding:9px 16px !important; border:1px solid #e8eaf0 !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; color:var(--navy) !important; text-decoration:none !important; background:#fff !important; transition:background 0.15s !important; }
    .btn-back:hover { background:var(--gray-100) !important; }
    .btn-back svg { width:15px !important; height:15px !important; }
    .btn-print { display:inline-flex !important; align-items:center !important; gap:7px !important; padding:9px 16px !important; background:var(--navy) !important; color:#fff !important; border:none !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; transition:opacity 0.15s !important; }
    .btn-print:hover { opacity:0.88 !important; }
    .btn-print svg { width:15px !important; height:15px !important; }
    .btn-group { display:flex !important; gap:10px !important; }

    /* INVOICE CARD */
    .invoice-card { background:#fff !important; border-radius:14px !important; border:1px solid #e8eaf0 !important; overflow:hidden !important; max-width:760px !important; }

    /* HEADER */
    .invoice-header { background:var(--navy) !important; padding:28px !important; display:flex !important; justify-content:space-between !important; align-items:flex-start !important; }
    .invoice-brand-name { font-size:20px !important; font-weight:600 !important; color:#fff !important; margin-bottom:4px !important; }
    .invoice-brand-sub { font-size:12px !important; color:rgba(255,255,255,0.5) !important; }
    .invoice-meta { text-align:right !important; }
    .invoice-number { font-size:16px !important; font-weight:600 !important; color:#fff !important; font-family:monospace !important; margin-bottom:6px !important; }
    .invoice-date { font-size:12px !important; color:rgba(255,255,255,0.55) !important; }

    /* STATUS BAR */
    .invoice-status-bar { padding:12px 28px !important; font-size:13px !important; font-weight:600 !important; display:flex !important; align-items:center !important; gap:8px !important; }
    .invoice-status-bar svg { width:16px !important; height:16px !important; flex-shrink:0 !important; }
    .status-bar-paid    { background:#e6f7ee !important; color:#15803d !important; border-bottom:1px solid #bbf7d0 !important; }
    .status-bar-unpaid  { background:#fff7e6 !important; color:#d97706 !important; border-bottom:1px solid #fde68a !important; }
    .status-bar-overdue { background:#fef2f2 !important; color:#dc2626 !important; border-bottom:1px solid #fecaca !important; }

    /* BODY */
    .invoice-body { padding:28px !important; }

    /* PARTIES */
    .invoice-parties { display:grid !important; grid-template-columns:1fr 1fr !important; gap:24px !important; margin-bottom:28px !important; padding-bottom:24px !important; border-bottom:1px solid #f0f1f5 !important; }
    .party-label { font-size:11px !important; font-weight:600 !important; color:var(--gray-400) !important; text-transform:uppercase !important; letter-spacing:0.08em !important; margin-bottom:8px !important; }
    .party-name { font-size:15px !important; font-weight:600 !important; color:var(--navy) !important; margin-bottom:4px !important; }
    .party-sub { font-size:13px !important; color:var(--gray-400) !important; margin-top:3px !important; }

    /* TABLE */
    .invoice-table { width:100% !important; border-collapse:collapse !important; margin-bottom:16px !important; }
    .invoice-table thead tr { background:#f8f9fc !important; }
    .invoice-table th { padding:11px 16px !important; text-align:left !important; font-size:12px !important; font-weight:600 !important; color:var(--gray-400) !important; text-transform:uppercase !important; letter-spacing:0.05em !important; border-bottom:1px solid #e8eaf0 !important; }
    .invoice-table td { padding:14px 16px !important; color:var(--navy) !important; border-bottom:1px solid #f0f1f5 !important; font-size:14px !important; }
    .invoice-table tbody tr:last-child td { border-bottom:none !important; }

    /* TOTAL */
    .invoice-total { background:#f8f9fc !important; border-radius:10px !important; padding:16px 20px !important; display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:28px !important; border:1px solid #e8eaf0 !important; }
    .invoice-total-label { font-size:13px !important; color:var(--gray-400) !important; font-weight:500 !important; }
    .invoice-total-value { font-size:22px !important; font-weight:600 !important; color:var(--navy) !important; }

    /* PAYMENT INFO */
    .section-label { font-size:11px !important; font-weight:600 !important; color:var(--gray-400) !important; text-transform:uppercase !important; letter-spacing:0.08em !important; margin-bottom:14px !important; }
    .payment-grid { display:grid !important; grid-template-columns:1fr 1fr !important; gap:12px !important; margin-bottom:28px !important; }
    .payment-box { background:#f8f9fc !important; border-radius:10px !important; padding:14px 16px !important; border:1px solid #e8eaf0 !important; }
    .payment-box-label { font-size:11px !important; color:var(--gray-400) !important; text-transform:uppercase !important; letter-spacing:0.06em !important; margin-bottom:6px !important; }
    .payment-box-value { font-size:14px !important; font-weight:600 !important; color:var(--navy) !important; }

    /* BUKTI TF */
    .proof-section { margin-bottom:24px !important; }
    .proof-img { width:120px !important; height:120px !important; object-fit:cover !important; border-radius:10px !important; border:1px solid #e8eaf0 !important; cursor:zoom-in !important; transition:transform 0.15s !important; }
    .proof-img:hover { transform:scale(1.04) !important; }

    /* FOOTER */
    .invoice-footer { border-top:1px solid #f0f1f5 !important; padding:16px 28px !important; display:flex !important; justify-content:space-between !important; font-size:12px !important; color:var(--gray-400) !important; }

    /* PHOTO OVERLAY */
    .photo-overlay { display:none; position:fixed !important; inset:0 !important; background:rgba(10,15,35,0.8) !important; z-index:999 !important; align-items:center !important; justify-content:center !important; }
    .photo-overlay.show { display:flex !important; }
    .photo-box { position:relative !important; max-width:90vw !important; max-height:90vh !important; }
    .photo-box img { max-width:100% !important; max-height:85vh !important; border-radius:12px !important; display:block !important; box-shadow:0 24px 60px rgba(0,0,0,0.5) !important; }
    .photo-box-close { position:absolute !important; top:-14px !important; right:-14px !important; width:32px !important; height:32px !important; border-radius:50% !important; background:#fff !important; border:none !important; cursor:pointer !important; display:flex !important; align-items:center !important; justify-content:center !important; box-shadow:0 2px 8px rgba(0,0,0,0.25) !important; }
    .photo-box-close svg { width:16px !important; height:16px !important; }
    .photo-box-label { text-align:center !important; color:rgba(255,255,255,0.65) !important; font-size:13px !important; margin-top:10px !important; }

    @media print {
        .page-header { display:none !important; }
        .invoice-card { border:none !important; border-radius:0 !important; }
    }
</style>
@endsection

@section('content')

@php
    $status = $bill->status;
    if ($status === 'unpaid' && now()->gt(\Carbon\Carbon::parse($bill->due_date))) {
        $status = 'overdue';
    }
    $invoiceNumber = 'INV-' . str_pad($bill->id, 4, '0', STR_PAD_LEFT) . '-' . $bill->year;
@endphp

<div class="page-header">
    <div>
        <h1 class="page-title">Detail Invoice</h1>
        <p class="page-sub">{{ $invoiceNumber }} &middot; {{ $bill->shop->name }}</p>
    </div>
    <div class="btn-group">
        <a href="{{ route('admin.invoice.index') }}" class="btn-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
            </svg>
            Kembali
        </a>
        <button class="btn-print" onclick="window.print()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 6 2 18 2 18 9"/>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                <rect x="6" y="14" width="12" height="8"/>
            </svg>
            Print Invoice
        </button>
    </div>
</div>

<div class="invoice-card">

    {{-- HEADER --}}
    <div class="invoice-header">
        <div>
            <div class="invoice-brand-name">E-Kantin</div>
            <div class="invoice-brand-sub">Portal Administrasi Kantin</div>
        </div>
        <div class="invoice-meta">
            <div class="invoice-number">{{ $invoiceNumber }}</div>
            <div class="invoice-date">Diterbitkan: {{ now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    {{-- STATUS BAR --}}
    <div class="invoice-status-bar status-bar-{{ $status }}">
        @if($status === 'paid')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            Lunas — dibayar pada {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d F Y') : '-' }}
        @elseif($status === 'overdue')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            Jatuh Tempo — belum dibayar sejak {{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d F Y') }}
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            Belum Dibayar — jatuh tempo {{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d F Y') }}
        @endif
    </div>

    <div class="invoice-body">

        {{-- DARI & KEPADA --}}
        <div class="invoice-parties">
            <div>
                <div class="party-label">Dari</div>
                <div class="party-name">Admin E-Kantin</div>
                <div class="party-sub">Portal Administrasi</div>
            </div>
            <div>
                <div class="party-label">Kepada</div>
                <div class="party-name">{{ $bill->shop->user->name }}</div>
                <div class="party-sub">{{ $bill->shop->name }}</div>
                <div class="party-sub">{{ $bill->shop->user->email }}</div>
                @if($bill->shop->user->phone)
                    <div class="party-sub">{{ $bill->shop->user->phone }}</div>
                @endif
            </div>
        </div>

        {{-- RINCIAN --}}
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Periode</th>
                    <th>Jatuh Tempo</th>
                    <th style="text-align:right !important;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sewa Tempat Kantin</td>
                    <td>{{ $bill->month }} {{ $bill->year }}</td>
                    <td style="color:var(--gray-400) !important;">{{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d M Y') }}</td>
                    <td style="text-align:right !important; font-weight:600 !important;">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        {{-- TOTAL --}}
        <div class="invoice-total">
            <span class="invoice-total-label">Total Tagihan</span>
            <span class="invoice-total-value">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
        </div>

        {{-- INFO PEMBAYARAN --}}
        <p class="section-label">Informasi Pembayaran</p>
        <div class="payment-grid">
            <div class="payment-box">
                <div class="payment-box-label">Metode</div>
                <div class="payment-box-value">{{ strtoupper($bill->payment_method ?? '-') }}</div>
            </div>
            <div class="payment-box">
                <div class="payment-box-label">Status</div>
                <div class="payment-box-value">{{ strtoupper($status) }}</div>
            </div>
            <div class="payment-box">
                <div class="payment-box-label">Tanggal Bayar</div>
                <div class="payment-box-value">
                    {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d M Y') : '-' }}
                </div>
            </div>
            <div class="payment-box">
                <div class="payment-box-label">No. Invoice</div>
                <div class="payment-box-value" style="font-family:monospace !important;">{{ $invoiceNumber }}</div>
            </div>
        </div>

        {{-- BUKTI TF --}}
        @if($bill->payment_proof)
        <div class="proof-section">
            <p class="section-label">Bukti Transfer</p>
            <img src="{{ asset($bill->payment_proof) }}"
                 class="proof-img"
                 data-src="{{ asset($bill->payment_proof) }}"
                 onclick="openPhotoOverlay(this)"
                 alt="Bukti Transfer">
        </div>
        @endif

    </div>

    {{-- FOOTER --}}
    <div class="invoice-footer">
        <span>Terima kasih telah bergabung bersama E-Kantin.</span>
        <span>{{ now()->translatedFormat('d F Y') }}</span>
    </div>

</div>

{{-- PHOTO OVERLAY --}}
<div class="photo-overlay" id="photo-overlay" onclick="closePhotoOverlay()">
    <div class="photo-box" onclick="event.stopPropagation()">
        <button class="photo-box-close" onclick="closePhotoOverlay()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <img id="photo-overlay-img" src="" alt="Bukti Transfer">
        <p class="photo-box-label">Bukti Transfer — {{ $invoiceNumber }}</p>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openPhotoOverlay(el) {
        document.getElementById('photo-overlay-img').src = el.getAttribute('data-src');
        document.getElementById('photo-overlay').classList.add('show');
    }
    function closePhotoOverlay() {
        document.getElementById('photo-overlay').classList.remove('show');
        document.getElementById('photo-overlay-img').src = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePhotoOverlay();
    });
</script>
@endsection