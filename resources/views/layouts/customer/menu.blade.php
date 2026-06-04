@include('layouts.navigation.customer.top')

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-[#1b2563] to-[#730f00] rounded-3xl p-6 text-white overflow-hidden shadow-xl mb-6">
    <div class="absolute top-0 right-0 w-32 h-32 bg-[#ffc61a]/20 rounded-full blur-3xl"></div>

    <div class="relative z-10">
        <h1 class="text-3xl font-extrabold">Halo, {{ Auth::user()->name ?? 'Siswa' }} 👋</h1>
        <p class="text-white/80 mt-1">
            Mau makan apa hari ini?
        </p>

        <div class="mt-5 relative">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input
                type="text"
                placeholder="Cari makanan atau minuman..."
                class="w-full bg-white rounded-2xl pl-12 pr-4 py-3 text-gray-700 focus:outline-none"
            >
        </div>
    </div>
</div>

<!-- Pilih Stan Kantin -->
<div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">

    <!-- Stan Buka -->
    <div class="min-w-[280px] bg-white rounded-2xl shadow-md overflow-hidden">
        <img
            src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800"
            class="w-full h-32 object-cover"
        >

        <div class="p-4">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-[#1b2563]">
                    Koperasi Sekolah
                </h3>

                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                    ● Buka
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-1">
                Snack, alat tulis, minuman
            </p>
        </div>
    </div>
    <div class="min-w-[280px] bg-white rounded-2xl shadow-md overflow-hidden">
        <img
            src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800"
            class="w-full h-32 object-cover"
        >

        <div class="p-4">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-[#1b2563]">
                    Kantin Bu pardi
                </h3>

                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                    ● Buka
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-1">
                Snack, alat tulis, minuman
            </p>
        </div>
    </div>

    <!-- Stan Tutup -->
    <div class="min-w-[280px] bg-white rounded-2xl shadow-md overflow-hidden opacity-75">
        <img
            src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800"
            class="w-full h-32 object-cover grayscale"
        >

        <div class="p-4">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-[#1b2563]">
                    Mie Ayam Pak Udin
                </h3>

                <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                    ● Tutup
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-1">
                Mie ayam & bakso
            </p>
        </div>
    </div>

</div>
<!-- Header Menu + Kategori Filter -->
<div class="flex flex-wrap justify-between items-center mb-5">
    <div>
        <h3 class="text-xl font-extrabold text-[#1f285a] flex items-center gap-2">
            <i class="fas fa-fire text-red-500"></i>
            Daftar Menu
        </h3>
        <p class="text-xs text-gray-500">Pilihan terbaik untuk kamu hari ini</p>
    </div>
    <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
        <button class="category-filter active-cat bg-[#1f285a] text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-md" data-cat="all">
            Semua
        </button>
        <button class="category-filter bg-gray-100 text-gray-700 px-4 py-1.5 rounded-full text-sm font-medium hover:bg-gray-200 transition" data-cat="minuman">
            <i class="fas fa-mug-hot mr-1"></i> Minuman
        </button>
        <button class="category-filter bg-gray-100 text-gray-700 px-4 py-1.5 rounded-full text-sm font-medium hover:bg-gray-200 transition" data-cat="makanan_berat">
            <i class="fas fa-utensils mr-1"></i> Makanan 
        </button>
        <button class="category-filter bg-gray-100 text-gray-700 px-4 py-1.5 rounded-full text-sm font-medium hover:bg-gray-200 transition" data-cat="makanan_ringan">
            <i class="fas fa-cookie mr-1"></i> Snacks
        </button>
    </div>
</div>

<!-- Grid Menu Items -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    
    <!-- Card 1 - Nasi Goreng Spesial -->
    <div class="menu-card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

    <!-- Gambar -->
    <div class="relative h-52 overflow-hidden">
        <img
            src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800"
            alt="Nasi Goreng"
            class="w-full h-full object-cover hover:scale-105 transition duration-500"
        >

        <span class="absolute top-3 right-3 bg-[#ffc61a] text-black text-xs font-semibold px-3 py-1 rounded-full">
            Best Seller
        </span>
    </div>

    <!-- Isi Card -->
    <div class="p-4">

        <!-- Rating -->
        <div class="flex items-center gap-1 mb-2">
            <i class="fas fa-star text-[#ffc61a] text-xs"></i>
            <span class="text-xs text-gray-500">4.9</span>
        </div>

        <!-- Nama Menu -->
        <h4 class="font-bold text-lg text-gray-800 mb-2">
            Nasi Goreng Spesial
        </h4>

        <!-- Nama Kantin -->
        <div class="flex items-center gap-2 mb-3">
            <i class="fas fa-store text-[#730f00] text-xs"></i>
            <span class="text-xs text-gray-500">
                Kantin Mie Ayam Pak Udin
            </span>
        </div>

        <!-- Deskripsi -->
        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
            Nasi goreng dengan telur, ayam, udang, dan kerupuk.
        </p>

        <!-- Harga -->
        <div class="mb-4">
            <span class="text-2xl font-bold text-[#1b2563]">
                Rp15.000
            </span>
        </div>

        <!-- Tombol -->
        <button
            class="w-full bg-[#1b2563] hover:bg-[#273583]
            text-white font-semibold py-3 rounded-2xl transition">
            <i class="fas fa-cart-plus mr-2"></i>
            Tambah ke Keranjang
        </button>

    </div>
</div>
<div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-3">

    <div class="flex gap-3">

        <!-- Foto -->
        <div class="w-24 h-24 flex-shrink-0">
            <img
                src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800"
                alt="Nasi Goreng"
                class="w-full h-full object-cover rounded-xl"
            >
        </div>

        <!-- Info -->
        <div class="flex flex-col flex-1">

            <h4 class="font-bold text-gray-800">
                Nasi Goreng Spesial
            </h4>

            <div class="flex items-center gap-1 text-xs text-gray-500 mt-1">
                <i class="fas fa-star text-yellow-400"></i>
                <span>4.9</span>
            </div>

            <div class="flex items-center gap-1 text-xs text-gray-500 mt-1">
                <i class="fas fa-store text-[#730f00]"></i>
                <span>Koperasi</span>
            </div>

            <div class="mt-auto flex justify-between items-center pt-2">

                <span class="font-bold text-[#1b2563]">
                    Rp15.000
                </span>

                <button class="bg-[#1b2563] text-white px-3 py-1.5 rounded-lg text-xs">
                    +
                </button>

            </div>

        </div>

    </div>

</div>
    <!-- Card 2 - Es Teh Manis -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="minuman" data-name="Es Teh Manis Segar" data-price="6000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-100 to-cyan-100">
            <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800" alt="Es Teh" class="w-full h-full object-cover hover:scale-110 transition duration-500">
            <div class="absolute top-3 left-3 bg-white/95 rounded-full px-2 py-1 text-xs font-bold"><i class="fas fa-star text-yellow-500"></i> 4.7</div>
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Es Teh Manis Segar</h4>
            <p class="text-gray-500 text-sm mb-2">Teh melati dengan rasa gula aren, es batu premium.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp6.000</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 3 - Mie Ayam Ceker -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="makanan_berat" data-name="Mie Ayam Ceker" data-price="18000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-orange-100 to-red-100">
            <img src="https://images.unsplash.com/photo-1605460375641-2eb7a2b48f2a?w=800" alt="Mie Ayam" class="w-full h-full object-cover hover:scale-110 transition duration-500">
            <div class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                <i class="fas fa-fire"></i> Spesial
            </div>
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Mie Ayam Ceker</h4>
            <p class="text-gray-500 text-sm mb-2">Mie kenyal, ayam kecap, pangsit, dan ceker gurih.</p>
            <div class="flex items-center gap-2">
                <span class="text-2xl font-black text-[#1f285a]">Rp18.000</span>
                <span class="bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">Favorit</span>
            </div>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 4 - Keripik Singkong -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="makanan_ringan" data-name="Keripik Singkong Pedas" data-price="7500">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-yellow-100 to-amber-100">
            <img src="https://images.unsplash.com/photo-1619027477005-54a1d7c312ac?w=800" alt="Keripik" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Keripik Singkong Pedas</h4>
            <p class="text-gray-500 text-sm mb-2">Renyah, balado pedas, cocok untuk camilan.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp7.500</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 5 - Es Coklat Kekinian -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="minuman" data-name="Es Coklat Kekinian" data-price="12000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-brown-100 to-amber-100">
            <img src="https://images.unsplash.com/photo-1536935338788-846bb9981813?w=800" alt="Coklat" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Es Coklat Kekinian</h4>
            <p class="text-gray-500 text-sm mb-2">Coklat bubuk + whipped cream, topping boba.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp12.000</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 6 - Bakso Urat -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="makanan_berat" data-name="Bakso Urat Super" data-price="22000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-stone-200">
            <img src="https://images.unsplash.com/photo-1583756936331-78af5ad1e3d1?w=800" alt="Bakso" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Bakso Urat Super</h4>
            <p class="text-gray-500 text-sm mb-2">Bakso sapi urat + mie kuning, kuah gurih.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp22.000</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 7 - Pisang Goreng -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="makanan_ringan" data-name="Pisang Goreng Madu" data-price="10000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-yellow-100 to-orange-100">
            <img src="https://images.unsplash.com/photo-1601052451609-6cde4ba1e58d?w=800" alt="Pisang Goreng" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Pisang Goreng Madu</h4>
            <p class="text-gray-500 text-sm mb-2">Pisang goreng crispy dengan topping madu dan keju.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp10.000</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <!-- Card 8 - Es Jeruk Peras -->
    <div class="menu-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-category="minuman" data-name="Es Jeruk Peras" data-price="8000">
        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-green-100 to-lime-100">
            <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800" alt="Es Jeruk" class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-4">
            <h4 class="font-extrabold text-gray-800 text-lg mb-1">Es Jeruk Peras</h4>
            <p class="text-gray-500 text-sm mb-2">Jeruk segar peras asli dengan es batu.</p>
            <span class="text-2xl font-black text-[#1f285a]">Rp8.000</span>
            <button class="btn-cart mt-3 w-full bg-[#1f285a] hover:bg-[#661a15] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>
</div>

<!-- Promo Banner -->
<div class="mt-10 bg-gradient-to-r from-[#1f285a]/5 to-[#661a15]/5 rounded-2xl p-5 border border-[#661a15]/20 flex flex-col md:flex-row justify-between items-center gap-4 shadow-md">
    <div class="flex items-center gap-4">
        <div class="bg-white rounded-full w-12 h-12 flex items-center justify-center shadow-md">
            <i class="fas fa-ticket-alt text-2xl text-[#f1a80a]"></i>
        </div>
        <div>
            <h4 class="font-bold text-[#1f285a] text-lg">Diskon Student Day!</h4>
            <p class="text-sm text-gray-600">Setiap Jumat, cashback 10% untuk semua menu.</p>
        </div>
    </div>
    <button class="bg-white border-2 border-[#f1a80a] text-[#f1a80a] font-bold px-5 py-2 rounded-xl shadow-md hover:bg-[#f1a80a] hover:text-white transition">
        Klaim Voucher <i class="fas fa-gift ml-1"></i>
    </button>
</div>

<!-- JavaScript untuk Filter & Cart -->
<script>
// Filter Kategori Menu
const filterButtons = document.querySelectorAll('.category-filter');
const menuCards = document.querySelectorAll('.menu-card');
let cartCount = 0;
const cartBadge = document.querySelector('.cart-badge');
const bottomCartBadge = document.querySelector('.cart-badge-bottom');

filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        filterButtons.forEach(b => {
            b.classList.remove('active-cat', 'bg-[#1f285a]', 'text-white');
            b.classList.add('bg-gray-100', 'text-gray-700');
        });
        btn.classList.add('active-cat', 'bg-[#1f285a]', 'text-white');
        btn.classList.remove('bg-gray-100', 'text-gray-700');
        
        const category = btn.getAttribute('data-cat');
        
        menuCards.forEach(card => {
            if(category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'block';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 200);
            }
        });
    });
});

