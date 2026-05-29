{{-- resources/views/admin/vendor/create.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-create">
    <div class="modal" style="max-width: 680px !important;">
        <div class="modal-header">
            <span class="modal-title">Tambah Penjual</span>
            <button class="modal-close" onclick="closeModal('modal-create')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_form" value="create">

            <div class="modal-body" style="max-height: 72vh; overflow-y: auto;">

                @if($errors->any() && old('_form') === 'create')
                <div class="error-list">
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <div class="modal-form-grid">

                    {{-- Informasi Pemilik --}}
                    <div class="modal-section-title" style="grid-column: span 2;">Informasi Pemilik</div>

                    <div class="form-group">
                        <label class="form-label">Nama Pemilik <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('_form') === 'create' ? old('name') : '' }}"
                            class="form-input" placeholder="Nama lengkap pemilik" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Login <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('_form') === 'create' ? old('email') : '' }}"
                            class="form-input" placeholder="email@contoh.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('_form') === 'create' ? old('phone') : '' }}"
                            class="form-input" placeholder="08123456789">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <input type="password" name="password" class="form-input" required>
                        <p class="form-hint">Minimal 8 karakter.</p>
                    </div>

                    {{-- Informasi Warung --}}
                    <div class="modal-section-title" style="grid-column: span 2; margin-top: 4px;">Informasi Warung</div>

                    <div class="form-group">
                        <label class="form-label">Nama Warung <span class="required">*</span></label>
                        <input type="text" name="shop_name" value="{{ old('_form') === 'create' ? old('shop_name') : '' }}"
                            class="form-input" placeholder="Nama warung" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Logo Warung</label>
                        <input type="file" name="shop_logo" accept="image/jpg,image/jpeg,image/png"
                            class="form-input" style="padding: 8px 14px !important;" onchange="previewCreateLogo(this)">
                        <div id="create-logo-preview" style="display:none; margin-top:8px; text-align:center;">
                            <img id="create-logo-img" src="" style="width:56px;height:56px;object-fit:cover;border-radius:50%;border:2px solid #e8eaf0;">
                        </div>
                        <p class="form-hint">Format JPG/PNG, maks. 2MB.</p>
                    </div>

                    {{-- Pembayaran Sewa --}}
                    <div class="modal-section-title" style="grid-column: span 2; margin-top: 4px;">Pembayaran Sewa</div>

                    <div class="form-group">
                        <label class="form-label">Biaya Sewa (Rp) <span class="required">*</span></label>
                        <input type="number" name="nominal_sewa" value="{{ old('_form') === 'create' ? old('nominal_sewa') : '' }}"
                            class="form-input" placeholder="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran <span class="required">*</span></label>
                        <select name="payment_method" id="create_payment_method" class="form-select">
                            <option value="cash">Cash (Tunai)</option>
                            <option value="transfer">Transfer Bank</option>
                        </select>
                    </div>

                    <div id="create_bukti_tf" style="display:none; grid-column: span 2;">
                        <div class="info-box" style="margin-bottom: 10px !important;">
                            <strong>Info Rekening:</strong> BCA 1234567890 a/n Admin E-Kantin
                        </div>
                        <label class="form-label">Upload Bukti Transfer</label>
                        <input type="file" name="payment_proof" class="form-input" style="padding: 8px 14px !important;">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-create')">Batal</button>
                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Simpan Penjual
                </button>
            </div>
        </form>
    </div>
</div>