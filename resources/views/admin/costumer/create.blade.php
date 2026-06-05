{{-- resources/views/admin/costumer/create.blade.php --}}

<div class="modal-backdrop" id="modal-create">
    <div class="modal" style="max-width: 520px !important;">
        <div class="modal-header">
            <span class="modal-title">Tambah Customer</span>
            <button class="modal-close" onclick="closeModal('modal-create')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.costumer.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_form" value="create">

            <div class="modal-body">
                @if ($errors->any() && old('_form') === 'create')
                    <div class="error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label">ID Number <span class="required">*</span></label>
                    <input type="text" name="id_number"
                        value="{{ old('_form') === 'create' ? old('id_number') : '' }}" class="form-input"
                        placeholder="Masukkan ID unik customer" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('_form') === 'create' ? old('name') : '' }}"
                        class="form-input" placeholder="Nama lengkap customer" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('_form') === 'create' ? old('email') : '' }}"
                        class="form-input" placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="phone" id="create-phone"
                        value="{{ old('_form') === 'create' ? old('phone') : '' }}" class="form-input"
                        placeholder="08123456789" inputmode="numeric">
                </div>
                
                <div class="form-group" style="margin-bottom: 0 !important;">
                    <label class="form-label">Password <span class="required">*</span></label>
                    <input type="password" name="password" class="form-input" required>
                    <p class="form-hint">Minimal 8 karakter.</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-create')">Batal</button>
                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Simpan Customer
                </button>
            </div>
        </form>
    </div>
</div>