// Tombol Tambah ke Keranjang
const cartButtons = document.querySelectorAll('.btn-cart');
cartButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check-circle"></i> Ditambahkan!';
        btn.classList.add('bg-green-600', 'scale-95');
        
        cartCount++;
        if(cartBadge) {
            cartBadge.textContent = cartCount;
            cartBadge.classList.add('animate-bounce');
            setTimeout(() => {
                cartBadge.classList.remove('animate-bounce');
            }, 500);
        }
        if(bottomCartBadge) {
            bottomCartBadge.textContent = cartCount;
        }
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('bg-green-600', 'scale-95');
        }, 800);
        
        // Get menu info
        const card = btn.closest('.menu-card');
        const menuName = card.getAttribute('data-name');
        const menuPrice = card.getAttribute('data-price');
        console.log(`Added to cart: ${menuName} - Rp${menuPrice}`);
    });
});

// Filter Stan Kantin
const stanItems = document.querySelectorAll('.stan-item, .active-stan');
stanItems.forEach(stan => {
    stan.addEventListener('click', () => {
        stanItems.forEach(s => {
            s.classList.remove('border-2', 'border-[#661a15]/30', 'shadow-md');
            s.classList.add('shadow-sm');
        });
        stan.classList.add('border-2', 'border-[#661a15]/30', 'shadow-md');
        
        const stanName = stan.getAttribute('data-stan') || 'koperasi';
        console.log(`Selected stan: ${stanName}`);
    });
});

// Line clamp utility
document.querySelectorAll('.line-clamp-2').forEach(el => {
    if (!el.style.display) {
        el.style.display = '-webkit-box';
        el.style.webkitLineClamp = '2';
        el.style.webkitBoxOrient = 'vertical';
        el.style.overflow = 'hidden';
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

@include('layouts.navigation.customer.bottom')