{{-- resources/views/admin/invoice/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Invoice Sewa - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: center !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 3px !important; }

    .btn-catat { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 18px !important; background: #16a34a !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; transition: opacity 0.15s !important; }
    .btn-catat:hover { opacity: 0.88 !important; }
    .btn-catat svg { width: 16px !important; height: 16px !important; }

    .vendor-group { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; overflow: hidden !important; margin-bottom: 24px !important; }
    .vendor-group-header { display: flex !important; align-items: center !important; gap: 14px !important; padding: 16px !important; background: #f8f9fc !important; border-bottom: 1px solid #e8eaf0 !important; }
    .vendor-logo { width: 44px !important; height: 44px !important; border-radius: 50% !important; object-fit: cover !important; border: 2px solid #e8eaf0 !important; flex-shrink: 0 !important; }
    .vendor-logo-placeholder { width: 44px !important; height: 44px !important; border-radius: 50% !important; background: #e8eeff !important; color: var(--accent) !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; font-size: 16px !important; font-weight: 600 !important; flex-shrink: 0 !important; }
    .vendor-info { display: flex !important; flex-direction: column !important; gap: 2px !important; }
    .vendor-name { font-size: 15px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .vendor-meta { font-size: 12px !important; color: var(--gray-400) !important; }

    .table { width: 100% !important; border-collapse: collapse !important; font-size: 14px !important; }
    .table thead tr { background: #f8f9fc !important; }
    .table th { padding: 12px 16px !important; text-align: left !important; font-size: 12px !important; font-weight: 600 !important; color: var(--gray-400) !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; border-bottom: 1px solid #e8eaf0 !important; white-space: nowrap !important; }
    .table th.center, .table td.center { text-align: center !important; }
    .table td { padding: 14px 16px !important; color: var(--navy) !important; border-bottom: 1px solid #f0f1f5 !important; vertical-align: middle !important; }
    .table tbody tr:last-child td { border-bottom: none !important; }
    .table tbody tr:hover { background: #fafbff !important; }
    .td-muted { color: var(--gray-400) !important; font-size: 13px !important; }
    .inv-number { font-family: monospace !important; font-size: 13px !important; background: #f4f5f9 !important; padding: 3px 8px !important; border-radius: 6px !important; color: var(--navy) !important; }

    .badge { display: inline-block !important; padding: 3px 10px !important; border-radius: 6px !important; font-size: 11px !important; font-weight: 600 !important; }
    .badge-transfer { background: #ebf8ff !important; color: #2b6cb0 !important; border: 1px solid #bee3f8 !important; }
    .badge-cash { background: #f0fff4 !important; color: #2f855a !important; border: 1px solid #c6f6d5 !important; }
    .status-pill { display: inline-block !important; padding: 4px 12px !important; border-radius: 99px !important; font-size: 11px !important; font-weight: 700 !important; }
    .status-paid    { background: #e6f7ee !important; color: #15803d !important; }
    .status-unpaid  { background: #fff7e6 !important; color: #d97706 !important; }
    .status-overdue { background: #fef2f2 !important; color: #dc2626 !important; }

    .proof-thumb { width: 36px !important; height: 36px !important; object-fit: cover !important; border-radius: 6px !important; border: 1px solid #e8eaf0 !important; cursor: zoom-in !important; transition: transform 0.15s !important; }
    .proof-thumb:hover { transform: scale(1.08) !important; }

    .btn-detail { display: inline-flex !important; align-items: center !important; gap: 5px !important; padding: 6px 12px !important; border-radius: 8px !important; font-size: 12px !important; font-weight: 500 !important; background: #e8eeff !important; color: var(--accent) !important; text-decoration: none !important; transition: opacity 0.15s !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-detail:hover { opacity: 0.85 !important; }
    .btn-detail svg { width: 13px !important; height: 13px !important; }

    .empty-state { text-align: center !important; padding: 48px !important; color: var(--gray-400) !important; }
    .empty-state svg { width: 40px !important; height: 40px !important; display: block !important; margin: 0 auto 12px !important; opacity: 0.3 !important; }

    /* PHOTO MODAL */
    .photo-modal { position: relative !important; max-width: 90vw !important; max-height: 90vh !important; }
    .photo-modal img { max-width: 100% !important; max-height: 85vh !important; border-radius: 12px !important; display: block !important; box-shadow: 0 24px 60px rgba(0,0,0,0.4) !important; }
    .photo-modal-close { position: absolute !important; top: -14px !important; right: -14px !important; width: 32px !important; height: 32px !important; border-radius: 50% !important; background: #fff !important; border: none !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 2px 8px rgba(0,0,0,0.2) !important; }
    .photo-modal-close svg { width: 16px !important; height: 16px !important; color: var(--navy) !important; }
    .photo-modal-label { text-align: center !important; color: rgba(255,255,255,0.7) !important; font-size: 13px !important; margin-top: 10px !important; }

    /* MODAL */
    .modal-header { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 20px 24px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .modal-title { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .modal-close { background: none !important; border: none !important; cursor: pointer !important; padding: 0 !important; color: var(--gray-400) !important; }
    .modal-close svg { width: 20px !important; height: 20px !important; }
    .modal-body { padding: 24px !important; }
    .modal-footer { display: flex !important; justify-content: flex-end !important; gap: 10px !important; padding: 16px 24px !important; border-top: 1px solid #f0f1f5 !important; }

    /* SUCCESS MODAL */
    .success-icon { width: 56px !important; height: 56px !important; border-radius: 50% !important; background: #e6f7ee !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 16px !important; }
    .success-icon svg { width: 28px !important; height: 28px !important; color: #16a34a !important; }
    .success-text { text-align: center !important; }
    .success-text h3 { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 6px !important; }
    .success-text p { font-size: 14px !important; color: var(--gray-400) !important; }
    .btn-ok { display: inline-flex !important; align-items: center !important; padding: 10px 28px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Invoice Sewa Vendor</h1>
        <p class="page-sub">Daftar tagihan sewa per vendor</p>
    </div>
    <button class="btn-catat" onclick="openModal('modal-create-invoice')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Catat Pembayaran
    </button>
</div>

@forelse($bills as $shopId => $shopBills)
    @php
        $shop   = $shopBills->first()->shop;
        $vendor = $shop->user;
    @endphp

    <div class="vendor-group">
        <div class="vendor-group-header">
            @if($shop->banner_path)
                <img src="{{ asset('storage/' . $shop->banner_path) }}" class="vendor-logo">
            @else
                <div class="vendor-logo-placeholder">{{ strtoupper(substr($shop->name, 0, 1)) }}</div>
            @endif
            <div class="vendor-info">
                <span class="vendor-name">{{ $shop->name }}</span>
                <span class="vendor-meta">{{ $vendor->name }} &middot; {{ $vendor->email }}</span>
                @if($vendor->phone)<span class="vendor-meta">{{ $vendor->phone }}</span>@endif
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width:15%">No. Invoice</th>
                    <th style="width:13%">Periode</th>
                    <th style="width:14%">Jatuh Tempo</th>
                    <th class="center" style="width:15%">Nominal</th>
                    <th class="center" style="width:12%">Metode</th>
                    <th class="center" style="width:11%">Bukti TF</th>
                    <th class="center" style="width:11%">Status</th>
                    <th class="center" style="width:9%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shopBills as $bill)
                @php
                    $status = $bill->status;
                    if ($status === 'unpaid' && now()->gt(\Carbon\Carbon::parse($bill->due_date))) $status = 'overdue';
                    $invoiceNumber = 'INV-' . str_pad($bill->id, 4, '0', STR_PAD_LEFT) . '-' . $bill->year;
                @endphp
                <tr>
                    <td><span class="inv-number">{{ $invoiceNumber }}</span></td>
                    <td>{{ $bill->month }} {{ $bill->year }}</td>
                    <td class="td-muted">{{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d M Y') }}</td>
                    <td class="center" style="font-weight:600;">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                    <td class="center">
                        @if(strtolower($bill->payment_method ?? '') === 'transfer')
                            <span class="badge badge-transfer">TRANSFER</span>
                        @elseif($bill->payment_method)
                            <span class="badge badge-cash">CASH</span>
                        @else
                            <span class="td-muted">-</span>
                        @endif
                    </td>
                    <td class="center">
                        @if($bill->payment_proof)
                            <img src="{{ asset('storage/' . $bill->payment_proof) }}" class="proof-thumb"
                                data-src="{{ asset('storage/' . $bill->payment_proof) }}" data-label="{{ $invoiceNumber }}"
                                onclick="openPhotoModal(this)">
                        @else
                            <span class="td-muted" style="font-size:12px;font-style:italic;">Tidak ada</span>
                        @endif
                    </td>
                    <td class="center"><span class="status-pill status-{{ $status }}">{{ strtoupper($status) }}</span></td>
                    <td class="center">
                        <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                            <a href="{{ route('admin.invoice.detail', $bill->id) }}" class="btn-detail">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                                Detail
                            </a>
                            @if($status !== 'paid')
                            @php $isTransfer = strtolower($bill->payment_method ?? '') === 'transfer'; $hasProof = !empty($bill->payment_proof); @endphp
                            @if(!$isTransfer || ($isTransfer && $hasProof))
                            <form action="{{ route('admin.invoice.confirm', $bill->id) }}" method="POST" style="margin:0;"
                                onsubmit="return confirm('Konfirmasi pembayaran {{ $invoiceNumber }}?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-detail" style="background:#e6f7ee !important;color:#15803d !important;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    Konfirmasi
                                </button>
                            </form>
                            @else
                            <span style="font-size:11px;color:#d97706;font-style:italic;">Tunggu bukti TF</span>
                            @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@empty
    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
        </svg>
        Belum ada data invoice.
    </div>
@endforelse

{{-- MODAL CATAT PEMBAYARAN --}}
@include('admin.invoice.create')

{{-- MODAL FOTO BUKTI TF --}}
<div class="modal-backdrop" id="modal-photo" onclick="closePhotoModal()">
    <div class="photo-modal" onclick="event.stopPropagation()">
        <button class="photo-modal-close" onclick="closePhotoModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <img id="photo-modal-img" src="" alt="Bukti Transfer">
        <p class="photo-modal-label" id="photo-modal-label"></p>
    </div>
</div>

{{-- MODAL SUKSES --}}
<div class="modal-backdrop" id="modal-success">
    <div class="modal">
        <div class="modal-body" style="padding: 36px 24px 24px !important;">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div class="success-text">
                <h3>Berhasil!</h3>
                <p id="success-msg"></p>
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center !important;">
            <button class="btn-ok" onclick="closeModal('modal-success')">OK</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openPhotoModal(el) {
        document.getElementById('photo-modal-img').src = el.getAttribute('data-src');
        document.getElementById('photo-modal-label').textContent = 'Bukti TF — ' + el.getAttribute('data-label');
        document.getElementById('modal-photo').classList.add('show');
    }
    function closePhotoModal() {
        document.getElementById('modal-photo').classList.remove('show');
        document.getElementById('photo-modal-img').src = '';
    }

    // Auto-fill nominal dari tagihan terakhir vendor
    function fillAmount(sel) {
        const opt = sel.options[sel.selectedIndex];
        const amount = opt.getAttribute('data-amount');
        if (amount && amount > 0) {
            document.getElementById('inv-amount').value = amount;
        } else {
            document.getElementById('inv-amount').value = '';
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePhotoModal();
    });

    @if(session('success'))
        document.getElementById('success-msg').textContent = '{{ session('success') }}';
        openModal('modal-success');
    @endif

    @if(old('_form') === 'create-invoice')
        openModal('modal-create-invoice');
    @endif
</script>
@endsection