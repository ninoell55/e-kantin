<div class="container" style="max-width: 600px; margin: 40px auto; font-family: 'Segoe UI', sans-serif;">
    <h2 style="margin-bottom: 25px; text-align: center;">Edit Data Penjual</h2>

    <form action="{{ route('admin.vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data"
        style="background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #ddd; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        @csrf
        @method('PUT')

        {{-- Error Messages --}}
        @if ($errors->any())
            <div style="background: #fff5f5; color: #c53030; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
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
            <input type="text" name="name" value="{{ old('name', $vendor->name) }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Nama Warung --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Warung</label>
            <input type="text" name="shop_name" value="{{ old('shop_name', $vendor->shop->name ?? '') }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Logo Warung --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Logo Warung</label>
            @if ($vendor->shop && $vendor->shop->banner_path)
                <div style="margin-bottom: 8px;">
                    <img src="{{ asset($vendor->shop->banner_path) }}" width="60" height="60"
                        style="object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                    <span style="font-size: 11px; color: #999; margin-left: 8px;">Logo saat ini</span>
                </div>
            @endif
            <input type="file" name="shop_logo" accept="image/jpg,image/jpeg,image/png"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: #fff;"
                onchange="previewLogo(this)">
            <div id="logo_preview" style="display: none; margin-top: 10px; text-align: center;">
                <img id="logo_img" src="" width="60" height="60"
                    style="object-fit: cover; border-radius: 50%; border: 2px solid #28a745;">
                <div style="font-size: 11px; color: #28a745; margin-top: 4px;">Preview logo baru</div>
            </div>
            <small style="color: #999;">Kosongkan jika tidak ingin mengubah logo. Format: JPG/PNG, maks. 2MB.</small>
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Email Login</label>
            <input type="email" name="email" value="{{ old('email', $vendor->email) }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- WhatsApp --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nomor WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        {{-- Biaya Sewa --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Biaya Sewa (Rp)</label>
            <input type="number" name="nominal_sewa" value="{{ old('nominal_sewa', $vendor->shop->currentBill->amount ?? 0) }}"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        {{-- Metode Pembayaran --}}
        <div style="margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 8px;">
            <label style="display: block; font-weight: bold; margin-bottom: 10px;">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method"
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; margin-bottom: 10px;">
                <option value="cash" {{ ($vendor->shop->currentBill->payment_method ?? '') == 'cash' ? 'selected' : '' }}>
                    Cash (Tunai)
                </option>
                <option value="transfer" {{ ($vendor->shop->currentBill->payment_method ?? '') == 'transfer' ? 'selected' : '' }}>
                    Transfer Bank
                </option>
            </select>

            {{-- Bukti Transfer --}}
            <div id="bukti_tf_container"
                style="display: {{ ($vendor->shop->currentBill->payment_method ?? '') == 'transfer' ? 'block' : 'none' }}; border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px;">
                <p style="font-size: 12px; color: #2b6cb0; background: #ebf8ff; padding: 10px; border-radius: 4px;">
                    <strong>Info Rekening:</strong> BCA 1234567890 a/n Admin E-Kantin
                </p>

                {{-- Preview bukti lama --}}
                @if ($vendor->shop && $vendor->shop->currentBill && $vendor->shop->currentBill->payment_proof)
                    <div style="margin-bottom: 8px;">
                        <a href="{{ asset($vendor->shop->currentBill->payment_proof) }}" target="_blank">
                            <img src="{{ asset($vendor->shop->currentBill->payment_proof) }}" width="60" height="60"
                                style="object-fit: cover; border-radius: 4px; border: 1px solid #ddd; cursor: zoom-in;">
                        </a>
                        <span style="font-size: 11px; color: #999; margin-left: 8px;">Bukti saat ini</span>
                    </div>
                @endif

                <label style="display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px;">
                    Upload Bukti Transfer Baru
                </label>
                <input type="file" name="payment_proof" style="font-size: 13px;">
                <small style="color: #999;">Kosongkan jika tidak ingin mengubah bukti transfer.</small>
            </div>
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Password Baru</label>
            <input type="password" name="password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            <small style="color: #999;">Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        {{-- Tombol --}}
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.vendor.index') }}"
                style="flex: 1; text-align: center; background: #6c757d; color: white; padding: 12px; border-radius: 6px; font-weight: bold; text-decoration: none;">
                Batal
            </a>
            <button type="submit"
                style="flex: 2; background: #007bff; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function () {
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
