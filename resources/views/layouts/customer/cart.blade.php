@include('layouts.navigation.customer.top')

<div class="mb-6">
    <h1 class="text-2xl font-black text-[#1b2563] flex items-center gap-2">
        <i class="fas fa-shopping-bag text-[#730f00]"></i>
        Keranjang Belanja
    </h1>
    <p class="text-sm text-gray-500">Review pesananmu sebelum checkout</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Cart Items -->
    <div class="lg:col-span-2 space-y-4">
        <!-- Item 1 -->
        <div class="bg-white rounded-2xl p-4 shadow-md flex gap-4 items-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-burger text-3xl text-[#730f00]"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-[#1b2563]">Nasi Goreng Spesial</h4>
                        <p class="text-xs text-gray-500">Best Seller • 30% OFF</p>
                    </div>
                    <button class="text-gray-400 hover:text-[#730f00] transition">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-lg font-black text-[#730f00]">Rp15.000</span>
                    <div class="flex items-center gap-3 bg-gray-100 rounded-full px-3 py-1">
                        <button class="text-[#730f00] font-bold text-lg">-</button>
                        <span class="font-bold text-[#1b2563]">1</span>
                        <button class="text-[#730f00] font-bold text-lg">+</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Item 2 -->
        <div class="bg-white rounded-2xl p-4 shadow-md flex gap-4 items-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-mug-hot text-3xl text-[#730f00]"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-[#1b2563]">Es Teh Manis Segar</h4>
                        <p class="text-xs text-gray-500">Minuman segar</p>
                    </div>
                    <button class="text-gray-400 hover:text-[#730f00] transition">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-lg font-black text-[#730f00]">Rp6.000</span>
                    <div class="flex items-center gap-3 bg-gray-100 rounded-full px-3 py-1">
                        <button class="text-[#730f00] font-bold text-lg">-</button>
                        <span class="font-bold text-[#1b2563]">2</span>
                        <button class="text-[#730f00] font-bold text-lg">+</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Item 3 - dengan opsi tambahan -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <div class="flex gap-4 items-start">
                <div class="w-20 h-20 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hamburger text-3xl text-[#730f00]"></i>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-bold text-[#1b2563]">Chicken Burger</h4>
                            <p class="text-xs text-gray-500">Dengan saus mayonaise</p>
                        </div>
                        <button class="text-gray-400 hover:text-[#730f00] transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-lg font-black text-[#730f00]">Rp12.000</span>
                        <div class="flex items-center gap-3 bg-gray-100 rounded-full px-3 py-1">
                            <button class="text-[#730f00] font-bold text-lg">-</button>
                            <span class="font-bold text-[#1b2563]">1</span>
                            <button class="text-[#730f00] font-bold text-lg">+</button>
                        </div>
                    </div>
                    
                    <!-- Additional Options -->
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-xs font-semibold text-[#1b2563] mb-2">Tambahan (opsional):</p>
                        <div class="flex gap-3">
                            <label class="flex items-center gap-1 text-xs text-gray-600">
                                <input type="checkbox" class="rounded border-gray-300 text-[#730f00]">
                                <span>Extra Mayo</span>
                                <span class="text-[#730f00] font-bold">+Rp2.000</span>
                            </label>
                            <label class="flex items-center gap-1 text-xs text-gray-600">
                                <input type="checkbox" class="rounded border-gray-300 text-[#730f00]">
                                <span>Extra Keju</span>
                                <span class="text-[#730f00] font-bold">+Rp3.000</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl p-5 shadow-md sticky top-24">
            <h3 class="font-bold text-lg text-[#1b2563] mb-4">Ringkasan Pesanan</h3>
            
            <div class="space-y-3 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Subtotal (3 item)</span>
                    <span class="font-semibold">Rp33.000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Diskon (30% OFF)</span>
                    <span class="text-[#730f00] font-semibold">-Rp4.500</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Biaya Layanan</span>
                    <span class="font-semibold">Rp2.000</span>
                </div>
                <div class="border-t border-gray-100 pt-3">
                    <div class="flex justify-between font-bold">
                        <span>Total</span>
                        <span class="text-xl text-[#730f00]">Rp30.500</span>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">*Belum termasuk pajak</p>
                </div>
            </div>
            
            <div class="bg-[#ffc61a]/10 rounded-xl p-3 mb-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-ticket-alt text-[#ffc61a]"></i>
                    <input type="text" placeholder="Kode Voucher" class="flex-1 bg-transparent text-sm outline-none placeholder:text-gray-400">
                    <button class="text-[#730f00] font-bold text-sm">Apply</button>
                </div>
            </div>
            
            <a href="{{ route('customer.checkout') }}" class="btn-primary w-full py-3 rounded-xl text-white font-bold flex items-center justify-center gap-2">
                <i class="fas fa-credit-card"></i> Lanjut ke Pembayaran
            </a>
            
            <p class="text-center text-[10px] text-gray-400 mt-3">
                <i class="fas fa-lock mr-1"></i> Pembayaran aman & terenkripsi
            </p>
        </div>
    </div>
</div>

<script>
// Quantity buttons functionality
document.querySelectorAll('.flex.items-center.gap-3.bg-gray-100').forEach(container => {
    const minusBtn = container.children[0];
    const quantitySpan = container.children[1];
    const plusBtn = container.children[2];
    let qty = parseInt(quantitySpan.textContent);
    
    minusBtn.addEventListener('click', () => {
        if(qty > 1) {
            qty--;
            quantitySpan.textContent = qty;
        }
    });
    
    plusBtn.addEventListener('click', () => {
        qty++;
        quantitySpan.textContent = qty;
    });
});
</script>

@include('layouts.navigation.customer.bottom')