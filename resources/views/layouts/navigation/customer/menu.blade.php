
<!DOCTYPE html>
<html lang="id">
<head>
  <style>
    html{
      scroll-behavior: smooth;
    }
  </style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Kantin SMEA</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#1E2A78',
          secondary: '#FFC928',
          dark: '#111827',
          graylight: '#E5E7EB',
          danger: '#730f00',
        },
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        }
      }
    }
  }
</script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swpap" rel="stylesheet">
<style>
  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
</head>
<body class="bg-slate-100 font-sans min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white px-4 md:px-10 py-3 flex justify-between items-center shadow-sm sticky top-0 z-50">
    <div class="flex items-center gap-2.5">
      <div class="bg-primary text-secondary w-9 h-9 md:w-11 md:h-11 rounded-xl flex items-center justify-center font-bold text-sm md:text-lg flex-shrink-0">EK</div>
      <h2 class="font-bold text-base md:text-xl tracking-wide">
        <span class="text-primary">E-KANTIN</span> <span class="text-danger">SMEA</span>
      </h2>
    </div>
    <div class="flex items-center gap-2">
      <input type="text" placeholder="Cari makanan..." class="hidden md:block px-4 py-2.5 rounded-xl border border-gray-200 w-56 outline-none focus:border-primary text-sm transition-all">
      <button class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-primary text-lg">🔍</button>
<a href="{{ route('customer.cart') }}">
  <button class="bg-primary text-white px-3 md:px-5 py-2 md:py-2.5 rounded-xl font-semibold text-xs md:text-sm transition-all flex items-center gap-1.5">
      🛒 <span class="hidden sm:inline">Keranjang</span>
      <span class="bg-secondary text-primary text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
        {{ collect(session('cart', []))->sum('qty') }}
   </span>
  </button>
