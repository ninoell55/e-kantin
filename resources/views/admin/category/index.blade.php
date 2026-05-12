{{-- resources/views/admin/category/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Kategori - Kantin Admin')

@section('styles')
<style>
    .page-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:24px !important; }
    .page-title { font-size:20px !important; font-weight:600 !important; color:var(--navy) !important; }
    .page-sub { font-size:13px !important; color:var(--gray-400) !important; margin-top:3px !important; }
    .btn-primary { display:inline-flex !important; align-items:center !important; gap:8px !important; padding:10px 18px !important; background:var(--accent) !important; color:#fff !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; text-decoration:none !important; border:none !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; transition:opacity 0.15s !important; }
    .btn-primary:hover { opacity:0.88 !important; }
    .btn-primary svg { width:16px !important; height:16px !important; }
    .table-card { background:#fff !important; border-radius:14px !important; border:1px solid #e8eaf0 !important; overflow:hidden !important; }
    .table { width:100% !important; border-collapse:collapse !important; font-size:14px !important; }
    .table thead tr { background:#f8f9fc !important; }
    .table th { padding:13px 16px !important; text-align:left !important; font-size:12px !important; font-weight:600 !important; color:var(--gray-400) !important; text-transform:uppercase !important; letter-spacing:0.05em !important; border-bottom:1px solid #e8eaf0 !important; }
    .table td { padding:14px 16px !important; color:var(--navy) !important; border-bottom:1px solid #f0f1f5 !important; vertical-align:middle !important; }
    .table tbody tr:last-child td { border-bottom:none !important; }
    .table tbody tr:hover { background:#fafbff !important; }
    .td-muted { color:var(--gray-400) !important; font-size:13px !important; }
    .cat-name { display:flex !important; align-items:center !important; gap:10px !important; font-weight:500 !important; }
    .cat-icon { width:32px !important; height:32px !important; border-radius:8px !important; background:#e8eeff !important; color:var(--accent) !important; font-size:13px !important; font-weight:600 !important; display:flex !important; align-items:center !important; justify-content:center !important; flex-shrink:0 !important; }
    .slug-badge { display:inline-block !important; padding:3px 10px !important; background:#f4f5f9 !important; color:var(--gray-400) !important; border-radius:6px !important; font-size:12px !important; font-family:monospace !important; }
    .action-group { display:flex !important; align-items:center !important; justify-content:center !important; gap:6px !important; }
    .btn-action { width:32px !important; height:32px !important; border-radius:8px !important; border:1px solid #e8eaf0 !important; background:transparent !important; display:flex !important; align-items:center !important; justify-content:center !important; cursor:pointer !important; text-decoration:none !important; transition:background 0.15s !important; }
    .btn-action svg { width:15px !important; height:15px !important; }
    .btn-edit { color:#3d4fd6 !important; } .btn-edit:hover { background:#e8eeff !important; border-color:#c5cdf8 !important; }
    .btn-delete { color:#dc2626 !important; } .btn-delete:hover { background:#fef2f2 !important; border-color:#fecaca !important; }
    .td-empty { text-align:center !important; padding:48px !important; color:var(--gray-400) !important; font-size:14px !important; }
    .td-empty svg { width:36px !important; height:36px !important; display:block !important; margin:0 auto 12px !important; opacity:0.35 !important; }

    /* === MODAL UMUM === */
    .modal-backdrop {
        display: none !important;
        position: fixed !important;
        inset: 0 !important;
        background: rgba(15,20,40,0.45) !important;
        z-index: 200 !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .modal-backdrop.show { display: flex !important; }
    .modal {
        background: #fff !important;
        border-radius: 16px !important;
        width: 100% !important;
        max-width: 480px !important;
        margin: 16px !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
        animation: modalIn 0.2s ease !important;
        overflow: hidden !important;
    }
    @keyframes modalIn {
        from { opacity:0; transform:translateY(-12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .modal-header {
        display:flex !important; align-items:center !important; justify-content:space-between !important;
        padding:20px 24px 16px !important; border-bottom:1px solid #f0f1f5 !important;
    }
    .modal-title { font-size:16px !important; font-weight:600 !important; color:var(--navy) !important; }
    .modal-close {
        width:30px !important; height:30px !important; border-radius:8px !important;
        border:none !important; background:#f4f5f9 !important; cursor:pointer !important;
        display:flex !important; align-items:center !important; justify-content:center !important;
        color:var(--gray-400) !important; transition:background 0.15s !important;
    }
    .modal-close:hover { background:#e8eaf0 !important; color:var(--navy) !important; }
    .modal-close svg { width:16px !important; height:16px !important; }
    .modal-body { padding:20px 24px !important; }
    .modal-footer { display:flex !important; justify-content:flex-end !important; gap:10px !important; padding:16px 24px !important; border-top:1px solid #f0f1f5 !important; }

    /* === MODAL KONFIRMASI HAPUS === */
    .confirm-icon {
        width:52px !important; height:52px !important; border-radius:50% !important;
        background:#fef2f2 !important; display:flex !important; align-items:center !important;
        justify-content:center !important; margin:0 auto 16px !important;
    }
    .confirm-icon svg { width:26px !important; height:26px !important; color:#dc2626 !important; }
    .confirm-text { text-align:center !important; }
    .confirm-text h3 { font-size:16px !important; font-weight:600 !important; color:var(--navy) !important; margin-bottom:6px !important; }
    .confirm-text p { font-size:14px !important; color:var(--gray-400) !important; line-height:1.5 !important; }
    .confirm-text strong { color:var(--navy) !important; }
    .btn-danger { display:inline-flex !important; align-items:center !important; gap:8px !important; padding:10px 20px !important; background:#dc2626 !important; color:#fff !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; border:none !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; transition:opacity 0.15s !important; }
    .btn-danger:hover { opacity:0.88 !important; }

    /* === MODAL SUKSES === */
    .success-icon {
        width:56px !important; height:56px !important; border-radius:50% !important;
        background:#e6f7ee !important; display:flex !important; align-items:center !important;
        justify-content:center !important; margin:0 auto 16px !important;
    }
    .success-icon svg { width:28px !important; height:28px !important; color:#16a34a !important; }
    .success-text { text-align:center !important; }
    .success-text h3 { font-size:16px !important; font-weight:600 !important; color:var(--navy) !important; margin-bottom:6px !important; }
    .success-text p { font-size:14px !important; color:var(--gray-400) !important; }
    .btn-ok { display:inline-flex !important; align-items:center !important; padding:10px 28px !important; background:var(--accent) !important; color:#fff !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; border:none !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; transition:opacity 0.15s !important; }
    .btn-ok:hover { opacity:0.88 !important; }

    /* === FORM STYLES === */
    .form-group { margin-bottom:18px !important; }
    .form-label { display:flex !important; align-items:center !important; gap:6px !important; font-size:13px !important; font-weight:600 !important; color:var(--navy) !important; margin-bottom:8px !important; }
    .required { color:#dc2626 !important; }
    .badge-auto { font-size:11px !important; font-weight:500 !important; padding:2px 8px !important; background:#e8eeff !important; color:var(--accent) !important; border-radius:99px !important; }
    .form-input { width:100% !important; padding:10px 14px !important; border:1.5px solid #e8eaf0 !important; border-radius:10px !important; font-family:'Poppins',sans-serif !important; font-size:14px !important; color:var(--navy) !important; outline:none !important; background:#fff !important; transition:border-color 0.15s !important; }
    .form-input:focus { border-color:var(--accent) !important; box-shadow:0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color:var(--gray-400) !important; }
    .form-input:disabled { background:#f8f9fc !important; color:var(--gray-400) !important; }
    .input-prefix-wrap { position:relative !important; display:flex !important; align-items:center !important; }
    .input-prefix { position:absolute !important; left:14px !important; font-size:13px !important; color:var(--gray-400) !important; pointer-events:none !important; }
    .input-with-prefix { padding-left:90px !important; background:#f8f9fc !important; color:var(--gray-400) !important; }
    .error-msg { display:block !important; font-size:12px !important; color:#dc2626 !important; margin-top:5px !important; }
    .form-hint { font-size:12px !important; color:var(--gray-400) !important; margin-top:5px !important; }
    .btn-cancel { display:inline-flex !important; align-items:center !important; padding:10px 18px !important; border:1px solid #e8eaf0 !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; color:var(--navy) !important; text-decoration:none !important; background:#fff !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; }
    .btn-cancel:hover { background:var(--gray-100) !important; }
    .btn-submit { display:inline-flex !important; align-items:center !important; gap:8px !important; padding:10px 20px !important; background:var(--accent) !important; color:#fff !important; border-radius:10px !important; font-size:14px !important; font-weight:500 !important; border:none !important; cursor:pointer !important; font-family:'Poppins',sans-serif !important; transition:opacity 0.15s !important; }
    .btn-submit:hover { opacity:0.88 !important; }
    .btn-submit svg { width:15px !important; height:15px !important; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Kategori</h1>
        <p class="page-sub">Daftar semua kategori menu kantin</p>
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
                <th style="width:50px">No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Dibuat</th>
                <th style="width:120px; text-align:center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $i => $category)
            <tr>
                <td class="td-muted">{{ $i + 1 }}</td>
                <td>
                    <div class="cat-name">
                        <div class="cat-icon">{{ strtoupper(substr($category->name, 0, 1)) }}</div>
                        {{ $category->name }}
                    </div>
                </td>
                <td><span class="slug-badge">{{ $category->slug }}</span></td>
                <td class="td-muted">{{ $category->created_at->format('d M Y') }}</td>
                <td>
                    <div class="action-group">
                        <button class="btn-action btn-edit" title="Edit"
                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->slug }}')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                        <button class="btn-action btn-delete" title="Hapus"
                            onclick="openDeleteModal({{ $category->id }}, '{{ addslashes($category->name) }}')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                <path d="M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="td-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="3" width="20" height="16" rx="2"/>
                        <path d="M4 6h16M4 10h16M4 14h8"/>
                    </svg>
                    Belum ada kategori. Tambahkan yang pertama!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- MODAL TAMBAH --}}
@include('admin.category.create')

{{-- MODAL EDIT --}}
@include('admin.category.edit')

{{-- MODAL KONFIRMASI HAPUS --}}
<div class="modal-backdrop" id="modal-delete">
    <div class="modal">
        <div class="modal-body" style="padding:32px 24px !important;">
            <div class="confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
            </div>
            <div class="confirm-text">
                <h3>Hapus Kategori?</h3>
                <p>Kamu yakin ingin menghapus kategori<br><strong id="delete-name"></strong>?<br>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center !important;">
            <button class="btn-cancel" onclick="closeModal('modal-delete')">Batal</button>
            <form id="delete-form" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    </svg>
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- MODAL SUKSES --}}
<div class="modal-backdrop" id="modal-success">
    <div class="modal">
        <div class="modal-body" style="padding:36px 24px 24px !important;">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div class="success-text">
                <h3 id="success-title">Berhasil!</h3>
                <p id="success-msg"></p>
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center !important; padding-top:8px !important;">
            <button class="btn-ok" onclick="closeModal('modal-success')">OK</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    // Tutup modal klik backdrop
    document.querySelectorAll('.modal-backdrop').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (e.target === el) closeModal(el.id);
        });
    });

    // Buka modal edit + isi data
    function openEditModal(id, name, slug) {
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-slug').value = slug;
        document.getElementById('edit-form').action = '/admin/category/' + id;
        openModal('modal-edit');
    }

    // Buka modal konfirmasi hapus
    function openDeleteModal(id, name) {
        document.getElementById('delete-name').textContent = '"' + name + '"';
        document.getElementById('delete-form').action = '/admin/category/' + id;
        openModal('modal-delete');
    }

    // Slug auto-generate
    function generateSlug(value) {
        document.getElementById('slug').value = value
            .toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    // Tampilkan modal sukses jika ada session success
    @if(session('success'))
        document.getElementById('success-msg').textContent = '{{ session('success') }}';
        openModal('modal-success');
    @endif

    // Buka modal create jika ada error validasi create
    @if($errors->any() && old('_form') === 'create')
        openModal('modal-create');
    @endif

    // Buka modal edit jika ada error validasi edit
    @if($errors->any() && old('_form') === 'edit')
        openModal('modal-edit');
    @endif
</script>
@endsection