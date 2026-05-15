{{-- resources/views/admin/costumer/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Customer - Kantin Admin')

@section('styles')
<style>
    .page-header { display: flex !important; justify-content: space-between !important; align-items: flex-start !important; margin-bottom: 24px !important; }
    .page-title { font-size: 20px !important; font-weight: 600 !important; color: var(--navy) !important; }
    .page-sub { font-size: 13px !important; color: var(--gray-400) !important; margin-top: 4px !important; }
    .breadcrumb-link { color: var(--accent) !important; text-decoration: none !important; }
    .breadcrumb-link:hover { text-decoration: underline !important; }
    .btn-back { display: inline-flex !important; align-items: center !important; gap: 7px !important; padding: 9px 16px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-back:hover { background: var(--gray-100) !important; }
    .btn-back svg { width: 15px !important; height: 15px !important; }
    .form-card { background: #fff !important; border-radius: 14px !important; border: 1px solid #e8eaf0 !important; padding: 28px !important; max-width: 560px !important; }
    .form-group { margin-bottom: 20px !important; }
    .form-label { display: block !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 8px !important; }
    .required { color: #dc2626 !important; }
    .form-input { width: 100% !important; padding: 10px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .form-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .form-input::placeholder { color: var(--gray-400) !important; }
    .form-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .error-list { background: #fef2f2 !important; color: #dc2626 !important; padding: 12px 16px !important; border-radius: 10px !important; margin-bottom: 20px !important; font-size: 13px !important; }
    .error-list ul { padding-left: 16px !important; }
    .form-footer { display: flex !important; align-items: center !important; justify-content: flex-end !important; gap: 10px !important; padding-top: 16px !important; border-top: 1px solid #f0f1f5 !important; margin-top: 4px !important; }
    .btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; text-decoration: none !important; background: #fff !important; }
    .btn-cancel:hover { background: var(--gray-100) !important; }
    .btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: var(--accent) !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .btn-submit:hover { opacity: 0.88 !important; }
    .btn-submit svg { width: 15px !important; height: 15px !important; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Customer</h1>
        <p class="page-sub">
            <a href="{{ route('admin.costumer.index') }}" class="breadcrumb-link">Kelola Pengguna</a>
            &rsaquo; Tambah Baru
        </p>
    </div>
    <a href="{{ route('admin.costumer.index') }}" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
        Kembali
    </a>
</div>

<div class="form-card">
    @if($errors->any())
    <div class="error-list">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.costumer.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-input" placeholder="Nama lengkap customer" required>
        </div>

        <div class="form-group">
            <label class="form-label">Email <span class="required">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-input" placeholder="contoh@email.com" required>
        </div>

        <div class="form-group">
            <label class="form-label">Nomor WhatsApp <span class="required">*</span></label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="form-input" placeholder="Contoh: 08123456789" inputmode="numeric" required>
        </div>

        <div class="form-group">
            <label class="form-label">Password <span class="required">*</span></label>
            <input type="password" name="password" class="form-input" required>
            <p class="form-hint">Minimal 8 karakter. ID Number akan di-generate otomatis.</p>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.costumer.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Simpan Customer
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('phone').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection