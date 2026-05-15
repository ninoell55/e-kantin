{{-- resources/views/admin/category/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Kategori - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: center !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 3px !important; }
    .btn-primary { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 18px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; text-decoration: none !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; transition: opacity 0.15s !important; }
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
    .cat-badge { display: inline-block !important; padding: 4px 12px !important; border-radius: 99px !important; font-size: 12px !important; font-weight: 600 !important; }
    .cat-badge-default { background: #e8eeff !important; color: #3d4fd6 !important; }
    .id-badge { font-family: monospace !important; background: #f4f5f9 !important; padding: 3px 8px !important; border-radius: 6px !important; font-size: 12px !important; color: var(--gray-400) !important; }
    .action-group { display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; }
    .btn-action { display: inline-flex !important; align-items: center !important; gap: 5px !important; padding: 6px 12px !important; border-radius: 8px !important; font-size: 12px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; text-decoration: none !important; transition: opacity 0.15s !important; }
    .btn-action:hover { opacity: 0.85 !important; }
    .btn-action svg { width: 13px !important; height: 13px !important; }
    .btn-edit { background: #e8eeff !important; color: #3d4fd6 !important; }
    .btn-delete { background: #fef2f2 !important; color: #dc2626 !important; }
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

    .form-group { margin-bottom: 20px !important; }
    .form-label { display: block !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 8px !important; }
    .required { color: #dc2626 !important; }
    .badge-auto { display: inline-block !important; margin-left: 6px !important; padding: 2px 8px !important; background: #e6f7ee !important; color: #16a34a !important; font-size: 10px !important; border-radius: 4px !important; font-weight: 600 !important; }
    .form-input { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .form-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color: var(--gray-400) !important; }
    .input-prefix-wrap { position: relative !important; }
    .input-prefix { position: absolute !important; left: 14px !important; top: 50% !important; transform: translateY(-50%) !important; font-size: 13px !important; color: var(--gray-400) !important; pointer-events: none !important; }
    .input-with-prefix { padding-left: 80px !important; }
    .form-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .input-error { border-color: #dc2626 !important; background: #fef2f2 !important; }
    .error-msg { display: block !important; font-size: 12px !important; color: #dc2626 !important; margin-top: 4px !important; }

    .btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-cancel:hover { background: var(--gray-100) !important; }
    .btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit:hover { opacity: 0.88 !important; }
    .btn-submit svg { width: 15px !important; height: 15px !important; }

    /* MODAL SUCCESS & DELETE */
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
    .btn-ok { display: inline-flex !important; align-items: center !important; padding: 10px 28px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-danger { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: #dc2626 !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Kategori</h1>
        <p class="page-sub">Daftar semua kategori menu yang tersedia</p>
    </div>
    <button class="btn-primary" onclick="openModal('modal-create')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Kategori
    </button>
</div>

<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th class="center" style="width:50px">No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th class="center">Dibuat</th>
                <th class="center" style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr>
                <td class="center td-muted">{{ $index + 1 }}</td>
                <td>
                    <span class="cat-badge cat-badge-default">
                        {{ strtoupper(substr($category->name, 0, 1)) }}
                    </span>
                    {{ $category->name }}
                </td>
                <td><span class="id-badge">{{ $category->slug }}</span></td>
                <td class="center td-muted">{{ \Carbon\Carbon::parse($category->created_at)->translatedFormat('d M Y') }}</td>
                <td class="center">
                    <div class="action-group">
                        <button class="btn-action btn-edit"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            data-slug="{{ $category->slug }}"
                            onclick="openEditModal(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                            </svg>
                            Edit
                        </button>
                        <button class="btn-action btn-delete"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
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
                <td colspan="5" class="td-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>
                    </svg>
                    Belum ada kategori. Silahkan tambahkan kategori baru.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.category.create')
@include('admin.category.edit')

{{-- MODAL KONFIRMASI HAPUS --}}
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
                <h3>Hapus Kategori?</h3>
                <p>Kamu yakin ingin menghapus<br><strong id="delete-name"></strong>?<br>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal('modal-delete')">Batal</button>
            <form id="delete-form" method="POST" style="margin: 0 !important;">
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
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
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
        document.getElementById('delete-form').action = '/admin/category/' + btn.getAttribute('data-id');
        openModal('modal-delete');
    }

    function openEditModal(btn) {
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');
        const slug = btn.getAttribute('data-slug');
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-slug').value = slug;
        document.getElementById('edit-form').action = '/admin/category/' + id;
        openModal('modal-edit');
    }

    function generateSlug(text) {
        const slug = text
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]/g, '');
        document.getElementById('slug').value = slug;
    }

    @if(session('success'))
        document.getElementById('success-msg').textContent = '{{ session('success') }}';
        openModal('modal-success');
    @endif
</script>
@endsection