@extends('layouts.customer')

@section('title', 'Checkout Pesanan')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36 pt-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-800">Checkout</h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Selesaikan pesanan jajananmu
                </p>
            </div>

            <form action="{{ route('customer.order.store') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
                @csrf

                <!-- Order Summary Card -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xs mb-6">
                    <h3 class="font-black text-slate-800 mb-6 uppercase text-xs tracking-widest">Ringkasan Belanja</h3>
                    <div class="space-y-4">
                        @foreach ($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="font-semibold text-slate-600">{{ $item['quantity'] }}x
                                    {{ $item['name'] }}</span>
                                <span class="font-black text-slate-800">Rp
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-slate-100 mt-6 pt-6 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase">Total Bayar</span>
                        <span class="text-xl font-black text-[#730f00]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <!-- Order Type -->
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2 tracking-widest">Tipe
                            Pesanan</label>
                        <select name="order_type" id="order_type"
                            class="w-full p-4 mt-2 rounded-2xl border border-slate-100 bg-white font-black text-slate-700 focus:ring-2 focus:ring-[#1b2563] outline-none transition-all"
                            required>
                            <option value="pickup">Ambil Sendiri (Pickup)</option>
                            <option value="delivery">Antar ke Tempat (Delivery)</option>
                        </select>
                    </div>

                    <!-- Delivery Location -->
                    <div id="delivery_field" class="hidden">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2 tracking-widest">Lokasi
                            Pengantaran</label>
                        <input type="text" name="delivery_location" id="delivery_location"
                            placeholder="Contoh: Kelas XI-RPL 2"
                            class="w-full p-4 mt-2 rounded-2xl border border-slate-100 focus:ring-2 focus:ring-[#1b2563] outline-none font-bold transition-all">
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2 tracking-widest">Metode
                            Pembayaran</label>
                        <select name="payment_method" id="payment_method"
                            class="w-full p-4 mt-2 rounded-2xl border border-slate-100 bg-white font-black text-slate-700 focus:ring-2 focus:ring-[#1b2563] outline-none transition-all"
                            required>
                            <option value="cash">Bayar Tunai</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <!-- Payment Proof -->
                    <div id="payment_proof_field" class="hidden">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2 tracking-widest">Upload Bukti
                            Transfer</label>
                        <input type="file" name="payment_proof" accept="image/*"
                            class="w-full p-4 mt-2 rounded-2xl border border-slate-100 bg-white font-bold text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-slate-100 file:text-slate-600">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full mt-8 bg-[#1b2563] text-white py-4 rounded-2xl font-black shadow-xl shadow-[#1b2563]/20 hover:bg-[#1b2563]/90 active:scale-[0.98] transition-all uppercase tracking-widest text-sm">
                    Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>

    <script>
        const orderType = document.getElementById('order_type');
        const deliveryField = document.getElementById('delivery_field');
        const paymentMethod = document.getElementById('payment_method');
        const proofField = document.getElementById('payment_proof_field');

        orderType.addEventListener('change', (e) => {
            deliveryField.classList.toggle('hidden', e.target.value !== 'delivery');
            document.getElementById('delivery_location').required = (e.target.value === 'delivery');
        });

        paymentMethod.addEventListener('change', (e) => {
            proofField.classList.toggle('hidden', e.target.value !== 'transfer');
        });
    </script>
@endsection
