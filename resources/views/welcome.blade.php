<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Digital SMK - Clean & Modern Illustration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#fafafa] text-[#1f285a] antialiased overflow-x-hidden">

    <header class="w-full bg-white border-b border-gray-100 px-6 lg:px-16 py-4 relative z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SMK" class="w-9 h-9 object-contain">
                <span class="font-extrabold text-xl tracking-tight">Foo<span class="text-[#661a15]">dy</span></span>
            </div>
            
            <div class="hidden md:flex items-center gap-8 font-bold text-sm text-gray-600">
                <a href="#" class="text-[#1f285a] hover:text-[#661a15] transition">Pesan Makanan</a>
                <a href="#menu" class="hover:text-[#661a15] transition">Menu</a>
                <a href="#tentang" class="hover:text-[#661a15] transition">Tentang Kami</a>
                <a href="#kontak" class="hover:text-[#661a15] transition">Kontak</a>
            </div>
        </div>
    </header>

    <section class="relative bg-white pt-2 pb-20 lg:pt-4 lg:pb-28 overflow-hidden border-b border-gray-50">
        
        <div class="absolute top-0 left-0 right-0 h-[380px] md:h-[480px] bg-[#d9d9d9]/60 rounded-b-[40px] md:rounded-b-[80px] z-0"></div>
        
        <div class="absolute -top-16 -left-12 w-64 h-64 md:w-[450px] md:h-[450px] bg-[#1f285a] rounded-full z-0"></div>
        
        <div class="absolute top-24 -right-16 w-56 h-72 md:w-[380px] md:h-[480px] bg-[#661a15] rounded-[100px] z-0 rotate-12"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-16 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            
            <div class="lg:col-span-6 lg:order-2 flex justify-center items-center relative mt-4 lg:mt-0">
                <div class="absolute -bottom-6 w-[120%] h-24 bg-white rounded-t-[100px] blur-sm hidden lg:block"></div>
                
                <img src="{{ asset('images/melamun.png') }}" alt="Ilustrasi Utama" 
                     class="w-full max-w-[340px] md:max-w-[420px] h-auto object-contain drop-shadow-lg relative z-10 transform hover:scale-[1.02] transition duration-500">
            </div>

            <div class="lg:col-span-6 lg:order-1 space-y-6 text-center lg:text-left -mt-6 lg:-mt-10">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#1f285a] leading-[1.2] tracking-tight">
                    Kendalikan Perut <br class="hidden sm:inline">
                    <span class="text-[#661a15]">Anda</span>
                </h1>
                <p class="text-gray-500 text-sm sm:text-base max-w-md mx-auto lg:mx-0 leading-relaxed font-medium">
                    Pesan yang anda inginkan dari kantin sekolah jadi lebih mudah lewat genggaman jari Anda tanpa perlu mengantre.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-4 bg-[#1f285a] hover:bg-[#661a15] text-white font-extrabold rounded-full shadow-lg shadow-[#1f285a]/20 transition-all duration-300 text-center tracking-wide">
                        Mulai
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section class="py-16 bg-[#fafafa] border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-16 text-center">
            <h2 class="text-2xl md:text-3xl font-black text-[#1f285a] mb-12">Kenapa memilih Foody?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center text-center group">
                    <div class="w-40 h-28 flex items-center justify-center mb-6 transition transform group-hover:scale-105 duration-300">
                        <img src="{{ asset('images/order.png') }}" alt="Easy To Order" class="h-full object-contain">
                    </div>
                    <h4 class="font-extrabold text-lg text-[#1f285a] mb-2">Mudah di pesan</h4>
                    <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
                        Anda hanya perlu beberapa langkah untuk memesan makanan.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-40 h-28 flex items-center justify-center mb-6 transition transform group-hover:scale-105 duration-300">
                        <img src="{{ asset('images/mengantar.png') }}" alt="Fastest Delivery" class="h-full object-contain">
                    </div>
                    <h4 class="font-extrabold text-lg text-[#1f285a] mb-2">Pengiriman Tercepat</h4>
                    <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
                        Pengiriman yang selalu tepat waktu, kini lebih cepat.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-40 h-28 flex items-center justify-center mb-6 transition transform group-hover:scale-105 duration-300">
                        <img src="{{ asset('images/memasak.png') }}" alt="Best Quality" class="h-full object-contain">
                    </div>
                    <h4 class="font-extrabold text-lg text-[#1f285a] mb-2">Kualitas Terbaik</h4>
                    <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
                        Bagi kami, bukan hanya kecepatan, tetapi kualitas juga yang utama.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto text-center px-6 space-y-6">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1f285a] tracking-tight">
                Santai saja di kelas, <br>
                <span class="text-[#f1a80a]">pesananmu akan kami siapkan.</span>
            </h2>
            <p class="text-gray-400 text-xs sm:text-sm leading-relaxed max-w-xl mx-auto font-medium">
                Sistem pintar terintegrasi yang memudahkan pemesanan makanan sehat tanpa harus membuang waktu istirahat yang berharga untuk berdesakan di depan meja stan.
            </p>
        </div>
    </section>

    <section id="menu" class="py-16 bg-[#fafafa]">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-12">
                <h3 class="text-2xl font-black text-[#1f285a]">Jelajahi Kantin Kami</h3>
            </div>

           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-[28px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/40 transition duration-300">
        <div class="bg-[#fcf4f4] rounded-[22px] overflow-hidden h-48 mb-4 relative">
            <img src="{{ asset('images/kantin-berkah.png') }}" alt="Kantin Berkah" class="w-full h-full object-cover">
        </div>
        
        <div class="px-2 pb-2">
            <h4 class="font-extrabold text-xl text-[#1f285a] tracking-tight mb-1">Kantin Berkah</h4>
            
            <span class="block text-sm font-semibold text-gray-400 mb-4">± Rp 5.000 - Rp 15.000</span>
            
            <div class="flex flex-wrap gap-2">
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Makanan Berat</span>
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Makanan Ringan</span>
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Minuman</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[28px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/40 transition duration-300">
        <div class="bg-[#fefaf0] rounded-[22px] overflow-hidden h-48 mb-4 relative">
            <img src="{{ asset('images/warung-janti.png') }}" alt="Warung Janti" class="w-full h-full object-cover">
        </div>
        
        <div class="px-2 pb-2">
            <h4 class="font-extrabold text-xl text-[#1f285a] tracking-tight mb-1">Warung Bu Janti</h4>
            <span class="block text-sm font-semibold text-gray-400 mb-4">± Rp 3.000 - Rp 10.000</span>
            
            <div class="flex flex-wrap gap-2">
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Gorengan</span>
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Snack</span>
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Minuman Dingin</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[28px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/40 transition duration-300">
        <div class="bg-[#f4f6fa] rounded-[22px] overflow-hidden h-48 mb-4 relative">
            <img src="{{ asset('images/kantin-sehat.png') }}" alt="Kantin Sehat" class="w-full h-full object-cover">
        </div>
        
        <div class="px-2 pb-2">
            <h4 class="font-extrabold text-xl text-[#1f285a] tracking-tight mb-1">Jajanan Sehat</h4>
            <span class="block text-sm font-semibold text-gray-400 mb-4">± Rp 4.000 - Rp 12.000</span>
            
            <div class="flex flex-wrap gap-2">
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Aneka Jus</span>
                <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Salad Buah</span>
            </div>
        </div>
    </div>
</div>
</section>

   <footer id="kontak" class="bg-[#1f285a] text-white pt-16 pb-8 border-t border-navy-900/20">
    <div class="max-w-7xl mx-auto px-6 lg:px-16 grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-white/10">
        
        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-xl bg-[#661a15] flex items-center justify-center font-black text-sm text-[#f1a80a]">F</div>
                <span class="font-black text-xl tracking-tight text-white">Foo<span class="text-[#f1a80a]">dy</span></span>
            </div>
            <p class="text-xs text-slate-300/80 font-medium leading-relaxed max-w-sm">
                Platform digital kantin sekolah terpercaya demi efisiensi waktu istirahat dan pemantauan gizi sehat menyeluruh bagi siswa.
            </p>
        </div>

        <div class="space-y-4">
            <h6 class="font-extrabold text-xs text-[#f1a80a] uppercase tracking-widest">Jam Operasional</h6>
            <div class="space-y-2">
                <p class="text-sm font-bold text-white">Senin - Jumat</p>
                <p class="text-xs text-slate-300/80 font-medium">07:00 - 15:00 WIB</p>
                <p class="text-xs text-slate-400 font-medium italic mt-1">*Mengikuti jam istirahat sekolah</p>
            </div>
        </div>

        <div class="space-y-4">
            <h6 class="font-extrabold text-xs text-[#f1a80a] uppercase tracking-widest">Bantuan & Akses</h6>
            <ul class="space-y-2.5 text-xs font-semibold text-slate-300/90">
                <li>
                    <a href="#menu" class="hover:text-[#f1a80a] transition duration-200 flex items-center gap-1.5 group">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#661a15] group-hover:bg-[#f1a80a] transition"></span>
                        Jelajahi Daftar Kantin
                    </a>
                </li>
                <li>
                    <a href="#tentang" class="hover:text-[#f1a80a] transition duration-200 flex items-center gap-1.5 group">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#661a15] group-hover:bg-[#f1a80a] transition"></span>
                        Tentang Layanan Kami
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-[#f1a80a] transition duration-200 flex items-center gap-1.5 group">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#661a15] group-hover:bg-[#f1a80a] transition"></span>
                        Hubungi IT Support Sekolah
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center max-w-7xl mx-auto px-6 lg:px-16 pt-8 text-xs text-slate-400 font-medium gap-4">
        <div>
            &copy; 2026 <span class="text-white font-bold">Foody Kantin Digital</span>. Hak Cipta Dilindungi Undang-Undang.
        </div>
        <div class="flex gap-4 text-slate-400/60">
            <span class="text-[10px] uppercase tracking-wider bg-white/5 px-2.5 py-1 rounded-md text-slate-300">v1.0-Beta</span>
        </div>
    </div>
</footer>

</body>
</html>