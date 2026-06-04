@include('layouts.navigation.customer.top')

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-[#1b2563] to-[#730f00] rounded-3xl p-6 mb-8 text-white shadow-2xl overflow-hidden">
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#ffc61a] rounded-full opacity-20"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#ffc61a] rounded-full opacity-10"></div>
    
    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <i class="fas fa-sun text-[#ffc61a] text-xl"></i>
                <span class="text-[#ffc61a] text-xs font-semibold bg-white/20 px-2 py-0.5 rounded-full">Good Morning!</span>
            </div>
            <h2 class="text-3xl font-bold mb-1">Rise And Shine!</h2>
            <p class="text-white/80 text-sm">It's Breakfast Time 🍳</p>
            <div class="flex items-center gap-2 mt-3">
                <div class="bg-white/20 backdrop-blur rounded-full px-3 py-1 text-sm">
                    <i class="fas fa-wallet mr-1 text-[#ffc61a]"></i> Saldo: <span class="font-bold">Rp100.900</span>
                </div>
            </div>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-moon text-6xl text-white/20"></i>
        </div>
    </div>
</div>

<!-- Kategori Cepat -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-[#1b2563]">Kategori Menu</h3>
        <a href="{{ route('customer.menu') }}" class="text-xs text-[#730f00] font-semibold">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="grid grid-cols-4 gap-3">
        <div class="bg-white rounded-2xl p-3 text-center shadow-md hover:shadow-xl transition cursor-pointer group">
            <div class="w-12 h-12 mx-auto bg-[#ffc61a]/20 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#ffc61a]/30 transition">
                <i class="fas fa-burger text-[#730f00] text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-[#1b2563]">Snacks</span>
        </div>
        <div class="bg-white rounded-2xl p-3 text-center shadow-md hover:shadow-xl transition cursor-pointer group">
            <div class="w-12 h-12 mx-auto bg-[#ffc61a]/20 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#ffc61a]/30 transition">
                <i class="fas fa-utensils text-[#730f00] text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-[#1b2563]">Meal</span>
        </div>
        <div class="bg-white rounded-2xl p-3 text-center shadow-md hover:shadow-xl transition cursor-pointer group">
            <div class="w-12 h-12 mx-auto bg-[#ffc61a]/20 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#ffc61a]/30 transition">
                <i class="fas fa-carrot text-[#730f00] text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-[#1b2563]">Veggies</span>
        </div>
        <div class="bg-white rounded-2xl p-3 text-center shadow-md hover:shadow-xl transition cursor-pointer group">
            <div class="w-12 h-12 mx-auto bg-[#ffc61a]/20 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#ffc61a]/30 transition">
                <i class="fas fa-mug-hot text-[#730f00] text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-[#1b2563]">Drinks</span>
        </div>
    </div>
</div>

<!-- Best Seller Section -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-[#1b2563] flex items-center gap-2">
            <i class="fas fa-fire text-[#730f00]"></i> Best Seller
        </h3>
        <a href="{{ route('customer.menu') }}" class="text-xs text-[#730f00] font-semibold">View All <i class="fas fa-chevron-right ml-1"></i></a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition flex">
            <div class="w-32 h-32 bg-gradient-to-br from-[#ffc61a]/30 to-[#730f00]/20 flex items-center justify-center">
                <i class="fas fa-shrimp text-5xl text-[#730f00]"></i>
            </div>
            <div class="flex-1 p-3">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-[#1b2563]">Nasi Goreng Spesial</h4>
                        <p class="text-xs text-gray-500">Dengan telur, ayam, udang</p>
                    </div>
                    <span class="bg-[#730f00] text-white text-[10px] px-2 py-0.5 rounded-full">30% OFF</span>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-lg font-black text-[#730f00]">Rp15.000</span>
                    <span class="text-xs text-gray-400 line-through">Rp21.000</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition flex">
            <div class="w-32 h-32 bg-gradient-to-br from-[#ffc61a]/30 to-[#730f00]/20 flex items-center justify-center">
                <i class="fas fa-drumstick-bite text-5xl text-[#730f00]"></i>
            </div>
            <div class="flex-1 p-3">
                <h4 class="font-bold text-[#1b2563]">Mie Ayam Ceker</h4>
                <p class="text-xs text-gray-500">Mie kenyal dengan ayam kecap</p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-lg font-black text-[#730f00]">Rp18.000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rekomendasi -->
<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-[#1b2563]">Recommend For You</h3>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-3 shadow-md hover:shadow-lg transition cursor-pointer">
            <div class="w-full h-28 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center mb-2">
                <i class="fas fa-hamburger text-4xl text-[#730f00]"></i>
            </div>
            <h4 class="font-bold text-sm text-[#1b2563]">Chicken Burger</h4>
            <p class="text-xs text-gray-500">Daging ayam crispy</p>
            <div class="flex justify-between items-center mt-1">
                <span class="font-bold text-[#730f00]">Rp12.000</span>
                <i class="fas fa-plus-circle text-[#ffc61a] text-lg"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-3 shadow-md hover:shadow-lg transition cursor-pointer">
            <div class="w-full h-28 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center mb-2">
                <i class="fas fa-mug-hot text-4xl text-[#730f00]"></i>
            </div>
            <h4 class="font-bold text-sm text-[#1b2563]">Es Teh Manis</h4>
            <p class="text-xs text-gray-500">Teh melati segar</p>
            <div class="flex justify-between items-center mt-1">
                <span class="font-bold text-[#730f00]">Rp6.000</span>
                <i class="fas fa-plus-circle text-[#ffc61a] text-lg"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-3 shadow-md hover:shadow-lg transition cursor-pointer">
            <div class="w-full h-28 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center mb-2">
                <i class="fas fa-cookie text-4xl text-[#730f00]"></i>
            </div>
            <h4 class="font-bold text-sm text-[#1b2563]">Keripik Singkong</h4>
            <p class="text-xs text-gray-500">Pedas & renyah</p>
            <div class="flex justify-between items-center mt-1">
                <span class="font-bold text-[#730f00]">Rp7.500</span>
                <i class="fas fa-plus-circle text-[#ffc61a] text-lg"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-3 shadow-md hover:shadow-lg transition cursor-pointer">
            <div class="w-full h-28 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center mb-2">
                <i class="fas fa-fish text-4xl text-[#730f00]"></i>
            </div>
            <h4 class="font-bold text-sm text-[#1b2563]">Bakso Urat</h4>
            <p class="text-xs text-gray-500">Bakso super kenyal</p>
            <div class="flex justify-between items-center mt-1">
                <span class="font-bold text-[#730f00]">Rp22.000</span>
                <i class="fas fa-plus-circle text-[#ffc61a] text-lg"></i>
            </div>
        </div>
    </div>
</div>

@include('layouts.navigation.customer.bottom')