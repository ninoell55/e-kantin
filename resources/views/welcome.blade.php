<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Kantin | SMKN 1 Cirebon</title>

    <!-- Memanggil file CSS & JS menggunakan Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-tertiary font-bebas text-xl">
                        EK
                    </div>
                    <span class="font-bebas text-2xl tracking-wide text-primary mt-1">E-KANTIN <span
                            class="text-secondary">SMEA</span></span>
                </div>

                <!-- Login / Register Button -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-sm font-semibold text-primary hover:text-secondary transition-colors">
                                Ke Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-5 py-2 text-sm font-semibold text-white bg-primary rounded-full hover:bg-primary/90 transition-all shadow-md">
                                Masuk (Login)
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="grow pt-16">

        <!-- Hero Section -->
        <section class="relative bg-primary overflow-hidden">
            <!-- Dekorasi Background -->
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 100 100"
                    preserveAspectRatio="none">
                    <polygon fill="currentColor" points="0,100 100,0 100,100" />
                </svg>
            </div>

            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10 flex flex-col items-center text-center">
                <span
                    class="px-4 py-1.5 rounded-full bg-white/10 text-tertiary text-sm font-semibold tracking-wider mb-6 border border-white/20">
                    🚀 Inovasi Digital SMKN 1 Cirebon
                </span>

                <!-- Font Bebas Neue untuk Headline agar tegas dan tebal -->
                <h1 class="text-5xl md:text-7xl font-bebas text-white tracking-wide mb-6 leading-tight">
                    Jajan Bebas Antre, <br>
                    <span class="text-tertiary">Istirahat Lebih Santai.</span>
                </h1>

                <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto mb-10 font-inter">
                    Pesan makanan langsung dari kelas, bayar pakai QR atau tunai, dan tinggal ambil pesananmu saat bel
                    istirahat berbunyi.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}"
                        class="px-8 py-3.5 text-base font-bold text-primary bg-tertiary rounded-full hover:bg-yellow-400 hover:scale-105 transition-transform duration-300 shadow-lg shadow-tertiary/30">
                        Pesan Sekarang
                    </a>
                    <a href="#how-it-works"
                        class="px-8 py-3.5 text-base font-bold text-white bg-white/10 border border-white/20 rounded-full hover:bg-white/20 transition-colors">
                        Lihat Cara Kerja
                    </a>
                </div>
            </div>
        </section>

        <!-- Cara Kerja Section -->
        <section id="how-it-works" class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bebas text-primary tracking-wide">Tiga Langkah Mudah</h2>
                    <div class="w-24 h-1 bg-tertiary mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-shadow">
                        <div
                            class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Pilih Menu Lapak</h3>
                        <p class="text-slate-500 text-sm">Cari makanan favoritmu dari berbagai stand kantin yang sedang
                            buka hari ini.</p>
                    </div>

                    <!-- Step 2 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-shadow">
                        <div
                            class="w-16 h-16 bg-tertiary/20 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Bayar Praktis</h3>
                        <p class="text-slate-500 text-sm">Pilih metode pembayaran tunai saat ambil pesanan, atau
                            langsung transfer QR.</p>
                    </div>

                    <!-- Step 3 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-shadow">
                        <div
                            class="w-16 h-16 bg-secondary/10 text-secondary rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Langsung Ambil</h3>
                        <p class="text-slate-500 text-sm">Pantau status pesananmu. Jika sudah "Siap", langsung bawa
                            pulang tanpa antre bayar.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Carousel / Banner Promo Placeholder -->
        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl font-bold text-primary mb-2">Stand Kantin Pilihan</h2>
                <p class="text-slate-500 mb-8 text-sm">Temukan berbagai jajanan lezat dari kantin sekolah kita.</p>

                <!-- Tempat Tim Frontend Mengerjakan Carousel/Grid Gambar -->
                <div
                    class="w-full h-48 md:h-64 bg-slate-200 rounded-2xl border border-slate-300 flex items-center justify-center border-dashed">
                    <p class="text-slate-400 font-inter">[ Area Carousel Stand Kantin / Banner Promo ]</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-primary pt-12 pb-8 border-t-4 border-tertiary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="font-bebas text-3xl tracking-wider mb-4">
                E-KANTIN <span class="text-tertiary">SMEA</span>
            </div>
            <p class="text-slate-400 text-sm mb-8">
                Sistem Pemesanan Digital Terintegrasi SMKN 1 Cirebon. <br>
                Membantu efisiensi waktu istirahat siswa dan manajemen operasional kantin.
            </p>
            <div class="text-slate-500 text-xs border-t border-white/10 pt-8">
                &copy; {{ date('Y') }} Tim Developer E-Kantin. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>

</html>
