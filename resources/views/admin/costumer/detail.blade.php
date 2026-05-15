{{-- resources/views/admin/costumer/detail.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Customer - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: flex-start !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 4px !important; }
    .breadcrumb-link { color: var(--accent) !important; text-decoration: none !important; }
    .btn-back { display: inline-flex !important; align-items: center !important; gap: 7px !important; padding: 9px 16px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-back:hover { background: var(--gray-100) !important; }
    .btn-back svg { width: 15px !important; height: 15px !important; }

    .detail-card { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; overflow: hidden !important; max-width: 520px !important; }
    .detail-header { background: var(--navy) !important; padding: 32px 24px !important; text-align: center !important; }
    .detail-avatar { width: 72px !important; height: 72px !important; border-radius: 50% !important; background: rgba(255,255,255,0.15) !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; font-size: 28px !important; font-weight: 600 !important; color: #fff !important; margin-bottom: 12px !important; }
    .detail-name { color: #fff !important; font-size: 18px !important; font-weight: 600 !important; }
    .detail-email { color: rgba(255,255,255,0.65) !important; font-size: 13px !important; margin-top: 4px !important; }

    .detail-body { padding: 8px 0 !important; }
    .detail-row { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 14px 24px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .detail-row:last-child { border-bottom: none !important; }
    .detail-label { font-size: 13px !important; color: var(--gray-400) !important; }
    .detail-value { font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .id-badge { font-family: monospace !important; background: #f4f5f9 !important; padding: 3px 8px !important; border-radius: 6px !important; font-size: 12px !important; }
    .status-pill { display: inline-block !important; padding: 4px 12px !important; border-radius: 99px !important; font-size: 11px !important; font-weight: 700 !important; }
    .status-active   { background: #e6f7ee !important; color: #15803d !important; }
    .status-inactive { background: #fef2f2 !important; color: #dc2626 !important; }

    .detail-footer { display: flex !important; gap: 10px !important; padding: 16px 24px !important; border-top: 1px solid #f0f1f5 !important; }
    .btn-cancel { display: inline-flex !important; align-items: center !important; justify-content: center !important; flex: 1 !important; padding: 10px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-cancel:hover { background: var(--gray-100) !important; }
    .btn-danger { display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important; flex: 1 !important; padding: 10px !important; background: #dc2626 !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-danger:hover { opacity: 0.88 !important; }

    /* MODAL */
    .modal-body { padding: 32px 24px !important; }
    .modal-footer { display: flex !important; justify-content: center !important; gap: 10px !important; padding: 16px 24px !important; border-top: 1px solid #f0f1f5 !important; }
    .confirm-icon { width: 52px !important; height: 52px !important; border-radius: 50% !important; background: #fef2f2 !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 16px !important; }
    .confirm-icon svg { width: 26px !important; height: 26px !important; color: #dc2626 !important; }
    .confirm-text { text-align: center !important; }
    .confirm-text h3 { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 6px !important; }
    .confirm-text p { font-size: 14px !important; color: var(--gray-400) !important; line-height: 1.5 !important; }
    .btn-modal-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-modal-danger { display: inline-flex !important; align-items: center !important; padding: 10px 20px !important; background: #dc2626 !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Detail Customer</h1>
        <p class="page-sub">
            <a href="{{ route('admin.costumer.index') }}" class="breadcrumb-link">Kelola Pengguna</a>
            &rsaquo; {{ $customer->name }}
        </p>
    </div>
    <a href="{{ route('admin.costumer.index') }}" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
        Kembali
    </a>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
        <div class="detail-name">{{ $customer->name }}</div>
        <div class="detail-email">{{ $customer->email }}</div>
    </div>

    <div class="detail-body">
        <div class="detail-row">
            <span class="detail-label">ID Number</span>
            <span class="detail-value"><span class="id-badge">{{ $customer->id_number }}</span></span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Role</span>
            <span class="detail-value">{{ strtoupper($customer->role) }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Status</span>
            <span class="detail-value">
                @if($customer->status === 'active')
                    <span class="status-pill status-active">ACTIVE</span>
                @else
                    <span class="status-pill status-inactive">{{ strtoupper($customer->status) }}</span>
                @endif
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label">WhatsApp</span>
            <span class="detail-value">{{ $customer->phone ?? '-' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Bergabung</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    <div class="detail-footer">
        <a href="{{ route('admin.costumer.index') }}" class="btn-cancel">← Kembali</a>
        <button class="btn-danger" onclick="openModal('modal-delete')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 15px; height: 15px;">
                <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
            </svg>
            Hapus Customer
        </button>
    </div>
</div>

{{-- MODAL KONFIRMASI --}}
<div class="modal-backdrop" id="modal-delete">
    <div class="modal">
        <div class="modal-body">
            <div class="confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
            </div>
            <div class="confirm-text">
                <h3>Hapus Customer?</h3>
                <p>Kamu yakin ingin menghapus<br><strong>{{ $customer->name }}</strong>?<br>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-modal-cancel" onclick="closeModal('modal-delete')">Batal</button>
            <form action="{{ route('admin.costumer.destroy', $customer->id) }}" method="POST" style="margin: 0 !important;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-modal-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.modal-backdrop').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (e.target === el) closeModal(el.id);
        });
    });
</script>
@endsection