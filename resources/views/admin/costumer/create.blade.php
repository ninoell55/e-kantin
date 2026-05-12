<div class="container" style="max-width: 600px; margin: 40px auto; font-family: 'Segoe UI', sans-serif;">
    <h2 style="margin-bottom: 25px; text-align: center;">Tambah Customer Baru</h2>

    <form action="{{ route('admin.costumer.store') }}" method="POST"
        style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #ddd; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        @csrf

        {{-- Error Messages --}}
        @if ($errors->any())
            <div
                style="background: #fff5f5; color: #c53030; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Nama --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- WhatsApp --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nomor WhatsApp</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" inputmode="numeric"
                placeholder="Contoh: 08123456789"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Password</label>
            <input type="password" name="password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
            <small style="color: #999;">Minimal 8 karakter. ID Number akan di-generate otomatis.</small>
        </div>

        {{-- Tombol --}}
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.costumer.index') }}"
                style="flex: 1; text-align: center; background: #6c757d; color: white; padding: 12px; border-radius: 6px; font-weight: bold; text-decoration: none;">
                Batal
            </a>
            <button type="submit"
                style="flex: 2; background: #28a745; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                Simpan Customer
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById('phone').addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
