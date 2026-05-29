{{-- resources/views/admin/vendor/edit.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-edit">
    <div class="modal" style="max-width: 680px !important;">
        <div class="modal-header">
            <span class="modal-title">Edit Penjual</span>
            <button class="modal-close" onclick="closeModal('modal-edit')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="edit-vendor-form" action="" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_form" value="edit">

            <div class="modal-body" style="max-height: 72vh; overflow-y: auto;">

                <div class="modal-form-grid">

                    {{-- Informasi Pemilik --}}
                    <div class="modal-section-title" style="grid-column: span 2;">Informasi Pemilik</div>

                    <div class="form-group">
                        <label class="form-label">Nama Pemilik <span class="required">*</span></label>
                        <input type="text" id="edit-name" name="name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Login <span class="required">*</span></label>
                        <input type="email" id="edit-email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" id="edit-phone" name="phone" class="form-input" placeholder="08123456789">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-input">
                        <p class="form-hint">Kosongkan jika tidak ingin mengubah.</p>
                    </div>

                    {{-- Informasi Warung --}}
                    <div class="modal-section-title" style="grid-column: span 2; margin-top: 4px;">Informasi Warung</div>

                    <div class="form-group">
                        <label class="form-label">Nama Warung <span class="required">*</span></label>
                        <input type="text" id="edit-shop-name" name="shop_name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Logo Warung</label>
                        <div id="edit-current-logo" style="display:none; align-items:center; gap:10px; margin-bottom:8px;">
                            <img id="edit-logo-img" src="" style="width:48px;height:48px;object-fit:cover;border-radius:50%;border:2px solid #e8eaf0;">
                            <span style="font-size:11px;color:var(--gray-400);">Logo saat ini</span>
                        </div>
                        <input type="file" name="shop_logo" accept="image/jpg,image/jpeg,image/png"
                            class="form-input" style="padding: 8px 14px !important;" onchange="previewEditLogo(this)">
                        <div id="edit-logo-preview" style="display:none; margin-top:8px; text-align:center;">
                            <img id="edit-logo-new" src="" style="width:56px;height:56px;object-fit:cover;border-radius:50%;border:2px solid #16a34a;">
                            <p style="font-size:11px;color:#16a34a;margin-top:4px;">Preview baru</p>
                        </div>
                        <p class="form-hint">Kosongkan jika tidak ingin mengubah.</p>
                    </div>

                    {{-- Pembayaran Sewa --}}
                    <div class="modal-section-title" style="grid-column: span 2; margin-top: 4px;">Pembayaran Sewa</div>

                    <div class="form-group">
                        <label class="form-label">Biaya Sewa (Rp) <span class="required">*</span></label>
                        <input type="number" id="edit-sewa" name="nominal_sewa" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran <span class="required">*</span></label>
                        <select name="payment_method" id="edit_payment_method" class="form-select">
                            <option value="cash">Cash (Tunai)</option>
                            <option value="transfer">Transfer Bank</option>
                        </select>
                    </div>

                    <div id="edit_bukti_tf" style="display:none; grid-column: span 2;">
                        <div class="info-box" style="margin-bottom: 10px !important;">
                            <strong>Info Rekening:</strong> BCA 1234567890 a/n Admin E-Kantin
                        </div>
                        <label class="form-label">Upload Bukti Transfer Baru</label>
                        <input type="file" name="payment_proof" class="form-input" style="padding: 8px 14px !important;">
                        <p class="form-hint">Kosongkan jika tidak ingin mengubah.</p>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-edit')">Batal</button>
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
</div>