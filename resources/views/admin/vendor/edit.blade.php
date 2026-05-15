{{-- resources/views/admin/vendor/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Penjual - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: flex-start !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 4px !important; }
    .breadcrumb-link { color: var(--accent) !important; text-decoration: none !important; }
    .btn-back { display: inline-flex !important; align-items: center !important; gap: 7px !important; padding: 9px 16px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-back:hover { background: var(--gray-100) !important; }
    .btn-back svg { width: 15px !important; height: 15px !important; }
    .form-card { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; padding: 28px !important; max-width: 620px !important; }
    .section-title { font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; text-transform: uppercase !important; letter-spacing: 0.06em !important; margin-bottom: 16px !important; padding-bottom: 10px !important; border-bottom: 1px solid #f0f1f5 !important; }
    .form-group { margin-bottom: 18px !important; }
    .form-label { display: block !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 8px !important; }
    .required { color: #dc2626 !important; }
    .form-input { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .form-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color: var(--gray-400) !important; }
    .form-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .form-select { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; }
    .form-section { background: #f8f9fc !important; border-radius: 12px !important; padding: 16px !important; margin-bottom: 18px !important; }
    .error-list { background: #fef2f2 !important; color: #dc2626 !important; padding: 12px 16px !important; border-radius: 10px !important; margin-bottom: 20px !important; font-size: 13px !important; }
    .error-list ul { padding-left: 16px !important; }
    .info-box { background: #ebf8ff !important; color: #2b6cb0 !important; padding: 10px 14px !important; border-radius: 8px !important; font-size: 12px !important; margin-bottom: 12px !important; }
    .current-img { display: flex !important; align-items: center !important; gap: 10px !important; margin-bottom: 10px !important; }
    .current-img img { width: 52px !important; height: 52px !important; object-fit: cover !important; border-radius: 50% !important; border: 2px solid #e8eaf0 !important; }
    .current-img-label { font-size: 11px !important; color: var(--gray-400) !important; }
    .logo-preview { display: none; margin-top: 12px !important; text-align: center !important; }
    .logo-preview img { width: 60px !important; height: 60px !important; object-fit: cover !important; border-radius: 50% !important; border: 2px solid #16a34a !important; }
    .form-footer { display: flex !important; align-items: center !important; justify-content: flex-end !important; gap: 10px !important; padding-top: 16px !important; border-top: 1px solid #f0f1f5 !important; margin-top: 8px !important; }
    .btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit:hover { opacity: 0.88 !important; }
    .btn-submit svg { width: 15px !important; height: 15px !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Penjual</h1>
        <p class="page-sub">
            <a href="{{ route('admin.vendor.index') }}" class="breadcrumb-link">Kelola Penjual</a>
            &rsaquo; Edit "{{ $vendor->name }}"
        </p>
    </div>
    <a href="{{ route('admin.vendor.index') }}" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
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

    <form action="{{ route('admin.vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <p class="section-title">Informasi Pemilik</p>
        <div class="form-group">
            <label class="form-label">Nama Pemilik Warung <span class="required">*</span></label>
            <input type="text" name="name" value="{{ old('name', $vendor->name) }}" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label">Email Login <span class="required">*</span></label>
            <input type="email" name="email" value="{{ old('email', $vendor->email) }}" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nomor WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}" class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-input">
            <p class="form-hint">Kosongkan jika tidak ingin mengubah password.</p>
        </div>

        <p class="section-title" style="margin-top: 24px !important;">Informasi Warung</p>
        <div class="form-group">
            <label class="form-label">Nama Warung <span class="required">*</span></label>
            <input type="text" name="shop_name" value="{{ old('shop_name', $vendor->shop->name ?? '') }}" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label">Logo Warung</label>
            @if($vendor->shop && $vendor->shop->banner_path)
            <div class="current-img">
                <img src="{{ asset($vendor->shop->banner_path) }}">
                <span class="current-img-label">Logo saat ini</span>
            </div>
            @endif
            <input type="file" name="shop_logo" accept="image/jpg,image/jpeg,image/png"
                class="form-input" style="padding: 8px 14px !important;" onchange="previewLogo(this)">
            <div class="logo-preview" id="logo_preview">
                <img id="logo_img" src="">
                <p style="font-size: 11px; color: #16a34a; margin-top: 6px;">Preview logo baru</p>
            </div>
            <p class="form-hint">Kosongkan jika tidak ingin mengubah. Format JPG/PNG, maks. 2MB.</p>
        </div>

        <p class="section-title" style="margin-top: 24px !important;">Pembayaran Sewa</p>
        <div class="form-group">
            <label class="form-label">Biaya Sewa (Rp) <span class="required">*</span></label>
            <input type="number" name="nominal_sewa" value="{{ old('nominal_sewa', $vendor->shop->currentBill->amount ?? 0) }}" class="form-input" required>
        </div>
        <div class="form-section">
            <div class="form-group" style="margin-bottom: 12px !important;">
                <label class="form-label">Metode Pembayaran <span class="required">*</span></label>
                <select name="payment_method" id="payment_method" class="form-select">
                    <option value="cash" {{ ($vendor->shop->currentBill->payment_method ?? '') == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                    <option value="transfer" {{ ($vendor->shop->currentBill->payment_method ?? '') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                </select>
            </div>
            <div id="bukti_tf_container" style="display: {{ ($vendor->shop->currentBill->payment_method ?? '') == 'transfer' ? 'block' : 'none' }};">
                <div class="info-box"><strong>Info Rekening:</strong> BCA 1234567890 a/n Admin E-Kantin</div>
                @if($vendor->shop && $vendor->shop->currentBill && $vendor->shop->currentBill->payment_proof)
                <div class="current-img" style="margin-bottom: 10px !important;">
                    <a href="{{ asset($vendor->shop->currentBill->payment_proof) }}" target="_blank">
                        <img src="{{ asset($vendor->shop->currentBill->payment_proof) }}" style="border-radius: 8px !important;">
                    </a>
                    <span class="current-img-label">Bukti saat ini</span>
                </div>
                @endif
                <label class="form-label">Upload Bukti Transfer Baru</label>
                <input type="file" name="payment_proof" class="form-input" style="padding: 8px 14px !important;">
                <p class="form-hint">Kosongkan jika tidak ingin mengubah bukti transfer.</p>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.vendor.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan Perubahan
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