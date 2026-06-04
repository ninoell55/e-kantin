{{-- resources/views/admin/vendor/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Penjual - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: center !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 3px !important; }
    .btn-primary { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 18px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; transition: opacity 0.15s !important; }
    .btn-primary:hover { opacity: 0.88 !important; }
    .btn-primary svg { width: 16px !important; height: 16px !important; }
    .table-card { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; overflow: hidden !important; }
    .table { width: 100% !important; border-collapse: collapse !important; font-size: 14px !important; }
    .table thead tr { background: #f8f9fc !important; }
    .table th { padding: 13px 16px !important; text-align: left !important; font-size: 12px !important; font-weight: 600 !important; color: var(--gray-400) !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; border-bottom: 1px solid #e8eaf0 !important; }
    .table th.center, .table td.center { text-align: center !important; }
    .table td { padding: 14px 16px !important; color: var(--navy) !important; border-bottom: 1px solid #f0f1f5 !important; vertical-align: middle !important; }
    .table tbody tr:last-child td { border-bottom: none !important; }
    .table tbody tr:hover { background: #fafbff !important; }
    .td-muted { color: var(--gray-400) !important; font-size: 13px !important; }
    .vendor-name { font-weight: 600 !important; color: var(--navy) !important; }
    .vendor-shop { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 2px !important; }
    .status-pill { display: inline-block !important; padding: 4px 12px !important; border-radius: 99px !important; font-size: 11px !important; font-weight: 700 !important; }
    .status-active   { background: #e6f7ee !important; color: #15803d !important; }
    .status-inactive { background: #fef2f2 !important; color: #dc2626 !important; }
    .status-paid     { background: #e6f7ee !important; color: #15803d !important; }
    .status-unpaid   { background: #fff7e6 !important; color: #d97706 !important; }
    .status-overdue  { background: #fef2f2 !important; color: #dc2626 !important; }
    .action-group { display: flex !important; align-items: center !important; justify-content: center !important; gap: 5px !important; flex-wrap: nowrap !important; }
    .btn-action { display: inline-flex !important; align-items: center !important; gap: 4px !important; padding: 5px 10px !important; border-radius: 8px !important; font-size: 11px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; text-decoration: none !important; transition: opacity 0.15s !important; white-space: nowrap !important; }
    .btn-action:hover { opacity: 0.85 !important; }
    .btn-action svg { width: 12px !important; height: 12px !important; }
    .btn-edit     { background: #e8eeff !important; color: #3d4fd6 !important; }
    .btn-delete   { background: #fef2f2 !important; color: #dc2626 !important; }
    .btn-ban      { background: #fff7e6 !important; color: #d97706 !important; }
    .btn-activate { background: #e6f7ee !important; color: #15803d !important; }
    .td-empty { text-align: center !important; padding: 48px !important; color: var(--gray-400) !important; font-size: 14px !important; }
    .td-empty svg { width: 36px !important; height: 36px !important; display: block !important; margin: 0 auto 12px !important; opacity: 0.35 !important; }

    /* MODAL */
    .modal-header { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 20px 24px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .modal-title { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .modal-close { background: none !important; border: none !important; cursor: pointer !important; padding: 0 !important; color: var(--gray-400) !important; transition: color 0.15s !important; }
    .modal-close:hover { color: var(--navy) !important; }
    .modal-close svg { width: 20px !important; height: 20px !important; }
    .modal-body { padding: 24px !important; }
    .modal-footer { display: flex !important; justify-content: flex-end !important; gap: 10px !important; padding: 16px 24px !important; border-top: 1px solid #f0f1f5 !important; }
    .modal-section-title { font-size: 11px !important; font-weight: 700 !important; color: var(--accent) !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; margin-bottom: 14px !important; padding-bottom: 8px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .modal-form-grid { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 16px 20px !important; }

    .form-group { margin-bottom: 0 !important; }
    .form-label { display: block !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 7px !important; }
    .required { color: #dc2626 !important; }
    .form-input { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .form-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color: var(--gray-400) !important; }
    .form-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .form-select { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; }
    .info-box { background: #ebf8ff !important; color: #2b6cb0 !important; padding: 10px 14px !important; border-radius: 8px !important; font-size: 12px !important; }
    .error-list { background: #fef2f2 !important; color: #dc2626 !important; padding: 12px 16px !important; border-radius: 10px !important; margin-bottom: 16px !important; font-size: 13px !important; }
    .error-list ul { padding-left: 16px !important; }

    .btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit:hover { opacity: 0.88 !important; }
    .btn-submit svg { width: 15px !important; height: 15px !important; }
    .btn-danger { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: #dc2626 !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-ok { display: inline-flex !important; align-items: center !important; padding: 10px 28px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }

    .confirm-icon { width: 52px !important; height: 52px !important; border-radius: 50% !important; background: #fef2f2 !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 16px !important; }
    .confirm-icon svg { width: 26px !important; height: 26px !important; color: #dc2626 !important; }
    .confirm-text { text-align: center !important; }
    .confirm-text h3 { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 6px !important; }
    .confirm-text p { font-size: 14px !important; color: var(--gray-400) !important; line-height: 1.5 !important; }
    .confirm-text strong { color: var(--navy) !important; }
    .success-icon { width: 56px !important; height: 56px !important; border-radius: 50% !important; background: #e6f7ee !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 16px !important; }
    .success-icon svg { width: 28px !important; height: 28px !important; color: #16a34a !important; }
    .success-text { text-align: center !important; }
    .success-text h3 { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 6px !important; }
    .success-text p { font-size: 14px !important; color: var(--gray-400) !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Penjual</h1>
        <p class="page-sub">Daftar semua vendor yang terdaftar</p>
    </div>
    <button class="btn-primary" onclick="openModal('modal-create')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Penjual
    </button>
</div>

<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th class="center" style="width:50px">No</th>
                <th>Nama Pemilik & Warung</th>
                <th class="center">Email</th>
                <th class="center">Status Akun</th>
                <th class="center">Status Sewa</th>
                <th class="center">Sewa</th>
                <th class="center">Bergabung</th>
                <th class="center" style="width:260px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sellers as $index => $seller)
            @php
                $bill = $seller->shop->currentBill ?? null;
                $bs   = $bill ? $bill->status : 'unpaid';
                if ($bs === 'unpaid' && $bill && now()->gt(\Carbon\Carbon::parse($bill->due_date))) $bs = 'overdue';
            @endphp
            <tr>
                <td class="center td-muted">{{ $index + 1 }}</td>
                <td>
                    <div class="vendor-name">{{ $seller->name }}</div>
                    <div class="vendor-shop">{{ $seller->shop->name ?? '-' }}</div>
                </td>
                <td class="center td-muted">{{ $seller->email }}</td>
                <td class="center">
                    @if($seller->status === 'active')
                        <span class="status-pill status-active">AKTIF</span>
                    @else
                        <span class="status-pill status-inactive">NONAKTIF</span>
                    @endif
                </td>
                <td class="center">
                    <span class="status-pill status-{{ $bs }}">{{ strtoupper($bs) }}</span>
                </td>
                <td class="center td-muted">Rp {{ number_format($bill->amount ?? 0, 0, ',', '.') }}</td>
                <td class="center td-muted">{{ \Carbon\Carbon::parse($seller->created_at)->translatedFormat('d M Y') }}</td>
                <td class="center">
                    <div class="action-group">
                        {{-- EDIT --}}
                        <button class="btn-action btn-edit"
                            data-id="{{ $seller->id }}"
                            data-name="{{ $seller->name }}"
                            data-email="{{ $seller->email }}"
                            data-phone="{{ $seller->phone ?? '' }}"
                            data-shop-name="{{ $seller->shop->name ?? '' }}"
                            data-sewa="{{ $bill->amount ?? 0 }}"
                            data-payment-method="{{ $bill->payment_method ?? 'cash' }}"
                            data-logo="{{ $seller->shop && $seller->shop->banner_path ? asset($seller->shop->banner_path) : '' }}"
                            onclick="openEditModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                            </svg>
                            Edit
                        </button>

                        {{-- SUSPEND / UNSUSPEND --}}
                        @if($seller->status === 'banned')
                            <form action="{{ route('admin.vendor.unsuspend', $seller->id) }}" method="POST" style="margin:0;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-action btn-activate">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    Aktifkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.vendor.suspend', $seller->id) }}" method="POST" style="margin:0;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-action btn-ban"
                                    data-name="{{ $seller->name }}"
                                    onclick="return confirm('Nonaktifkan akun {{ addslashes($seller->name) }}?')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                                    </svg>
                                    Suspend
                                </button>
                            </form>
                        @endif

                        {{-- HAPUS --}}
                        <button class="btn-action btn-delete"
                            data-id="{{ $seller->id }}"
                            data-name="{{ $seller->name }}"
                            onclick="openDeleteModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="td-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Belum ada penjual terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.vendor.create')
@include('admin.vendor.edit')

{{-- MODAL HAPUS --}}
<div class="modal-backdrop" id="modal-delete">
    <div class="modal">
        <div class="modal-body">
            <div class="confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
            </div>
            <div class="confirm-text">
                <h3>Hapus Penjual?</h3>
                <p>Kamu yakin ingin menghapus<br><strong id="delete-name"></strong>?<br>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal('modal-delete')">Batal</button>
            <form id="delete-form" method="POST" style="margin:0 !important;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">Ya, Hapus</button>
            </form>
        </div>
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
        <div class="modal-footer"><button class="btn-ok" onclick="closeModal('modal-success')">OK</button></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openDeleteModal(btn) {
        document.getElementById('delete-name').textContent = '"' + btn.getAttribute('data-name') + '"';
        document.getElementById('delete-form').action = '/admin/vendor/' + btn.getAttribute('data-id');
        openModal('modal-delete');
    }

    function openEditModal(btn) {
        const logo = btn.getAttribute('data-logo');
        const payMethod = btn.getAttribute('data-payment-method');

        document.getElementById('edit-name').value      = btn.getAttribute('data-name');
        document.getElementById('edit-email').value     = btn.getAttribute('data-email');
        document.getElementById('edit-phone').value     = btn.getAttribute('data-phone');
        document.getElementById('edit-shop-name').value = btn.getAttribute('data-shop-name');
        document.getElementById('edit-sewa').value      = btn.getAttribute('data-sewa');
        document.getElementById('edit-vendor-form').action = '/admin/vendor/' + btn.getAttribute('data-id');

        // Payment method
        const sel = document.getElementById('edit_payment_method');
        sel.value = payMethod;
        document.getElementById('edit_bukti_tf').style.display = payMethod === 'transfer' ? 'grid' : 'none';

        // Logo
        const logoWrap = document.getElementById('edit-current-logo');
        if (logo) {
            document.getElementById('edit-logo-img').src = logo;
            logoWrap.style.display = 'flex';
        } else {
            logoWrap.style.display = 'none';
        }
        document.getElementById('edit-logo-preview').style.display = 'none';

        openModal('modal-edit');
    }

    document.getElementById('create_payment_method').addEventListener('change', function() {
        document.getElementById('create_bukti_tf').style.display = this.value === 'transfer' ? 'grid' : 'none';
    });

    document.getElementById('edit_payment_method').addEventListener('change', function() {
        document.getElementById('edit_bukti_tf').style.display = this.value === 'transfer' ? 'grid' : 'none';
    });

    function previewCreateLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('create-logo-img').src = e.target.result;
                document.getElementById('create-logo-preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewEditLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('edit-logo-new').src = e.target.result;
                document.getElementById('edit-logo-preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    @if(session('success'))
        document.getElementById('success-msg').textContent = '{{ session('success') }}';
        openModal('modal-success');
    @endif

    @if(old('_form') === 'create')
        openModal('modal-create');
    @endif

    @if(old('_form') === 'edit')
        openModal('modal-edit');
    @endif
</script>
@endsection