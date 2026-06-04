@include('layouts.navigation.customer.top')

<div class="mb-6">
    <h1 class="text-2xl font-black text-[#1b2563] flex items-center gap-2">
        <i class="fas fa-credit-card text-[#730f00]"></i>
        Checkout
    </h1>
    <p class="text-sm text-gray-500">Konfirmasi pesanan dan metode pembayaran</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Section -->
    <div class="lg:col-span-2 space-y-5">
        <!-- Delivery Info -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-bold text-[#1b2563] flex items-center gap-2 mb-4">
                <i class="fas fa-map-marker-alt text-[#730f00]"></i>
                Informasi Pengiriman
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600">Nama Lengkap</label>
                    <input type="text" value="{{ Auth::user()->name ?? 'Budi Santoso' }}" class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#730f00]">
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Nomor Telepon</label>
                    <input type="text" value="0812-3456-7890" class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#730f00]">
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-gray-600">Alamat / Lokasi Kelas</label>
                    <input type="text" value="Kelas XII RPL 2 - Gedung Utama Lantai 2" class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#730f00]">
                </div>
            </div>
        </div>
        
        <!-- Payment Method -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-bold text-[#1b2563] flex items-center gap-2 mb-4">
                <i class="fas fa-wallet text-[#730f00]"></i>
                Metode Pembayaran
            </h3>
            <div class="space-y-3">
                <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#730f00] transition">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment" class="text-[#730f00]" checked>
                        <i class="fas fa-coins text-xl text-[#ffc61a]"></i>
                        <div>
                            <p class="font-semibold text-sm">Saldo Foody</p>
                            <p class="text-xs text-gray-400">Sisa saldo: Rp100.900</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-green-600">Tersedia</span>
                </label>
                
                <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#730f00] transition">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment" class="text-[#730f00]">
                        <i class="fab fa-qrcode text-xl text-[#1b2563]"></i>
                        <div>
                            <p class="font-semibold text-sm">QRIS</p>
                            <p class="text-xs text-gray-400">Scan menggunakan aplikasi bank</p>
                        </div>
                    </div>
                </label>
                
                <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#730f00] transition">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment" class="text-[#730f00]">
                        <i class="fas fa-university text-xl text-[#1b2563]"></i>
                        <div>
                            <p class="font-semibold text-sm">Transfer Bank</p>
                            <p class="text-xs text-gray-400">BCA, Mandiri, BNI, BRI</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        
        <!-- Notes -->
        <div class="bg-white rounded-2xl p-5 shadow-md">