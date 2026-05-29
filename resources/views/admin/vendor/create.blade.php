{{-- resources/views/admin/vendor/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Penjual - Kantin Admin')

@section('styles')
<style>
    .page-header {
        display: flex !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
        margin-bottom: 24px !important;
    }

    .page-title {
        font-size: 20px !important;
        font-weight: 600 !important;
        color: var(--navy) !important;
    }

    .page-sub {
        font-size: 13px !important;
        color: var(--gray-400) !important;
        margin-top: 4px !important;
    }

    .breadcrumb-link {
        color: var(--accent) !important;
        text-decoration: none !important;
    }

    .breadcrumb-link:hover {
        text-decoration: underline !important;
    }

    .btn-back {
        display: inline-flex !important;
        align-items: center !important;
        gap: 7px !important;
        padding: 9px 16px !important;
        border: 1px solid #e8eaf0 !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: var(--navy) !important;
        text-decoration: none !important;
        background: #fff !important;
    }

    .btn-back:hover {
        background: var(--gray-100) !important;
    }

    .btn-back svg {
        width: 15px !important;
        height: 15px !important;
    }

    .form-card {
        background: #fff !important;
        border-radius: 14px !important;
        border: 1px solid #e8eaf0 !important;
        padding: 28px !important;
        max-width: 620px !important;
    }

    .section-title {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--navy) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        margin-bottom: 16px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #f0f1f5 !important;
    }

    .form-group {
        margin-bottom: 18px !important;
    }

    .form-label {
        display: block !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--navy) !important;
        margin-bottom: 8px !important;
    }

    .required {
        color: #dc2626 !important;
    }

    .form-input {
        width: 100% !important;
        padding: 10px 14px !important;
        border: 1.5px solid #e8eaf0 !important;
        border-radius: 10px !important;
        font-family: var(--font) !important;
        font-size: 14px !important;
        color: var(--navy) !important;
        outline: none !important;
        background: #fff !important;
        transition: border-color 0.15s !important;
    }

    .form-input:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(61, 79, 214, 0.08) !important;
    }

    .form-input::placeholder {
        color: var(--gray-400) !important;
    }

    .form-hint {
        font-size: 12px !important;
        color: var(--gray-400) !important;
        margin-top: 5px !important;
    }

    .form-select {
        width: 100% !important;
        padding: 10px 14px !important;
        border: 1.5px solid #e8eaf0 !important;
        border-radius: 10px !important;
        font-family: var(--font) !important;
        font-size: 14px !important;
        color: var(--navy) !important;
        outline: none !important;
        background: #fff !important;
    }

    .form-section {
        background: #f8f9fc !important;
        border-radius: 12px !important;
        padding: 16px !important;
        margin-bottom: 18px !important;
    }

    .error-list {
        background: #fef2f2 !important;
        color: #dc2626 !important;
        padding: 12px 16px !important;
        border-radius: 10px !important;
        margin-bottom: 20px !important;
        font-size: 13px !important;
    }

    .error-list ul {
        padding-left: 16px !important;
    }

    .info-box {
        background: #ebf8ff !important;
        color: #2b6cb0 !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
        font-size: 12px !important;
        margin-bottom: 12px !important;
    }

    .logo-preview {
        display: none;
        margin-top: 12px !important;
        text-align: center !important;
    }

    .logo-preview img {
        width: 72px !important;
        height: 72px !important;
        object-fit: cover !important;
        border-radius: 50% !important;
        border: 2px solid #e8eaf0 !important;
    }

    .form-footer {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        gap: 10px !important;
        padding-top: 16px !important;
        border-top: 1px solid #f0f1f5 !important;
        margin-top: 8px !important;
    }

    .btn-cancel {
        display: inline-flex !important;
        align-items: center !important;
        padding: 10px 18px !important;
        border: 1px solid #e8eaf0 !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: var(--navy) !important;
        text-decoration: none !important;
        background: #fff !important;
    }

    .btn-submit {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 10px 20px !important;
        background: var(--accent) !important;
        color: #fff !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        border: none !important;
        cursor: pointer !important;
        font-family: var(--font) !important;
    }

    .btn-submit:hover {
        opacity: 0.88 !important;
    }

    .btn-submit svg {
        width: 15px !important;
        height: 15px !important;
    }

    /* CARD */
    .form-card {
        background: #fff !important;
        border-radius: 18px !important;
        border: 1px solid #e8eaf0 !important;
        padding: 26px !important;
        width: 100% !important;
        max-width: 1180px !important;
        margin: auto !important;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.06) !important;
    }

    /* GRID 2 KOLOM */
    .form-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 20px 26px !important;
        align-items: start !important;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr !important;
        }

        .form-group[style*="span 2"] {
            grid-column: span 1 !important;
        }
    }

    /* SECTION */
    .form-column {
        background: #fafbff !important;
        border: 1px solid #eef1f6 !important;
        border-radius: 16px !important;
        padding: 20px !important;
    }

    /* TITLE */
    .section-title {
        font-size: 12px !important;
        font-weight: 700 !important;
        color: var(--accent) !important;
        text-transform: uppercase !important;
        letter-spacing: .08em !important;
        margin-bottom: 18px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #e8eaf0 !important;
    }

    /* INPUT */
    .form-input,
    .form-select {
        height: 46px !important;
        border-radius: 12px !important;
        background: #fff !important;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 4px rgba(61, 79, 214, 0.10) !important;
    }

    /* FILE INPUT */
    input[type="file"].form-input {
        padding-top: 10px !important;
        height: auto !important;
    }

    /* FOOTER */
    .form-footer {
        margin-top: 24px !important;
        padding-top: 20px !important;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr !important;
        }

        .form-card {
            padding: 18px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Penjual</h1>
        <p class="page-sub">
            <a href="{{ route('admin.vendor.index') }}" class="breadcrumb-link">Kelola Penjual</a>
            &rsaquo; Tambah Baru
        </p>
    </div>
    <a href="{{ route('admin.vendor.index') }}" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12" />
            <polyline points="12 19 5 12 12 5" />
        </svg>
        Kembali
    </a>
</div>

<div class="form-card">
    @if($errors->any())
    <div class="error-list">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label">Nama Pemilik Warung <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Biaya Sewa (Rp) <span class="required">*</span></label>
                <input type="number" name="nominal_sewa" value="{{ old('nominal_sewa') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email Login <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>

                <select name="payment_method" id="payment_method" class="form-select">
                    <option value="cash">Cash (Tunai)</option>
                    <option value="transfer">Transfer Bank</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-input">
            </div>

            <div id="bukti_tf_container">
                <label class="form-label">Upload Bukti Transfer</label>

                <input type="file"
                    name="payment_proof"
                    class="form-input">

                <div class="info-box" style="margin-top:10px;">
                    <strong>Info Rekening:</strong><br>
                    BCA 1234567890 a/n Admin E-Kantin
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password <span class="required">*</span></label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Warung <span class="required">*</span></label>
                <input type="text" name="shop_name" value="{{ old('shop_name') }}" class="form-input" required>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label class="form-label">Logo Warung</label>

                <input type="file"
                    name="shop_logo"
                    accept="image/jpg,image/jpeg,image/png"
                    class="form-input"
                    onchange="previewLogo(this)">

                <div class="logo-preview" id="logo_preview">
                    <img id="logo_img" src="">
                    <p style="font-size:11px; margin-top:6px;">
                        Preview logo
                    </p>
                </div>
            </div>

        </div>
        <div class="form-footer">
            <a href="{{ route('admin.vendor.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>

                Simpan Penjual
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        document.getElementById('bukti_tf_container').style.display = this.value === 'transfer' ? 'block' : 'none';
    });

    function previewLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('logo_img').src = e.target.result;
                document.getElementById('logo_preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection