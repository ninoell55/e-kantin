{{-- resources/views/admin/category/create.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-create">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Tambah Kategori</span>
            <button class="modal-close" onclick="closeModal('modal-create')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_form" value="create">

            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="name">
                        Nama Kategori <span class="required">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        class="form-input {{ $errors->has('name') && old('_form') === 'create' ? 'input-error' : '' }}"
                        value="{{ old('_form') === 'create' ? old('name') : '' }}"
                        placeholder="Contoh: Makanan Berat, Minuman..."
                        oninput="generateSlug(this.value)"
                        autocomplete="off">
                    @if($errors->has('name') && old('_form') === 'create')
                        <span class="error-msg">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label" for="slug">
                        Slug <span class="badge-auto">otomatis</span>
                    </label>
                    <div class="input-prefix-wrap">
                        <span class="input-prefix">/kategori/</span>
                        <input type="text" id="slug" name="slug"
                            class="form-input input-with-prefix"
                            value="{{ old('_form') === 'create' ? old('slug') : '' }}"
                            placeholder="makanan-berat" readonly>
                    </div>
                    <p class="form-hint">Dibuat otomatis dari nama kategori.</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-create')">Batal</button>
                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>