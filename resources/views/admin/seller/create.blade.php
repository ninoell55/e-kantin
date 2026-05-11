<div class="container" style="max-width: 600px; margin: 40px auto; font-family: 'Segoe UI', sans-serif;">
    <h2 style="margin-bottom: 25px; text-align: center;">Tambah Penjual Baru</h2>

    {{-- PENTING: Tambahkan enctype agar bisa upload file --}}
    <form action="{{ route('admin.seller.store') }}" method="POST" enctype="multipart/form-data"
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

        {{-- Nama Pemilik --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Pemilik Warung</label>
            <input type="text" name="name" value="{{ old('name') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Nama Warung --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Warung</label>
            <input type="text" name="shop_name" value="{{ old('shop_name') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email Login</label>
            <input type="email" name="email" value="{{ old('email') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- WhatsApp --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nomor WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        {{-- Biaya Sewa --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Biaya Sewa (Rp)</label>
            <input type="number" name="nominal_sewa" value="{{ old('nominal_sewa') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Pembayaran --}}
        <div style="margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 8px;">
            <label style="display: block; font-weight: bold; margin-bottom: 10px;">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method"
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; margin-bottom: 10px;">
                <option value="cash">Cash (Tunai)</option>
                <option value="transfer">Transfer Bank</option>
            </select>

            {{-- Kolom Bukti TF (Hidden by Default) --}}
            <div id="bukti_tf_container"
                style="display: none; border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px;">
                <p style="font-size: 12px; color: #2b6cb0; background: #ebf8ff; padding: 10px; border-radius: 4px;">
                    <strong>Info Rekening:</strong> BCA 1234567890 a/n Admin E-Kantin
                </p>
                <label style="display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px;">Upload Bukti
                    Transfer</label>
                <input type="file" name="payment_proof" style="font-size: 13px;">
            </div>
        </div>

        {{-- Logo Warung --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Logo Warung</label>
            <input type="file" name="shop_logo" accept="image/jpg,image/jpeg,image/png"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: #fff;"
                onchange="previewLogo(this)">
            <div id="logo_preview" style="display: none; margin-top: 10px; text-align: center;">
                <img id="logo_img" src="" width="80" height="80"
                    style="object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
            </div>
            <small style="color: #999;">Format: JPG/PNG, maks. 2MB. Tersimpan ke public/shop_logos.</small>
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Password Login</label>
            <input type="password" name="password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        <button type="submit"
            style="width: 100%; background: #28a745; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Simpan & Aktifkan Penjual
        </button>
    </form>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        const proofField = document.getElementById('bukti_tf_container');
        proofField.style.display = (this.value === 'transfer') ? 'block' : 'none';
    });

    function previewLogo(input) {
        const preview = document.getElementById('logo_preview');
        const img = document.getElementById('logo_img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
