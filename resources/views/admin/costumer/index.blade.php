{{-- resources/views/admin/costumer/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengguna - Kantin Admin')

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
    .user-name { font-weight: 600 !important; color: var(--navy) !important; }
    .user-email { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 2px !important; }
    .id-badge { font-family: monospace !important; background: #f4f5f9 !important; padding: 3px 8px !important; border-radius: 6px !important; font-size: 12px !important; color: var(--gray-400) !important; }
    .wa-link { color: #16a34a !important; font-weight: 500 !important; text-decoration: none !important; font-size: 13px !important; }
    .wa-link:hover { text-decoration: underline !important; }
    .status-pill { display: inline-block !important; padding: 4px 12px !important; border-radius: 99px !important; font-size: 11px !important; font-weight: 700 !important; }
    .status-active  { background: #e6f7ee !important; color: #15803d !important; }
    .status-banned  { background: #fef2f2 !important; color: #dc2626 !important; }
    .action-group { display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; }
    .btn-action { display: inline-flex !important; align-items: center !important; gap: 5px !important; padding: 6px 12px !important; border-radius: 8px !important; font-size: 12px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; transition: opacity 0.15s !important; }
    .btn-action:hover { opacity: 0.85 !important; }
    .btn-action svg { width: 13px !important; height: 13px !important; }
    .btn-detail { background: #e8eeff !important; color: #3d4fd6 !important; }
    .btn-ban    { background: #fef2f2 !important; color: #dc2626 !important; }
    .btn-unban  { background: #e6f7ee !important; color: #15803d !important; }
    .td-empty { text-align: center !important; padding: 48px !important; color: var(--gray-400) !important; font-size: 14px !important; }
    .td-empty svg { width: 36px !important; height: 36px !important; display: block !important; margin: 0 auto 12px !important; opacity: 0.35 !important; }

    /* MODAL */
    .modal-header { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 20px 24px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .modal-title { font-size: 16px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .modal-close { background: none !important; border: none !important; cursor: pointer !important; padding: 0 !important; color: var(--gray-400) !important; }
    .modal-close svg { width: 20px !important; height: 20px !important; }
    .modal-body { padding: 24px !important; }
    .modal-footer { display: flex !important; justify-content: flex-end !important; gap: 10px !important; padding: 16px 24px !important; border-top: 1px solid #f0f1f5 !important; }

    /* DETAIL MODAL */
    .detail-header-modal { background: var(--navy) !important; padding: 24px !important; text-align: center !important; }
    .detail-avatar { width: 60px !important; height: 60px !important; border-radius: 50% !important; background: rgba(255,255,255,0.15) !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; font-size: 24px !important; font-weight: 600 !important; color: #fff !important; margin-bottom: 10px !important; }
    .detail-name { color: #fff !important; font-size: 16px !important; font-weight: 600 !important; }
    .detail-email { color: rgba(255,255,255,0.65) !important; font-size: 13px !important; margin-top: 3px !important; }
    .detail-body-modal { padding: 4px 0 !important; }
    .detail-row { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 12px 24px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .detail-row:last-child { border-bottom: none !important; }
    .detail-label { font-size: 13px !important; color: var(--gray-400) !important; }
    .detail-value { font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; }

    /* FORM */
    .form-group { margin-bottom: 16px !important; }
    .form-label { display: block !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 7px !important; }
    .required { color: #dc2626 !important; }
    .form-input { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .form-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color: var(--gray-400) !important; }
    .form-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .error-list { background: #fef2f2 !important; color: #dc2626 !important; padding: 12px 16px !important; border-radius: 10px !important; margin-bottom: 16px !important; font-size: 13px !important; }
    .error-list ul { padding-left: 16px !important; }

    /* BUTTONS */
    .btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit svg { width: 15px !important; height: 15px !important; }
    .btn-danger { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: #dc2626 !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-success { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: #16a34a !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-action-detail { display: inline-flex !important; align-items: center !important; gap: 7px !important; padding: 10px 16px !important; background: #fef2f2 !important; color: #dc2626 !important; border: 1px solid #fecaca !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-action-detail.unban { background: #e6f7ee !important; color: #15803d !important; border-color: #bbf7d0 !important; }
    .btn-ok { display: inline-flex !important; align-items: center !important; padding: 10px 28px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }

    /* CONFIRM MODAL */
    .confirm-icon { width: 52px !important; height: 52px !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 16px !important; }
    .confirm-icon.red { background: #fef2f2 !important; }
    .confirm-icon.red svg { color: #dc2626 !important; }
    .confirm-icon.green { background: #e6f7ee !important; }
    .confirm-icon.green svg { color: #16a34a !important; }
    .confirm-icon svg { width: 26px !important; height: 26px !important; }
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
        <h1 class="page-title">Kelola Pengguna</h1>
        <p class="page-sub">Daftar semua customer yang terdaftar</p>
    </div>
    <button class="btn-primary" onclick="openModal('modal-create')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Customer
    </button>
</div>

<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th class="center" style="width:50px">No</th>
                <th>ID Number</th>
                <th>Nama & Email</th>
                <th class="center">WhatsApp</th>
                <th class="center">Status</th>
                <th class="center">Bergabung</th>
                <th class="center" style="width:160px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $customer)
            <tr>
                <td class="center td-muted">{{ $index + 1 }}</td>
                <td><span class="id-badge">{{ $customer->id_number }}</span></td>
                <td>
                    <div class="user-name">{{ $customer->name }}</div>
                    <div class="user-email">{{ $customer->email }}</div>
                </td>
                <td class="center">
                    @if($customer->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer->phone) }}" target="_blank" class="wa-link">
                            {{ $customer->phone }}
                        </a>
                    @else
                        <span class="td-muted">-</span>
                    @endif
                </td>
                <td class="center">
                    @if($customer->status === 'active')
                        <span class="status-pill status-active">ACTIVE</span>
                    @else
                        <span class="status-pill status-banned">BANNED</span>
                    @endif
                </td>
                <td class="center td-muted">{{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d M Y') }}</td>
                <td class="center">
                    <div class="action-group">
                        <button class="btn-action btn-detail"
                            data-id="{{ $customer->id }}"
                            data-name="{{ $customer->name }}"
                            data-email="{{ $customer->email }}"
                            data-phone="{{ $customer->phone ?? '-' }}"
                            data-id-number="{{ $customer->id_number }}"
                            data-role="{{ strtoupper($customer->role) }}"
                            data-status="{{ $customer->status }}"
                            data-joined="{{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d F Y') }}"
                            onclick="openDetailModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="21" y2="21"/>
                            </svg>
                            Detail
                        </button>

                        @if($customer->status === 'active')
                        <button class="btn-action btn-ban"
                            data-id="{{ $customer->id }}"
                            data-name="{{ $customer->name }}"
                            data-action="ban"
                            onclick="openToggleModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                            </svg>
                            Ban
                        </button>
                        @else
                        <button class="btn-action btn-unban"
                            data-id="{{ $customer->id }}"
                            data-name="{{ $customer->name }}"
                            data-action="activate"
                            onclick="openToggleModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                            Unban
                        </button>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="td-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                    Belum ada customer terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.costumer.create')
@include('admin.costumer.detail')

{{-- MODAL KONFIRMASI BAN/UNBAN --}}
<div class="modal-backdrop" id="modal-toggle">
    <div class="modal">
        <div class="modal-body">
            <div class="confirm-icon" id="toggle-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                </svg>
            </div>
            <div class="confirm-text">
                <h3 id="toggle-title">Ban Customer?</h3>
                <p>Kamu yakin ingin <span id="toggle-action-text">mem-ban</span><br><strong id="toggle-name"></strong>?</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal('modal-toggle')">Batal</button>
            <form id="toggle-form" method="POST" style="margin: 0 !important;">
                @csrf @method('PATCH')
                <button type="submit" id="toggle-btn" class="btn-danger">Ya, Ban</button>
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
        <div class="modal-footer" style="justify-content: center !important;">
            <button class="btn-ok" onclick="closeModal('modal-success')">OK</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Buka modal detail
    function openDetailModal(btn) {
        const name   = btn.getAttribute('data-name');
        const id     = btn.getAttribute('data-id');
        const status = btn.getAttribute('data-status');

        document.getElementById('detail-avatar').textContent    = name.charAt(0).toUpperCase();
        document.getElementById('detail-name').textContent      = name;
        document.getElementById('detail-email').textContent     = btn.getAttribute('data-email');
        document.getElementById('detail-id-number').textContent = btn.getAttribute('data-id-number');
        document.getElementById('detail-role').textContent      = btn.getAttribute('data-role');
        document.getElementById('detail-joined').textContent    = btn.getAttribute('data-joined');
        document.getElementById('detail-phone').textContent     = btn.getAttribute('data-phone');

        // Status badge
        const statusEl = document.getElementById('detail-status');
        if (status === 'active') {
            statusEl.innerHTML = '<span class="status-pill status-active">ACTIVE</span>';
        } else {
            statusEl.innerHTML = '<span class="status-pill status-banned">BANNED</span>';
        }

        // Tombol ban/unban di dalam modal detail
        const toggleBtn = document.getElementById('detail-toggle-btn');
        if (status === 'active') {
            toggleBtn.className = 'btn-action-detail';
            toggleBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg> Ban Customer`;
            toggleBtn.setAttribute('data-action', 'ban');
        } else {
            toggleBtn.className = 'btn-action-detail unban';
            toggleBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Unban Customer`;
            toggleBtn.setAttribute('data-action', 'activate');
        }
        toggleBtn.setAttribute('data-id', id);
        toggleBtn.setAttribute('data-name', name);

        openModal('modal-detail');
    }

    // Buka modal toggle (ban/unban) — dari tabel atau dari detail
    function openToggleModal(btn) {
        const id     = btn.getAttribute('data-id');
        const name   = btn.getAttribute('data-name');
        const action = btn.getAttribute('data-action'); // 'ban' atau 'activate'

        document.getElementById('toggle-name').textContent = '"' + name + '"';

        if (action === 'ban') {
            document.getElementById('toggle-icon').className       = 'confirm-icon red';
            document.getElementById('toggle-icon').innerHTML       = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>`;
            document.getElementById('toggle-title').textContent    = 'Ban Customer?';
            document.getElementById('toggle-action-text').textContent = 'mem-ban';
            document.getElementById('toggle-btn').className        = 'btn-danger';
            document.getElementById('toggle-btn').textContent      = 'Ya, Ban';
            document.getElementById('toggle-form').action          = '/admin/costumer/' + id + '/ban';
        } else {
            document.getElementById('toggle-icon').className       = 'confirm-icon green';
            document.getElementById('toggle-icon').innerHTML       = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`;
            document.getElementById('toggle-title').textContent    = 'Aktifkan Customer?';
            document.getElementById('toggle-action-text').textContent = 'mengaktifkan kembali';
            document.getElementById('toggle-btn').className        = 'btn-success';
            document.getElementById('toggle-btn').textContent      = 'Ya, Aktifkan';
            document.getElementById('toggle-form').action          = '/admin/costumer/' + id + '/activate';
        }

        closeModal('modal-detail');
        openModal('modal-toggle');
    }

    // Phone only numbers
    const phoneInput = document.getElementById('create-phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    @if(session('success'))
        document.getElementById('success-msg').textContent = '{{ session('success') }}';
        openModal('modal-success');
    @endif

    @if(old('_form') === 'create')
        openModal('modal-create');
    @endif
</script>
@endsection