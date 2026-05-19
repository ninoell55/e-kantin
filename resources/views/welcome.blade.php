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
                <h3 class="text-2xl font-black text-[#1f285a]">Jelajahi Menu Kami</h3>
                <div class="flex flex-wrap gap-2 text-xs font-bold text-gray-500">
                    <button class="px-4 py-2 bg-[#1f285a] text-white rounded-xl shadow-sm">Semua</button>
                    <button class="px-4 py-2 bg-white border border-gray-100 rounded-xl hover:bg-gray-50 transition">Makanan</button>
                    <button class="px-4 py-2 bg-white border border-gray-100 rounded-xl hover:bg-gray-50 transition">Camilan</button>
                    <button class="px-4 py-2 bg-white border border-gray-100 rounded-xl hover:bg-gray-50 transition">Minuman</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-[24px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="bg-gray-50 rounded-2xl overflow-hidden h-44 mb-4">
                            <img src="{{ asset('images/login.png') }}" alt="Menu" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] bg-red-50 text-[#661a15] font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wide">Makanan Utama</span>
                        <h4 class="font-extrabold text-base text-[#1f285a] mt-2 px-0.5">Nasi Ayam Saus Mentega</h4>
                    </div>
                    <div class="flex justify-between items-center mt-6 pt-3 border-t border-gray-50 px-0.5">
                        <span class="font-black text-lg text-[#1f285a]">Rp 15.000</span>
                        <button class="px-4 py-2 bg-[#1f285a] text-white text-xs font-extrabold rounded-xl hover:bg-[#661a15] transition">Pesan</button>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="bg-gray-50 rounded-2xl overflow-hidden h-44 mb-4">
                            <img src="{{ asset('images/login.png') }}" alt="Menu" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] bg-amber-50 text-[#f1a80a] font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wide">Camilan</span>
                        <h4 class="font-extrabold text-base text-[#1f285a] mt-2 px-0.5">Dimsum Ayam Kukus Segar</h4>
                    </div>
                    <div class="flex justify-between items-center mt-6 pt-3 border-t border-gray-50 px-0.5">
                        <span class="font-black text-lg text-[#1f285a]">Rp 10.000</span>
                        <button class="px-4 py-2 bg-[#1f285a] text-white text-xs font-extrabold rounded-xl hover:bg-[#661a15] transition">Pesan</button>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] border border-gray-100 p-4 hover:shadow-xl hover:shadow-gray-200/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="bg-gray-50 rounded-2xl overflow-hidden h-44 mb-4">
                            <img src="{{ asset('images/login.png') }}" alt="Menu" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] bg-blue-50 text-blue-500 font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wide">Minuman</span>
                        <h4 class="font-extrabold text-base text-[#1f285a] mt-2 px-0.5">Es Jeruk Nipis Madu Alami</h4>
                    </div>
                    <div class="flex justify-between items-center mt-6 pt-3 border-t border-gray-50 px-0.5">
                        <span class="font-black text-lg text-[#1f285a]">Rp 6.000</span>
                        <button class="px-4 py-2 bg-[#1f285a] text-white text-xs font-extrabold rounded-xl hover:bg-[#661a15] transition">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-16 grid grid-cols-1 md:grid-cols-3 gap-10 pb-12 border-b border-gray-100">
            <div class="space-y-4">
                <span class="font-extrabold text-lg text-[#1f285a]">Foo<span class="text-[#661a15]">dy</span></span>
                <p class="text-xs text-gray-400 font-medium leading-relaxed">Platform pemesanan bekal terpercaya demi efisiensi dan kesehatan menyeluruh lingkungan sekolah.</p>
            </div>
            <div class="space-y-3">
                <h6 class="font-extrabold text-xs text-gray-400 uppercase tracking-wider">Layanan Jam Istirahat</h6>
                <p class="text-xs text-gray-500 font-semibold">Senin - Jumat: 07:00 - 15:00 WIB</p>
            </div>
            <div class="space-y-3">
                <h6 class="font-extrabold text-xs text-gray-400 uppercase tracking-wider">Akses Cepat</h6>
                <p class="text-xs text-gray-500 font-semibold">Hubungi Teknisi Informasi Sekolah</p>
            </div>
        </div>
        <div class="text-center pt-8 text-xs text-gray-400 font-medium">
            &copy; 2026 Kantin Digital SMK. Hak Cipta Dilindungi Undang-Undang.
        </div>
    </footer>

</body>
</html>