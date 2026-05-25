<div id="cash-payment-wrapper">

    <div id="cash-payment-header">
        <h1>Pembayaran Tunai</h1>
        <p>Catat pembayaran sewa secara tunai dari vendor</p>
    </div>

    @if(session('success'))
        <div id="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div id="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="cash-payment-form-card">
        <form action="{{ route('admin.cash-payment.store') }}" method="POST">
            @csrf

            <div id="form-group-shop">
                <label for="shop_id">Pilih Warung</label>
                <select name="shop_id" id="shop_id" onchange="updateVendorInfo(this)">
                    <option value="">-- Pilih Warung --</option>
                    @foreach($vendors as $vendor)
                        @if($vendor->shop)
                            <option value="{{ $vendor->shop->id }}"
                                data-vendor="{{ $vendor->name }}"
                                data-email="{{ $vendor->email }}"
                                data-phone="{{ $vendor->phone ?? '-' }}"
                                {{ old('shop_id') == $vendor->shop->id ? 'selected' : '' }}>
                                {{ $vendor->shop->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div id="vendor-info" style="display:none;">
                <p>Pemilik: <strong id="vendor-name"></strong></p>
                <p>Email: <strong id="vendor-email"></strong></p>
                <p>WhatsApp: <strong id="vendor-phone"></strong></p>
            </div>

            <div id="form-group-amount">
                <label for="amount">Nominal Sewa (Rp)</label>
                <input type="number" name="amount" id="amount"
                    value="{{ old('amount') }}"
                    placeholder="Contoh: 300000"
                    min="1000">
            </div>

            <div id="form-actions">
                <a href="{{ route('admin.invoice.index') }}">← Kembali ke Invoice</a>
                <button type="submit">Simpan Pembayaran</button>
            </div>
        </form>
    </div>

</div>

<script>
    function updateVendorInfo(select) {
        const opt = select.options[select.selectedIndex];
        if (opt.value) {
            document.getElementById('vendor-name').textContent  = opt.getAttribute('data-vendor');
            document.getElementById('vendor-email').textContent = opt.getAttribute('data-email');
            document.getElementById('vendor-phone').textContent = opt.getAttribute('data-phone');
            document.getElementById('vendor-info').style.display = 'block';
        } else {
            document.getElementById('vendor-info').style.display = 'none';
        }
    }

    // Restore jika ada old value
    const sel = document.getElementById('shop_id');
    if (sel.value) updateVendorInfo(sel);
</script>
