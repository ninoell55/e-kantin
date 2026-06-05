@extends('layouts.app')

@section('title', 'Foody - E-Kantin SMKN 1 Cirebon')

@section('content')
    <div class="w-full bg-gray-50 text-gray-800">

        <nav
            class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
            <!-- Layout edge-to-edge full width dengan padding horizontal konsisten -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">
                <div class="flex items-center justify-between h-16 sm:h-20 w-full">

                    <!-- Logo Brand -->
                    <div class="flex items-center gap-3 shrink-0">
                        <div
                            class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-linear-to-br from-primary to-secondary shadow-lg shadow-(--color-primary)/20">

                            <i class="ti ti-bowl-spoon text-white text-2xl"></i>

                            <!-- Accent -->
                            <div class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-tertiary border-2 border-white">
                            </div>
                        </div>

                        <div class="flex flex-col leading-none">
                            <span class="text-2xl font-black tracking-tight text-primary">
                                Foody
                            </span>
                            <span class="text-[10px] font-medium tracking-tighter text-gray-500">
                                E-Kantin SMKN 1 Cirebon
                            </span>
                        </div>
                    </div>

                    <!-- Navigation Links (Desktop: Tampak dari md ke atas) -->
                    <div class="hidden md:flex items-center lg:space-x-8 md:space-x-6 text-sm font-semibold">
                        <a href="#" class="text-secondary transition-colors duration-200">Halaman Utama</a>
                        <a href="#menu" class="text-gray-600 hover:text-secondary transition-colors duration-200">Menu
                            Populer</a>
                        <a href="#kantin" class="text-gray-600 hover:text-secondary transition-colors duration-200">Mitra
                            Kantin</a>
                    </div>

                    <!-- Action Buttons (Desktop: Masuk / Mulai Order) -->
                    <div class="hidden md:flex items-center space-x-4 shrink-0">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                                    class="w-full sm:w-auto text-center px-5 py-2.5 font-bold text-white bg-secondary rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:shadow-xl hover:-translate-y-0.5">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full sm:w-auto text-center px-10 py-4 font-bold text-white bg-primary rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:shadow-xl hover:-translate-y-0.5">
                                    Login
                                </a>
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Menu Button (Hanya tampak di bawah screen md) -->
                    <div class="flex md:hidden items-center">
                        <button type="button" onclick="toggleMobileMenu()"
                            class="p-2 rounded-xl text-primary hover:bg-gray-50 focus:outline-none transition-colors duration-200"
                            aria-label="Toggle Menu">
                            <i id="menu-icon" class="ti ti-menu-2 text-2xl"></i>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile Drawer Menu (Tutup secara default, gunakan JS toggle kelas 'hidden') -->
            <div id="mobile-menu"
                class="hidden md:hidden w-full bg-white border-t border-gray-100 px-4 py-4 space-y-3 shadow-lg absolute left-0 top-full">
                <div class="flex flex-col space-y-1">
                    <a href="#" onclick="toggleMobileMenu()"
                        class="block px-4 py-2.5 text-sm font-bold text-secondary bg-secondary/5 rounded-xl">Halaman
                        Utama</a>
                    <a href="#menu" onclick="toggleMobileMenu()"
                        class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:text-secondary hover:bg-gray-50 rounded-xl transition-colors">Menu
                        Populer</a>
                    <a href="#kantin" onclick="toggleMobileMenu()"
                        class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:text-secondary hover:bg-gray-50 rounded-xl transition-colors">Mitra
                        Kantin</a>
                </div>

                <div class="pt-3 border-t border-gray-100 flex flex-col gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                                class="w-full sm:w-auto text-center px-10 py-4 font-bold text-white bg-secondary rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:shadow-xl hover:-translate-y-0.5">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto text-center px-10 py-4 font-bold text-white bg-primary rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:shadow-xl hover:-translate-y-0.5">
                                Login
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <script>
            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                const icon = document.getElementById('menu-icon');

                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    icon.classList.remove('ti-menu-2');
                    icon.classList.add('ti-x'); // Ubah icon jadi silang (close)
                } else {
                    menu.classList.add('hidden');
                    icon.classList.remove('ti-x');
                    icon.classList.add('ti-menu-2'); // Kembalikan ke hamburger icon
                }
            }
        </script>

        <header class="relative w-full bg-white pt-8 pb-14 lg:pt-16 lg:pb-24 border-b border-gray-100">
            <!-- Mengubah container menjadi w-full tanpa batasan max-w, menggunakan padding horizontal responsif agar tetap rapi di ujung layar -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center w-full">

                    <!-- Hero Left: Text & Call to Actions -->
                    <div class="lg:col-span-7 flex flex-col justify-center text-center lg:text-left space-y-6 w-full">

                        <!-- Scaling font size untuk memanfaatkan layar lebar secara optimal -->
                        <h1
                            class="text-4xl sm:text-5xl md:text-6xl xl:text-7xl font-extrabold text-primary tracking-tight leading-none">
                            Pesan Makanan Kantin <br class="hidden sm:inline">
                            <span class="text-secondary">Jadi Lebih Mudah</span>
                        </h1>

                        <!-- Menghilangkan max-w-xl agar teks memanfaatkan ruang horizontal secara penuh -->
                        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-full leading-relaxed">
                            Nikmati kemudahan memesan makanan dan minuman favoritmu di kantin sekolah tanpa perlu mengantre.
                            Lebih cepat, praktis, dan higienis langsung dari genggamanmu!
                        </p>

                        <div
                            class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2 w-full">
                            <a href="#menu"
                                class="w-full sm:w-auto text-center px-10 py-4 font-bold text-white bg-primary rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:shadow-xl hover:-translate-y-0.5">
                                Mulai Pesan
                            </a>
                            <a href="#kantin"
                                class="w-full sm:w-auto text-center px-10 py-4 font-bold text-primary bg-white border-2 border-gray-200 rounded-xl transition-all duration-300 hover:border-primary hover:bg-gray-50">
                                Lihat Kantin
                            </a>
                        </div>

                        <!-- Menghilangkan max-w-md agar grid statistik melebar penuh mengikuti kolom kiri -->
                        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-100 w-full">
                            <div class="text-center lg:text-left">
                                <span class="block text-2xl sm:text-3xl md:text-4xl font-extrabold text-primary">12+</span>
                                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider block mt-1">Jumlah
                                    Kantin</span>
                            </div>
                            <div class="text-center lg:text-left">
                                <span class="block text-2xl sm:text-3xl font-bold text-secondary md:text-4xl">150+</span>
                                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider block mt-1">Menu
                                    Aktif</span>
                            </div>
                            <div class="text-center lg:text-left">
                                <span class="block text-2xl sm:text-3xl font-bold text-tertiary md:text-4xl">5K+</span>
                                <span
                                    class="text-xs text-gray-500 font-semibold uppercase tracking-wider block mt-1">Pesanan
                                    Selesai</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Right: Dynamic Full-Width Illustration -->
                    <div class="lg:col-span-5 relative flex justify-center items-center mt-8 lg:mt-0 w-full">
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-tertiary/20 to-secondary/10 rounded-full blur-3xl filter -z-10">
                        </div>
                        <!-- Mengubah max-w-sm/md menjadi w-full penuh agar proporsional dengan layout kiri yang melebar -->
                        <div
                            class="relative w-full p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 transform hover:rotate-1 transition-transform duration-500">
                            <!-- Menyesuaikan tinggi gambar (h-96 sampai h-112) agar seimbang pada resolusi layar ultra-wide -->
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80"
                                alt="Ilustrasi Makanan Modern"
                                class="w-full h-64 sm:h-80 lg:h-96 xl:h-112 object-cover rounded-xl shadow-inner">
                            <div
                                class="absolute -bottom-4 left-4 sm:left-8 bg-white p-4 rounded-xl shadow-lg border border-gray-50 flex items-center space-x-3 z-10">
                                <div class="p-2 bg-tertiary rounded-lg text-primary">
                                    <i class="ti ti-flame text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Menu Terpopuler</p>
                                    <p class="text-sm font-bold text-primary">Nasi Ayam Geprek Skanic</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <section class="w-full py-12 lg:py-20 bg-white border-b border-gray-50">
            <!-- Menggunakan padding horizontal yang konsisten dengan konsep full-width hero sebelumnya -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">

                <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-16">
                    <span class="text-sm font-bold tracking-widest text-secondary uppercase">Sederhana & Ringkas</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-primary mt-2">Cara Kerja Foody</h2>
                    <p class="text-gray-600 mt-3 text-sm sm:text-base">Selesaikan pesananmu hanya dalam empat langkah mudah
                        dari smartphone.</p>
                </div>

                <!-- Perubahan Utama: Menggunakan grid-cols-2 dari ukuran terkecil (mobile), lalu naik ke lg:grid-cols-4 -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 relative w-full">

                    <!-- Card 1: Pilih Kantin -->
                    <div
                        class="relative bg-gray-50 p-5 sm:p-6 rounded-2xl border border-gray-100 group transition-all duration-300 hover:bg-white hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-primary flex items-center justify-center text-white mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="ti ti-building-store text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-primary mb-2">Pilih Kantin</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Cari dan pilih stan kantin atau
                                vendor favoritmu di lingkungan sekolah.</p>
                        </div>
                        <span
                            class="absolute top-4 right-4 sm:top-6 sm:right-6 text-2xl sm:text-3xl font-black text-gray-200 group-hover:text-tertiary transition-colors duration-300">01</span>
                    </div>

                    <!-- Card 2: Pilih Menu -->
                    <div
                        class="relative bg-gray-50 p-5 sm:p-6 rounded-2xl border border-gray-100 group transition-all duration-300 hover:bg-white hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-secondary flex items-center justify-center text-white mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="ti ti-tools-kitchen-2 text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-primary mb-2">Pilih Menu</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Jelajahi daftar menu makanan dan
                                minuman lezat yang tersedia hari ini.</p>
                        </div>
                        <span
                            class="absolute top-4 right-4 sm:top-6 sm:right-6 text-2xl sm:text-3xl font-black text-gray-200 group-hover:text-tertiary transition-colors duration-300">02</span>
                    </div>

                    <!-- Card 3: Bayar -->
                    <div
                        class="relative bg-gray-50 p-5 sm:p-6 rounded-2xl border border-gray-100 group transition-all duration-300 hover:bg-white hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-tertiary flex items-center justify-center text-primary mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="ti ti-wallet text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-primary mb-2">Bayar</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Gunakan metode pembayaran tunai
                                langsung atau scan QR Personal vendor.</p>
                        </div>
                        <span
                            class="absolute top-4 right-4 sm:top-6 sm:right-6 text-2xl sm:text-3xl font-black text-gray-200 group-hover:text-secondary transition-colors duration-300">03</span>
                    </div>

                    <!-- Card 4: Ambil / Diantar -->
                    <div
                        class="relative bg-gray-50 p-5 sm:p-6 rounded-2xl border border-gray-100 group transition-all duration-300 hover:bg-white hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-primary flex items-center justify-center text-white mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="ti ti-package text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-primary mb-2">Ambil / Diantar</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Ambil langsung ke stan atau gunakan
                                opsi kirim ke ruang kelas/guru.</p>
                        </div>
                        <span
                            class="absolute top-4 right-4 sm:top-6 sm:right-6 text-2xl sm:text-3xl font-black text-gray-200 group-hover:text-tertiary transition-colors duration-300">04</span>
                    </div>

                </div>
            </div>
        </section>

        <section class="w-full py-12 lg:py-20 bg-gray-50 border-b border-gray-100">
            <!-- Menggunakan layout edge-to-edge full width dengan padding horizontal responsif yang sinkron -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">

                <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-16">
                    <span class="text-sm font-bold tracking-widest text-primary uppercase">Mengapa Memilih Kami</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-primary mt-2">Keunggulan Aplikasi Foody</h2>
                    <p class="text-gray-600 mt-3 text-sm sm:text-base">Sistem e-kantin modern yang dirancang khusus untuk
                        kenyamanan ekosistem sekolah.</p>
                </div>

                <!-- Mengubah struktur grid agar menampilkan 2 kolom di mobile/smartphone (grid-cols-2),
                                                                                                                                         lalu otomatis bertransformasi menjadi 3 kolom di layar besar (lg:grid-cols-3) -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 w-full">

                    <!-- Keunggulan 1 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-primary/10 text-primary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-clock text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Hemat Waktu</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Pesan sebelum jam istirahat tiba,
                                makanan langsung siap tanpa antre panjang.</p>
                        </div>
                    </div>

                    <!-- Keunggulan 2 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-secondary/10 text-secondary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-device-mobile text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Pesan dari Mana Saja</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Akses menu dan lakukan pemesanan
                                langsung dari area kelas maupun lapangan olahraga.</p>
                        </div>
                    </div>

                    <!-- Keunggulan 3 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-tertiary/20 text-primary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-credit-card text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Pembayaran Fleksibel</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Mendukung pembayaran langsung di
                                tempat (Cash) maupun transfer QR Digital.</p>
                        </div>
                    </div>

                    <!-- Keunggulan 4 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-primary/10 text-primary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-door text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Antar ke Ruangan</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Layanan kurir khusus internal untuk
                                mengirim pesanan langsung ke kelas atau ruang guru.</p>
                        </div>
                    </div>

                    <!-- Keunggulan 5 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-secondary/10 text-secondary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-bell-ringing text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Status Real-time</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Pantau perkembangan status
                                makananmu
                                mulai dari diproses hingga siap diambil.</p>
                        </div>
                    </div>

                    <!-- Keunggulan 6 -->
                    <div
                        class="flex flex-col sm:flex-row items-start p-5 sm:p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md w-full">
                        <div class="p-2.5 sm:p-3 bg-tertiary/20 text-primary rounded-xl mb-3 sm:mb-0 sm:mr-4 shrink-0">
                            <i class="ti ti-building-store text-xl sm:text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1">Banyak Pilihan Kantin</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">Tersedia beragam stan penjual
                                hidangan utama, camilan ringan, hingga minuman segar.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="menu" class="w-full py-12 lg:py-20 bg-white border-b border-gray-50" x-data="{ openLoginModal: false }">
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">

                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4 w-full">
                    <div>
                        <span class="text-sm font-bold tracking-widest text-secondary uppercase">Paling Banyak
                            Dicari</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-primary mt-1">Menu Terfavorit Hari Ini</h2>
                    </div>
                    <a href="{{ route('customer.dashboard') }}"
                        class="inline-flex items-center space-x-1 text-sm font-bold text-secondary hover:underline group shrink-0">
                        <span>Lihat Semua Menu</span>
                        <i class="ti ti-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 w-full">
                    @foreach ($products as $product)
                        {{-- Cek apakah user sudah login --}}
                        @auth
                            {{-- Jika login, arahkan langsung ke dashboard --}}
                            <a href="{{ route('customer.dashboard') }}"
                                class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl w-full">
                            @else
                                {{-- Jika belum, buka modal --}}
                                <button @click="openLoginModal = true" type="button"
                                    class="text-left block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl w-full">
                                @endauth

                                <div class="relative w-full h-36 sm:h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @if ($product->is_available)
                                        <span
                                            class="absolute top-2 right-2 sm:top-4 sm:right-4 px-2.5 py-0.5 sm:px-3 sm:py-1 text-[10px] sm:text-xs font-bold bg-tertiary text-primary rounded-full shadow-sm">
                                            <i class="ti ti-check inline mr-0.5 sm:mr-1"></i>Tersedia
                                        </span>
                                    @endif
                                </div>

                                <div class="p-4 sm:p-5 flex flex-col grow">
                                    <span
                                        class="text-[10px] sm:text-xs font-medium text-gray-400 mb-1 block line-clamp-1">{{ $product->shop->name }}</span>
                                    <h3 class="text-sm sm:text-lg font-bold text-primary line-clamp-1 mb-1 sm:mb-2">
                                        {{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3 sm:mb-4 hidden sm:block">
                                        {{ $product->description }}</p>
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mt-auto pt-2.5 sm:pt-3 border-t border-gray-50">
                                        <span class="text-sm sm:text-lg font-black text-secondary">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span
                                            class="w-full sm:w-auto px-4 py-2 text-xs font-bold text-white bg-primary rounded-lg text-center">Pesan</span>
                                    </div>
                                </div>
                                @auth </a>
                        @else
                        </button> @endauth
                    @endforeach
                </div>
            </div>

            <div x-show="openLoginModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                x-cloak>
                <div @click.away="openLoginModal = false"
                    class="bg-white rounded-2xl p-6 sm:p-8 max-w-sm w-full shadow-xl">
                    <h3 class="text-xl font-bold text-primary mb-2">Login Diperlukan</h3>
                    <p class="text-gray-600 text-sm mb-6">Silakan login ke akun Anda untuk melanjutkan pemesanan menu.</p>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('login') }}"
                            class="w-full py-3 bg-primary text-white text-center font-bold rounded-lg hover:bg-opacity-90">Login
                            Sekarang</a>
                        <button @click="openLoginModal = false"
                            class="w-full py-3 bg-gray-100 text-primary font-bold rounded-lg">Nanti Saja</button>
                    </div>
                </div>
            </div>
        </section>

        <section id="kantin" class="w-full py-12 lg:py-20 bg-gray-50 border-b border-gray-100"
            x-data="{ openLoginModal: false }">
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">

                <div class="text-center max-w-3xl mx-auto mb-10">
                    <span class="text-sm font-bold tracking-widest text-primary uppercase">Mitra Stan Sekolah</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-primary mt-2">Daftar Kantin Terpercaya</h2>
                    <p class="text-sm sm:text-base text-gray-600 mt-3">Deretan merchant kantin higienis yang siap melayani
                        kebutuhan makan sehatmu.</p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 w-full">
                    @foreach ($shops as $shop)
                        {{-- Logic Arahkan ke dashboard jika login, buka modal jika belum --}}
                        @auth
                            <a href="{{ route('customer.shop.show', $shop) }}"
                                class="block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col group transition-all duration-300 hover:shadow-xl w-full">
                            @else
                                <button @click="openLoginModal = true" type="button"
                                    class="text-left block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col group transition-all duration-300 hover:shadow-xl w-full">
                                @endauth

                                <div class="relative h-32 sm:h-64 bg-gray-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $shop->banner_path) }}" alt="{{ $shop->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                                    <div
                                        class="absolute top-2 right-2 sm:top-4 sm:right-4 {{ $shop->is_open ? 'bg-emerald-500' : 'bg-gray-500' }} text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-full shadow-md">
                                        {{ $shop->is_open ? 'Buka' : 'Tutup' }}
                                    </div>
                                </div>

                                <div class="p-4 sm:p-6 flex flex-col grow">
                                    <h3 class="text-sm sm:text-xl font-bold text-primary mb-1 line-clamp-1">
                                        {{ $shop->name }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mb-4 line-clamp-2 min-h-[2rem] sm:min-h-0">
                                        {{ $shop->description ?? 'Tidak ada deskripsi tersedia.' }}
                                    </p>

                                    <div
                                        class="flex items-center pt-3 sm:pt-4 border-t border-gray-100 text-[11px] sm:text-sm font-semibold mt-auto">
                                        <span class="text-gray-600 flex items-center">
                                            <i class="ti ti-salad text-secondary mr-1"></i>{{ $shop->products_count }}
                                            Menu
                                        </span>
                                    </div>
                                </div>
                                @auth </a>
                        @else
                        </button> @endauth
                    @endforeach
                </div>
            </div>

            <div x-show="openLoginModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                x-cloak>
                <div @click.away="openLoginModal = false"
                    class="bg-white rounded-2xl p-6 sm:p-8 max-w-sm w-full shadow-xl">
                    <h3 class="text-xl font-bold text-primary mb-2">Login Diperlukan</h3>
                    <p class="text-gray-600 text-sm mb-6">Silakan login untuk melihat detail kantin dan melakukan
                        pemesanan.</p>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('login') }}"
                            class="w-full py-3 bg-primary text-white text-center font-bold rounded-lg hover:bg-opacity-90">Login
                            Sekarang</a>
                        <button @click="openLoginModal = false"
                            class="w-full py-3 bg-gray-100 text-primary font-bold rounded-lg">Nanti Saja</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full py-12 lg:py-20 bg-white border-b border-gray-50">
            <!-- Layout edge-to-edge full width dengan padding horizontal konsisten -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center w-full">

                    <!-- Kolom Kiri: Teks Deskripsi & Checklists -->
                    <div class="w-full">
                        <span class="text-sm font-bold tracking-widest text-secondary uppercase">Fungsionalitas
                            Premium</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-primary mt-2 mb-4 sm:mb-6">Layanan Fleksibel
                            Sesuai Kebutuhanmu</h2>
                        <p class="text-sm sm:text-base text-gray-600 mb-6 leading-relaxed">
                            Kami mengerti dinamika aktivitas sekolah yang padat. Oleh karena itu, Foody menyediakan opsi
                            distribusi dan transaksi yang aman demi mendukung kelancaran kegiatan belajar mengajar.
                        </p>

                        <!-- Checklist Fitur -->
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-5 h-5 bg-tertiary rounded-full flex items-center justify-center text-primary text-[10px] sm:text-xs shrink-0">
                                    <i class="ti ti-check font-bold"></i>
                                </div>
                                <span class="text-sm sm:text-base font-medium text-primary">Sistem integrasi tanpa
                                    hambatan</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-5 h-5 bg-tertiary rounded-full flex items-center justify-center text-primary text-[10px] sm:text-xs shrink-0">
                                    <i class="ti ti-check font-bold"></i>
                                </div>
                                <span class="text-sm sm:text-base font-medium text-primary">Keamanan transaksi tunai &
                                    non-tunai terjamin</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-5 h-5 bg-tertiary rounded-full flex items-center justify-center text-primary text-[10px] sm:text-xs shrink-0">
                                    <i class="ti ti-check font-bold"></i>
                                </div>
                                <span class="text-sm sm:text-base font-medium text-primary">Dukungan penuh tim OSIS
                                    sekolah</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Grid Fitur Layanan (Mobile diubah ke grid-cols-2 agar presisi dan tidak makan space vertikal) -->
                    <div class="grid grid-cols-2 gap-4 sm:gap-6 w-full">

                        <!-- Fitur 1: Pickup -->
                        <div
                            class="bg-gray-50 p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col group transition-all duration-300 hover:bg-white hover:shadow-xl w-full">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-primary text-white flex items-center justify-center mb-3 sm:mb-4 shrink-0">
                                <i class="ti ti-walk text-lg sm:text-xl"></i>
                            </div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1 sm:mb-2 line-clamp-1">Ambil Sendiri
                                (Pickup)</h3>
                            <p
                                class="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-3 sm:line-clamp-none">
                                Pesan online, pantau status masak, lalu datang ambil langsung ke stan vendor pas bel
                                berbunyi.</p>
                        </div>

                        <!-- Fitur 2: Delivery -->
                        <div
                            class="bg-gray-50 p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col group transition-all duration-300 hover:bg-white hover:shadow-xl w-full">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-secondary text-white flex items-center justify-center mb-3 sm:mb-4 shrink-0">
                                <i class="ti ti-truck-delivery text-lg sm:text-xl"></i>
                            </div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1 sm:mb-2 line-clamp-1">Layanan Antar
                                (Delivery)</h3>
                            <p
                                class="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-3 sm:line-clamp-none">
                                Mager keluar kelas? Manfaatkan opsi pengantaran langsung oleh petugas kurir ke lokasimu.</p>
                        </div>

                        <!-- Fitur 3: Cash -->
                        <div
                            class="bg-gray-50 p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col group transition-all duration-300 hover:bg-white hover:shadow-xl w-full">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-tertiary text-primary flex items-center justify-center mb-3 sm:mb-4 shrink-0">
                                <i class="ti ti-coins text-lg sm:text-xl"></i>
                            </div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1 sm:mb-2 line-clamp-1">Bayar Tunai
                                (Cash)</h3>
                            <p
                                class="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-3 sm:line-clamp-none">
                                Fleksibel bayar cash langsung di tempat stan kantin ketika serah terima pesanan berlangsung.
                            </p>
                        </div>

                        <!-- Fitur 4: QR Personal -->
                        <div
                            class="bg-gray-50 p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col group transition-all duration-300 hover:bg-white hover:shadow-xl w-full">
                            <!-- Icon disesuaikan menggunakan warna bg-primary agar skema warna tetap seimbang (2 primary, 1 secondary, 1 tertiary) -->
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-primary text-white flex items-center justify-center mb-3 sm:mb-4 shrink-0">
                                <i class="ti ti-qrcode text-lg sm:text-xl"></i>
                            </div>
                            <h3 class="text-sm sm:text-lg font-bold text-primary mb-1 sm:mb-2 line-clamp-1">QR Personal
                            </h3>
                            <p
                                class="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-3 sm:line-clamp-none">
                                Unggah atau tunjukkan bukti transaksi pembayaran lewat QR transfer dompet digital vendor.
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="w-full bg-primary py-16 lg:py-24 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-linear(#fbbf24_1px,transparent_1px)] bg-size-[16px_16px]">
            </div>

            <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                    Tunggu Apa Lagi? <br>
                    Gabung Bersama Foody Skanic Sekarang!
                </h2>
                <p class="text-base sm:text-lg text-gray-200 max-w-2xl mx-auto leading-relaxed">
                    Buat akun belajarmu hari ini untuk merasakan kemudahan revolusi bertransaksi kuliner modern di
                    lingkungan sekolah SMKN 1 Cirebon.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    {{-- Link Daftar ke WhatsApp Admin --}}
                    {{-- Pastikan $adminPhone sudah dikirim dari Controller atau ganti dengan angka string --}}
                    <a href="https://wa.me/{{ $adminPhone ?? '6287740864657' }}?text=Halo%20Admin,%20saya%20ingin%20mendaftar%20akun%20Foody%20Skanic"
                        target="_blank"
                        class="w-full sm:w-auto text-center px-8 py-4 font-bold text-primary bg-tertiary rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
                        Daftar Akun Baru
                    </a>

                    {{-- Link Login --}}
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto text-center px-8 py-4 font-bold text-white bg-secondary rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
                        Masuk (Login)
                    </a>
                </div>
            </div>
        </section>

        <footer class="w-full bg-white border-t border-gray-100 text-gray-600">
            <!-- Layout edge-to-edge full width dengan padding horizontal konsisten -->
            <div class="w-full px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20 py-12">

                <!-- Grid Links & Info: Menggunakan format grid adaptif yang rapi dari mobile ke desktop -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-8 md:gap-6 lg:gap-8 items-start w-full">

                    <!-- Kolom 1: Branding & Deskripsi (Lebar 5 kolom di desktop) -->
                    <div class="sm:col-span-2 md:col-span-5 space-y-4">
                        <!-- Logo Brand -->
                        <div class="flex items-center gap-3 shrink-0">
                            <div
                                class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-linear-to-br from-primary to-secondary shadow-lg shadow-(--color-primary)/20">

                                <i class="ti ti-bowl-spoon text-white text-2xl"></i>

                                <!-- Accent -->
                                <div
                                    class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-tertiary border-2 border-white">
                                </div>
                            </div>

                            <div class="flex flex-col leading-none">
                                <span class="text-2xl font-black tracking-tight text-primary">
                                    Foody
                                </span>
                                <span class="text-[10px] font-medium tracking-tighter text-gray-500">
                                    E-Kantin SMKN 1 Cirebon
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-gray-500 max-w-sm leading-relaxed">
                            Sistem platform e-kantin pintar inovatif buatan siswa Jurusan Rekayasa Perangkat Lunak untuk
                            peradaban sekolah digital mandiri.
                        </p>
                    </div>

                    <!-- Kolom 2: Tautan Cepat (Lebar 3 kolom di desktop) -->
                    <div class="md:col-span-3 space-y-3">
                        <h4 class="text-xs sm:text-sm font-bold text-primary uppercase tracking-wider">Tautan Cepat</h4>
                        <ul class="space-y-2 text-xs sm:text-sm font-medium">
                            <li>
                                <a href="#"
                                    class="text-gray-500 hover:text-secondary transition-colors duration-200 block py-0.5">Halaman
                                    Utama</a>
                            </li>
                            <li>
                                <a href="#menu"
                                    class="text-gray-500 hover:text-secondary transition-colors duration-200 block py-0.5">Menu
                                    Populer</a>
                            </li>
                            <li>
                                <a href="#kantin"
                                    class="text-gray-500 hover:text-secondary transition-colors duration-200 block py-0.5">Mitra
                                    Kantin</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Media Sosial & Info Kontak (Lebar 4 kolom di desktop) -->
                    <div class="md:col-span-4 space-y-4">
                        <h4 class="text-xs sm:text-sm font-bold text-primary uppercase tracking-wider">Media Sosial Kami
                        </h4>
                        <div class="flex items-center space-x-2.5 sm:space-x-3">
                            <a href="https://www.instagram.com/foody.skanic/" target="_blank"
                                class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-primary border border-gray-100 transition-all duration-200 hover:bg-primary hover:text-white hover:border-primary"
                                aria-label="Instagram">
                                <i class="ti ti-brand-instagram text-lg"></i>
                            </a>
                            <a href="https://www.facebook.com/foody.skanic" target="_blank"
                                class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-primary border border-gray-100 transition-all duration-200 hover:bg-primary hover:text-white hover:border-primary"
                                aria-label="Facebook">
                                <i class="ti ti-brand-facebook text-lg"></i>
                            </a>
                            <a href="https://twitter.com/foody_skanic" target="_blank"
                                class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-primary border border-gray-100 transition-all duration-200 hover:bg-primary hover:text-white hover:border-primary"
                                aria-label="Twitter">
                                <i class="ti ti-brand-twitter text-lg"></i>
                            </a>
                            <a href="https://github.com/foody-skanic" target="_blank"
                                class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-primary border border-gray-100 transition-all duration-200 hover:bg-primary hover:text-white hover:border-primary"
                                aria-label="GitHub">
                                <i class="ti ti-brand-github text-lg"></i>
                            </a>
                        </div>
                        <p class="text-[11px] sm:text-xs text-gray-400 max-w-xs leading-relaxed">
                            Hubungi tim pengembang jika menemukan kendala sistem atau celah keamanan (bug).
                        </p>
                    </div>

                </div>

                <!-- Copyright & Credits Section -->
                <div
                    class="mt-12 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between text-[11px] sm:text-xs text-gray-400 gap-3 text-center sm:text-left">
                    <p>&copy; 2026 Foody E-Kantin SMKN 1 Cirebon. All rights reserved.</p>
                    <p class="font-medium text-gray-500">Dikembangkan oleh Tim Siswa Sukses RPL Skanic</p>
                </div>

            </div>
        </footer>

    </div>
@endsection
