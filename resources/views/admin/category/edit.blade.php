{{-- resources/views/admin/category/edit.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-edit">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Edit Kategori</span>
            <button class="modal-close" onclick="closeModal('modal-edit')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="_form" value="edit">

            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="edit-name">
                        Nama Kategori <span class="required">*</span>
                    </label>
                    <input type="text" id="edit-name" name="name"
                        class="form-input {{ $errors->has('name') && old('_form') === 'edit' ? 'input-error' : '' }}"
                        value="{{ old('_form') === 'edit' ? old('name') : '' }}"
                        placeholder="Nama kategori..."
                        autocomplete="off">
                    @if($errors->has('name') && old('_form') === 'edit')
                        <span class="error-msg">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Slug saat ini</label>
                    <input type="text" id="edit-slug" class="form-input" disabled>
                    <p class="form-hint">Slug diperbarui otomatis dari nama kategori.</p>
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