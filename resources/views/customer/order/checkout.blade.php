@extends('layouts.customer')
@section('title', 'Checkout Pesanan')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36 pt-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-800">Checkout</h1>
            </div>

            <form action="{{ route('customer.order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xs mb-6">
                    <h3 class="font-black text-slate-800 mb-6 uppercase text-xs tracking-widest">Ringkasan Belanja</h3>
                    @foreach ($cart as $item)
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-semibold text-slate-600">{{ $item['quantity'] }}x {{ $item['name'] }}</span>
                            <span class="font-black text-slate-800">Rp
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div id="delivery_fee_row" class="hidden flex justify-between text-sm border-t pt-4">
                        <span class="font-semibold text-slate-400">Biaya Antar</span>
                        <span class="font-black text-slate-800">Rp 2.000</span>
                    </div>

                    <div class="border-t border-slate-100 mt-6 pt-6 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase">Total Bayar</span>
                        <span id="total_display" class="text-xl font-black text-[#730f00]">Rp
                            {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Tipe Pesanan</label>
                        <select name="order_type" id="order_type"
                            class="w-full p-4 mt-2 rounded-2xl border border-slate-100 bg-white font-black" required>
                            <option value="pickup">Ambil Sendiri (Pickup)</option>
                            <option value="delivery">Antar ke Tempat (Delivery)</option>
                        </select>
                    </div>

                    <div id="delivery_field" class="hidden">
                        <input type="text" name="delivery_location" id="delivery_location"
                            placeholder="Lokasi Pengantaran" class="w-full p-4 rounded-2xl border">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method"
                            class="w-full p-4 mt-2 rounded-2xl border bg-white font-black" required>
                            <option value="cash">Bayar Tunai</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <div id="payment_info_card"
                        class="hidden bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                        <h4 class="font-black text-xs uppercase mb-4">Informasi Pembayaran</h4>
                        @if ($shop->qr_image_path)
                            <img src="{{ asset('storage/' . $shop->qr_image_path) }}"
                                class="w-32 h-32 mx-auto mb-4 rounded-xl">
                        @endif
                        <p class="text-sm font-bold text-slate-700 whitespace-pre-line">{{ $shop->payment_info }}</p>
                    </div>

                    <div id="payment_proof_field" class="hidden">
                        <input type="file" name="payment_proof" accept="image/*" class="w-full p-4 rounded-2xl border">
                    </div>
                </div>

                <button type="submit"
                    class="w-full mt-8 bg-[#1b2563] text-white py-4 rounded-2xl font-black uppercase">Konfirmasi
                    Pesanan</button>
            </form>
        </div>
    </div>

    <script>
        const subtotal = {{ $subtotal }};
        const orderType = document.getElementById('order_type');
        const paymentMethod = document.getElementById('payment_method');

        orderType.addEventListener('change', (e) => {
            const isDelivery = e.target.value === 'delivery';
            document.getElementById('delivery_field').classList.toggle('hidden', !isDelivery);
            document.getElementById('delivery_fee_row').classList.toggle('hidden', !isDelivery);
            const total = isDelivery ? subtotal + 2000 : subtotal;
            document.getElementById('total_display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        });

        paymentMethod.addEventListener('change', (e) => {
            const isTransfer = e.target.value === 'transfer';
            document.getElementById('payment_proof_field').classList.toggle('hidden', !isTransfer);
            document.getElementById('payment_info_card').classList.toggle('hidden', !isTransfer);
        });
    </script>
@endsection