</a>
    </div>
  </nav>

  <!-- Hero -->
  <div class="bg-primary text-white px-5 md:px-12 py-10 md:py-20">
    <div class="max-w-2xl mx-auto text-center">
      <span class="inline-block bg-secondary/20 text-secondary text-xs font-semibold px-3 py-1 rounded-full mb-3 tracking-wide">🏫 SMEA Kantin Digital</span>
      <h1 class="text-2xl md:text-5xl font-bold mb-3 leading-snug">
        Jajan Bebas Antre, <br class="md:hidden"><span class="text-secondary">Istirahat Lebih Santai.</span>
      </h1>
      <p class="text-sm md:text-lg leading-relaxed opacity-80 mt-3">
        Pesan dari kelas, bayar pakai QR atau tunai, tinggal ambil saat bel istirahat berbunyi.
      </p>
      <div class="flex gap-3 justify-center mt-6">
        <button class="bg-secondary text-primary font-bold px-5 py-2.5 rounded-xl text-sm hover:brightness-105 transition-all">Pesan Sekarang</button>
        <button class="border border-white/30 text-white font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-white/10 transition-all">Lihat Menu</button>
      </div>
    </div>
  </div>

  <!-- Stand Kantin -->
  <div class="pt-7 pb-2">
    <div class="flex justify-between items-center px-4 md:px-10 mb-4">
      <h2 class="text-primary font-bold text-base md:text-xl">Stand Kantin Hari Ini</h2>
      <span class="text-xs text-gray-400 font-medium">Geser untuk lihat semua →</span>
    </div>

    <div class="flex gap-4 overflow-x-auto no-scrollbar px-4 md:px-10 pb-3">

    @foreach ($shops as $shop )
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex-shrink-0 w-60 md:w-72 active:scale-95 transition-transform">
        <div class="h-36 md:h-44 overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=800&auto=format&fit=crop" alt="Stand Bu Rina" class="w-full h-full object-cover">
         
          @if ($shop->is_open==1)
          <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">● Buka</span>
          @else
          <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">X&nbsp;&nbsp; Tutup</span>
          @endif
          

        </div>
        <div class="p-4">
          <h3 class="font-semibold text-dark text-sm mb-1">{{ $shop->name }}</h3>
          <p class="text-gray-400 text-xs leading-relaxed mb-3">{{ $shop->description }}</p>
          <div class="flex gap-1.5 flex-wrap mb-3">
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍜 Mie</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍲 Bakso</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🥤 Es</span>
          </div>
           @if ($shop->is_open==1)
          <a href="#menu-grid"><button class="w-full bg-primary text-white py-2.5 rounded-xl text-xs font-semibold">Lihat Menu</button></a>
          @else
          <button disabled class="w-full bg-gray-100 text-gray-400 py-2.5 rounded-xl text-xs font-semibold cursor-not-allowed">Sedang Tutup</button>
          @endif
        </div>
      </div>
    @endforeach

      <!-- //Stand 1 - Buka 
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex-shrink-0 w-60 md:w-72 active:scale-95 transition-transform">
        <div class="h-36 md:h-44 overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=800&auto=format&fit=crop" alt="Stand Bu Rina" class="w-full h-full object-cover">
          <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">● Buka</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-dark text-sm mb-1">Stand Bu Rina</h3>
          <p class="text-gray-400 text-xs leading-relaxed mb-3">Mie ayam, bakso, nasi goreng & minuman segar.</p>
          <div class="flex gap-1.5 flex-wrap mb-3">
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍜 Mie</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍲 Bakso</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🥤 Es</span>
          </div>
          <button class="w-full bg-primary text-white py-2.5 rounded-xl text-xs font-semibold">Lihat Menu</button>
        </div>
      </div>

       //Stand 2 - Tutup
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex-shrink-0 w-60 md:w-72 opacity-75">
        <div class="h-36 md:h-44 overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop" alt="Stand Minuman" class="w-full h-full object-cover grayscale">
          <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">● Tutup</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-dark text-sm mb-1">Stand Minuman Dingin</h3>
          <p class="text-gray-400 text-xs leading-relaxed mb-3">Es coklat, thai tea, kopi susu & minuman segar.</p>
          <div class="flex gap-1.5 flex-wrap mb-3">
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🧋 Thai Tea</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍫 Coklat</span>
          </div>
          <button disabled class="w-full bg-gray-100 text-gray-400 py-2.5 rounded-xl text-xs font-semibold cursor-not-allowed">Sedang Tutup</button>
        </div>
      </div>

      // Stand 3 - Buka
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex-shrink-0 w-60 md:w-72 active:scale-95 transition-transform">
        <div class="h-36 md:h-44 overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=800&auto=format&fit=crop" alt="Stand Pak Joko" class="w-full h-full object-cover">
          <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">● Buka</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-dark text-sm mb-1">Stand Pak Joko</h3>
          <p class="text-gray-400 text-xs leading-relaxed mb-3">Burger, roti bakar & aneka snack crispy favorit.</p>
          <div class="flex gap-1.5 flex-wrap mb-3">
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍔 Burger</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍞 Roti</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍟 Snack</span>
          </div>
          <button class="w-full bg-primary text-white py-2.5 rounded-xl text-xs font-semibold">Lihat Menu</button>
        </div>
      </div>

      // Stand 4 - Buka
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex-shrink-0 w-60 md:w-72 active:scale-95 transition-transform">
        <div class="h-36 md:h-44 overflow-hidden relative">
          <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=800&auto=format&fit=crop" alt="Stand Bu Sari" class="w-full h-full object-cover">
          <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">● Buka</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-dark text-sm mb-1">Stand Bu Sari</h3>
          <p class="text-gray-400 text-xs leading-relaxed mb-3">Nasi bungkus, lauk pauk lengkap & sayur segar.</p>
          <div class="flex gap-1.5 flex-wrap mb-3">
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🍱 Nasi</span>
            <span class="bg-slate-100 text-dark text-xs px-2.5 py-1 rounded-full">🥘 Lauk</span>
          </div>
          <button class="w-full bg-primary text-white py-2.5 rounded-xl text-xs font-semibold">Lihat Menu</button>
        </div>
      </div>-->
    </div>
  </div>

  <!-- Category Filter -->
  <div class="flex gap-2 overflow-x-auto no-scrollbar px-4 md:px-10 py-5">
    <button onclick="setActive(this)" class="category-btn flex-shrink-0 px-4 py-2 rounded-full bg-secondary text-primary font-semibold text-xs transition-all">Semua</button>
    <button onclick="setActive(this)" class="category-btn flex-shrink-0 px-4 py-2 rounded-full bg-white text-dark font-semibold text-xs shadow-sm transition-all">Makanan</button>
    <button onclick="setActive(this)" class="category-btn flex-shrink-0 px-4 py-2 rounded-full bg-white text-dark font-semibold text-xs shadow-sm transition-all">Minuman</button>
    <button onclick="setActive(this)" class="category-btn flex-shrink-0 px-4 py-2 rounded-full bg-white text-dark font-semibold text-xs shadow-sm transition-all">Snack</button>
    <button onclick="setActive(this)" class="category-btn flex-shrink-0 px-4 py-2 rounded-full bg-white text-dark font-semibold text-xs shadow-sm transition-all">🔥 Terlaris</button>
  </div>

  <!-- Menu Grid -->
  <div class="px-4 md:px-10 pb-28" id="menu-grid">
    <h2 class="text-primary font-bold text-base md:text-xl mb-4">Menu Tersedia</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6">

    @foreach ($products as $product)
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=600&auto=format&fit=crop" alt="Mie Ayam" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-primary/10 text-primary px-2 py-0.5 rounded-full">{{$product->category->name}}</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">{{ $product->name }}</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">RP {{ number_format($product->price) }}</p>
          <p class="text-gray-400 text-xs mb-3">{{ $product->shop->name }}</p>
          <div class="flex justify-between items-center">
            @if ($product->is_available && $product->shop->is_open)
            <span class="text-green-600 font-semibold text-xs">● Ada</span>

            <form action="{{ url('customer/cart/add/'.$product->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
            </form>

            @else
            <span class="text-red-600 font-semibold text-xs">X &nbsp; &nbsp; Tidak ada</span>
            <button disabled class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded-xl text-xs font-semibold cursor-not-allowed">Tidak ada</button>
            @endif
            
          </div>
        </div>
      </div>
    @endforeach
      <!-- Card 1 
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=600&auto=format&fit=crop" alt="Mie Ayam" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-primary/10 text-primary px-2 py-0.5 rounded-full">Makanan</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Mie Ayam Special</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp12.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Bu Rina</p>
          <div class="flex justify-between items-center">
            <span class="text-green-600 font-semibold text-xs">● Ada</span>
            <button class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
          </div>
        </div>
      </div>

       Card 2
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop" alt="Burger" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-secondary/20 text-dark px-2 py-0.5 rounded-full">Snack</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Burger Crispy</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp15.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Pak Joko</p>
          <div class="flex justify-between items-center">
            <span class="text-green-600 font-semibold text-xs">● Ada</span>
            <button class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
          </div>
        </div>
      </div>

      Card 3
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?q=80&w=600&auto=format&fit=crop" alt="Minuman" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Minuman</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Es Coklat Jumbo</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp8.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Minuman</p>
          <div class="flex justify-between items-center">
            <span class="text-green-600 font-semibold text-xs">● Ada</span>
            <button class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
          </div>
        </div>
      </div>

      Card 4 
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=600&auto=format&fit=crop" alt="Nasi Goreng" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-primary/10 text-primary px-2 py-0.5 rounded-full">Makanan</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Nasi Goreng Spesial</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp13.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Bu Rina</p>
          <div class="flex justify-between items-center">
            <span class="text-green-600 font-semibold text-xs">● Ada</span>
            <button class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
          </div>
        </div>
      </div>

       Card 5 
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1582878826629-29b7ad1cdc43?q=80&w=600&auto=format&fit=crop" alt="Bakso" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-primary/10 text-primary px-2 py-0.5 rounded-full">Makanan</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Bakso Jumbo</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp10.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Bu Rina</p>
          <div class="flex justify-between items-center">
            <span class="text-red-500 font-semibold text-xs">● Habis</span>
            <button disabled class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded-xl text-xs font-semibold cursor-not-allowed">Habis</button>
          </div>
        </div>
      </div>

       Card 6
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm active:scale-95 md:hover:-translate-y-1.5 md:hover:shadow-md transition-all">
        <div class="h-32 md:h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=600&auto=format&fit=crop" alt="Thai Tea" class="w-full h-full object-cover">
        </div>
        <div class="p-3 md:p-5">
          <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Minuman</span>
          <h3 class="font-semibold text-dark text-sm mt-1.5 mb-0.5">Thai Tea Original</h3>
          <p class="text-secondary font-bold text-base md:text-xl mb-0.5">Rp9.000</p>
          <p class="text-gray-400 text-xs mb-3">Stand Minuman</p>
          <div class="flex justify-between items-center">
            <span class="text-green-600 font-semibold text-xs">● Ada</span>
            <button class="bg-primary text-white px-3 py-1.5 rounded-xl text-xs font-semibold">+ Pesan</button>
          </div>
        </div>
      </div>

    </div>
  </div>
-->

  <!-- Floating Cart -->
<a href="{{ route('customer.cart') }}">
  <div class="fixed bottom-5 right-5 bg-secondary text-primary w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center text-2xl shadow-xl cursor-pointer hover:scale-110 active:scale-95 transition-transform z-50">
      🛒
  </div>
</a>

<script>
  function setActive(btn) {
    document.querySelectorAll('.category-btn').forEach(b => {
      b.classList.remove('bg-secondary', 'text-primary');
      b.classList.add('bg-white', 'text-dark');
    });
    btn.classList.add('bg-secondary', 'text-primary');
    btn.classList.remove('bg-white', 'text-dark');
  }
</script>
</body>
</html>