@extends('layouts.vendor')

@section('content')
    {{-- Container Benar-benar Full Screen (Edge-to-Edge) --}}
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34">

        {{-- Top Bar / Header Lapak dengan Clean Breadcrumb --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Dashboard --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="text-gray-400 font-black flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </span>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d]">Dashboard</span>
                </nav>

                {{-- Judul Nama Lapak --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2 leading-none">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    {{ $shop->name ?? 'Lapak Dagangan' }}
                </h1>
            </div>

            {{-- Info Status & Tanggal / Minimalist Counter Badge --}}
            <div
                class="flex items-center gap-3 bg-gray-50/80 border border-gray-200/40 px-4 py-2.5 rounded-2xl w-full md:w-auto justify-between md:justify-start">
                <div class="w-8 h-8 rounded-xl bg-[#1b2563]/10 text-[#1b2563] flex items-center justify-center">
                    <i class="ti ti-calendar text-sm"></i>
                </div>
                <div class="flex flex-col invisible md:visible md:flex">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Hari Ini</span>
                    <span class="text-xs font-black text-gray-900 mt-0.5 leading-none whitespace-nowrap">
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- MAIN LAYOUT: Grid Sistem yang Membelah Sempurna di Layar Lebar --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            {{-- PANEL KIRI: Kontrol Keuangan & Status Toko (Lebar 1 Kolom) --}}
            <div class="lg:col-span-1 space-y-4">

                {{-- Card Saldo / Dompet (Modern Tech Gradient) --}}
                <div
                    class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#1e2a5e] via-[#162048] to-[#0f1635] p-6 shadow-xl shadow-blue-950/10 border border-white/5 group min-h-[150px] flex flex-col justify-between">
                    {{-- Aksen Dekorasi Cahaya --}}
                    <div
                        class="absolute -right-6 -top-6 w-32 h-32 bg-gradient-to-br from-[#ffc61a]/20 to-transparent rounded-full blur-2xl pointer-events-none transition-transform duration-500 group-hover:scale-125">
                    </div>
                    <div
                        class="absolute -left-10 -bottom-10 w-28 h-28 bg-red-500/10 rounded-full blur-2xl pointer-events-none">
                    </div>

                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-3">
                            <div
                                class="bg-gradient-to-tr from-[#ffc61a] to-[#ffe066] p-2.5 rounded-2xl shadow-lg shadow-[#ffc61a]/20 transform group-hover:rotate-6 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#7c2d12]" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd"
                                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="text-white/50 text-[10px] uppercase font-black tracking-widest block leading-none">E-Kantin
                                    Wallet</span>
                                <span class="text-white text-xs font-bold mt-1 block">Saldo Dompet</span>
                            </div>
                        </div>
                        <span
                            class="text-[9px] bg-white/10 text-white/80 font-bold px-2 py-1 rounded-lg border border-white/10 backdrop-blur-sm">IDR</span>
                    </div>

                    <div class="mt-6 relative z-10 flex items-end justify-between">
                        <div>
                            <p
                                class="w-full text-white font-black text-2xl md:text-3xl tracking-tight bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                                {{-- DIUBAH DI SINI: Menggunakan $totalBalance hasil query sum orders --}}
                                Rp {{ number_format($totalBalance, 0, ',', '.') }}
                            </p>
                            <p class="text-white/40 text-[9px] uppercase tracking-widest font-bold mt-1">Sisa Dana Lapak
                                Siap Cair</p>
                        </div>
                        <div
                            class="text-white/10 group-hover:text-[#ffc61a]/20 text-5xl font-black transition-colors duration-300">
                            <i class="ti ti-wallet"></i>
                        </div>
                    </div>
                </div>

                {{-- Card Saklar Buka/Tutup Toko (State-Driven Dynamic Background) --}}
                <div id="shop-card-bg"
                    class="p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between {{ $shop->is_open ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white' : 'bg-gradient-to-br from-gray-800 to-slate-900 text-white' }}">
                    {{-- Decorative Background Glow --}}
                    <div
                        class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none transition-all duration-500 group-hover:scale-125">
                    </div>

                    <div class="flex justify-between items-center w-full relative z-10">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-60">Sistem Kantin</span>
                        </div>

                        {{-- Status Pill Indicator --}}
                        <div id="status-badge-container"
                            class="flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 {{ $shop->is_open ? 'bg-white/20 border-white/20' : 'bg-white/10 border-white/10' }}">
                            <span class="relative flex h-2 w-2">
                                <span id="dot-ping"
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $shop->is_open ? 'bg-white' : 'bg-red-400' }}"></span>
                                <span id="dot-solid"
                                    class="relative inline-flex rounded-full h-2 w-2 {{ $shop->is_open ? 'bg-white' : 'bg-red-500' }}"></span>
                            </span>
                            <span id="status-label" class="text-[10px] font-black uppercase tracking-wider text-white">
                                {{ $shop->is_open ? 'Buka' : 'Tutup' }}
                            </span>
                        </div>
                    </div>

                    {{-- Bagian Kontrol Switch Utama --}}
                    <div class="flex items-center justify-between pt-4 relative z-10">
                        <div class="max-w-[70%]">
                            <p id="shop-status-text" class="text-base font-black tracking-wide uppercase drop-shadow-sm">
                                {{ $shop->is_open ? 'Menerima Pesanan' : 'Lapak Beristirahat' }}
                            </p>
                            <p id="shop-status-desc" class="text-white/60 text-[10px] mt-0.5 leading-tight">
                                {{ $shop->is_open ? 'Pelanggan bisa memesan menu makanan.' : 'Menu disembunyikan sementara dari siswa.' }}
                            </p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" id="toggle-shop-status" class="sr-only peer"
                                {{ $shop->is_open ? 'checked' : '' }}>
                            {{-- Track Switch High Contrast --}}
                            <div
                                class="w-14 h-8 bg-black/20 backdrop-blur-md rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all after:shadow-lg peer-checked:bg-white/30 shadow-inner">
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Card Performa Ringkas Hari Ini (High-End Dashboard Style) --}}
                <div
                    class="bg-white p-5 rounded-3xl border border-gray-100/80 shadow-md shadow-gray-100/30 relative overflow-hidden group">

                    {{-- Header Mini --}}
                    <div class="flex items-center justify-between pb-4 border-b border-gray-50 mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-3.5 bg-[#1e2a5e] rounded-full"></div>
                            <h3 class="text-gray-900 font-black text-[11px] uppercase tracking-widest">Aktivitas Hari Ini
                            </h3>
                        </div>
                        <div
                            class="flex items-center gap-1.5 bg-emerald-50 px-2.5 py-1 rounded-xl border border-emerald-100/60">
                            <span class="relative flex h-1.5 w-1.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                            </span>
                            <span
                                class="text-[9px] text-emerald-700 font-black uppercase tracking-widest leading-none">Live</span>
                        </div>
                    </div>

                    {{-- Grid Data Angka (Modern Layout dengan Ikon Terintegrasi) --}}
                    <div class="grid grid-cols-2 gap-3.5">

                        {{-- Item 1: Total Pesanan Masuk Hari Ini --}}
                        <div
                            class="p-4 rounded-2xl bg-gradient-to-br from-blue-50/40 via-white to-white border border-blue-50/80 flex flex-col justify-between min-h-[90px] relative overflow-hidden group/item shadow-sm shadow-blue-950/[0.01]">
                            <div class="flex justify-between items-start">
                                <span
                                    class="text-gray-400 text-[10px] font-bold uppercase tracking-wider block leading-tight">Pesanan<br>Masuk</span>
                                {{-- Icon Badge --}}
                                <div
                                    class="w-7 h-7 rounded-lg bg-[#1e2a5e]/5 text-[#1e2a5e] flex items-center justify-center transition-transform group-hover/item:scale-110">
                                    <i class="ti ti-receipt text-sm"></i>
                                </div>
                            </div>

                            <div class="flex items-baseline gap-1 mt-3 relative z-10">
                                <span class="text-[#1e2a5e] font-black text-2xl tracking-tight leading-none">
                                    {{ $todayOrdersCount ?? 0 }}
                                </span>
                                <span class="text-[10px] font-black uppercase tracking-wider text-[#1e2a5e]/40">Nota</span>
                            </div>
                        </div>

                        {{-- Item 2: Pesanan yang Sedang Diproses --}}
                        <div
                            class="p-4 rounded-2xl bg-gradient-to-br from-amber-50/40 via-white to-white border border-amber-50/80 flex flex-col justify-between min-h-[90px] relative overflow-hidden group/item shadow-sm shadow-amber-950/[0.01]">
                            <div class="flex justify-between items-start">
                                <span
                                    class="text-gray-400 text-[10px] font-bold uppercase tracking-wider block leading-tight">Sedang<br>Diproses</span>
                                {{-- Icon Badge --}}
                                <div
                                    class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-600 flex items-center justify-center transition-transform group-hover/item:scale-110">
                                    <i
                                        class="ti ti-tools-kitchen-2 text-sm {{ $processingOrdersCount > 0 ? 'animate-pulse' : '' }}"></i>
                                </div>
                            </div>

                            <div class="flex items-baseline gap-1 mt-3 relative z-10">
                                <span class="text-amber-600 font-black text-2xl tracking-tight leading-none">
                                    {{ $processingOrdersCount ?? 0 }}
                                </span>
                                <span
                                    class="text-[10px] font-black uppercase tracking-wider text-amber-600/40">Antrean</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- PANEL KANAN: Manajemen & Katalog Menu Utama dengan Filter Alpine.js --}}
            <div class="lg:col-span-3" x-data="{ activeCategory: 'semua' }">

                {{-- Sub Header Kontrol Atas --}}
                <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-5">

                    {{-- Navigasi Filter Minimalis Berfungsi Dinamis Menggunakan Alpine.js --}}
                    <div
                        class="flex gap-1.5 bg-gray-100/80 p-1.5 rounded-2xl w-full sm:w-auto overflow-x-auto no-scrollbar border border-gray-200/30">

                        <button type="button" @click="activeCategory = 'semua'"
                            class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                            :class="activeCategory === 'semua' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                                'text-gray-500 hover:text-gray-900 font-bold'">
                            Semua
                        </button>

                        <button type="button" @click="activeCategory = 'makanan'"
                            class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                            :class="activeCategory === 'makanan' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                                'text-gray-500 hover:text-gray-900 font-bold'">
                            Makanan
                        </button>

                        <button type="button" @click="activeCategory = 'minuman'"
                            class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                            :class="activeCategory === 'minuman' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                                'text-gray-500 hover:text-gray-900 font-bold'">
                            Minuman
                        </button>

                        <button type="button" @click="activeCategory = 'snack'"
                            class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                            :class="activeCategory === 'snack' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                                'text-gray-500 hover:text-gray-900 font-bold'">
                            Snack
                        </button>

                    </div>

                    {{-- Tombol Tambah Menu --}}
                    <a href="{{ route('vendor.product.create') }}"
                        class="w-full sm:w-auto px-5 py-3 bg-[#7f1d1d] hover:bg-[#661616] text-white rounded-2xl text-xs font-black shadow-md shadow-red-950/10 transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                        <i class="ti ti-plus text-sm"></i>
                        <span>Tambah Menu Baru</span>
                    </a>
                </div>

                {{-- AREA ETALASE UTAMA --}}
                @if (isset($products) && $products->count() > 0)
                    {{-- Grid Sempurna & Rapi Responsif --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach ($products as $index => $p)
                            @php
                                // Ambil nama kategori asli dari database lalu jadikan lowercase untuk filter Alpine
                                $pCategory = isset($p->category->name) ? strtolower($p->category->name) : 'semua';
                            @endphp

                            {{-- Card Item Di-handle oleh Alpine x-show --}}
                            <div x-show="activeCategory === 'semua' || activeCategory === '{{ $pCategory }}'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                class="bg-white border border-gray-100/80 rounded-3xl p-3 flex flex-col justify-between group hover:border-gray-200 hover:shadow-xl hover:shadow-gray-200/30 transition-all duration-300 relative">

                                {{-- LINK UTAMA: Nembus halaman show.blade.php tanpa tabrakan nesting tag HTML --}}
                                <a href="{{ route('vendor.product.show', $p->id) }}"
                                    class="absolute inset-0 z-10 rounded-3xl"
                                    aria-label="Lihat detail {{ $p->name }}"></a>

                                {{-- Frame Foto Menu --}}
                                <div
                                    class="w-full aspect-square bg-gray-50 rounded-2xl overflow-hidden relative shadow-inner group-hover:shadow-none transition-all duration-300">
                                    @if ($p->image_path)
                                        <img src="{{ asset('storage/' . $p->image_path) }}" alt="{{ $p->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div
                                            class="absolute inset-0 flex flex-col justify-between p-4 bg-gradient-to-b from-emerald-50/50 to-emerald-100/20">
                                            <div
                                                class="w-7 h-7 rounded-xl bg-white flex items-center justify-center text-emerald-600 shadow-sm">
                                                <i class="ti ti-cookie text-sm"></i>
                                            </div>
                                            <div class="w-full h-2.5 bg-emerald-400/40 rounded-full animate-pulse"></div>
                                        </div>
                                    @endif

                                    {{-- Tag Status Kategori Mini --}}
                                    <span
                                        class="absolute top-2 left-2 text-[8px] font-black uppercase tracking-wider bg-white/90 backdrop-blur-sm text-gray-500 px-2 py-0.5 rounded-md shadow-sm border border-gray-100 z-20">
                                        {{ $p->category->name ?? 'Menu' }}
                                    </span>

                                    {{-- Indikator Status Stok Habis --}}
                                    @if (!$p->is_available)
                                        <div
                                            class="absolute inset-0 bg-gray-950/40 backdrop-blur-[2px] flex items-center justify-center transition-all z-20">
                                            <span
                                                class="bg-red-600 text-white font-black text-[9px] px-2.5 py-1 rounded-xl uppercase tracking-widest shadow-md border border-red-500/30">
                                                Habis
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Informasi Menu Terbawah --}}
                                <div class="mt-3 px-1 flex flex-col flex-grow justify-between">
                                    <div>
                                        <h4 class="text-gray-900 font-extrabold text-xs tracking-tight line-clamp-2 leading-snug group-hover:text-[#1b2563] transition-colors"
                                            title="{{ $p->name }}">
                                            {{ $p->name }}
                                        </h4>
                                    </div>

                                    <div
                                        class="flex items-center justify-between mt-2.5 pt-2 border-t border-gray-50 relative z-20">
                                        {{-- Informasi Harga --}}
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[8px] font-black text-gray-400 uppercase tracking-wider leading-none">Harga</span>
                                            <span class="text-xs font-black text-gray-900 mt-1 tracking-tight">
                                                Rp {{ number_format($p->price, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        {{-- Kumpulan Tombol Aksi Kanan (Edit, Toggle Stok, Hapus) --}}
                                        <div class="flex items-center gap-1.5">

                                            {{-- 1. TOMBOL TOGGLE STATUS STOK (Available / Out of Stock) --}}
                                            <form action="{{ route('vendor.product.toggle-status', $p->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-7 h-7 rounded-xl border flex items-center justify-center transition-all duration-200"
                                                    :class="{{ $p->is_available }} ?
                                                        'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' :
                                                        'bg-gray-100 border-gray-200 text-gray-400 hover:bg-gray-200 line-through'"
                                                    title="{{ $p->is_available ? 'Set Jual Habis' : 'Set Siap Jual' }}">
                                                    <i
                                                        class="ti {{ $p->is_available ? 'ti-circle-check' : 'ti-circle-x' }} text-xs"></i>
                                                </button>
                                            </form>

                                            {{-- 2. TOMBOL EDIT MENU --}}
                                            <a href="{{ route('vendor.product.edit', $p->id) }}"
                                                class="w-7 h-7 rounded-xl bg-gray-50 border border-gray-100 text-gray-400 hover:text-[#1b2563] hover:bg-blue-50 hover:border-blue-100 flex items-center justify-center transition-all duration-200"
                                                title="Edit Menu">
                                                <i class="ti ti-edit text-xs"></i>
                                            </a>

                                            {{-- 3. TOMBOL HAPUS MENU (Gaya Minimalis Bahaya) --}}
                                            <form action="{{ route('vendor.product.destroy', $p->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')

                                                {{-- Cukup tambahkan class 'confirm-delete-btn' dan data-confirm (Opsional) --}}
                                                <button type="button"
                                                    class="confirm-delete-btn w-7 h-7 rounded-xl bg-red-50/50 border border-red-100/40 text-red-400 hover:text-white hover:bg-red-600 hover:border-red-600 flex items-center justify-center transition-all duration-200"
                                                    data-confirm-title="Hapus {{ $p->name }}?"
                                                    data-confirm-text="Siswa tidak akan bisa memesan hidangan ini lagi setelah dihapus."
                                                    data-confirm-button="HAPUS SEKARANG" title="Hapus Menu">
                                                    <i class="ti ti-trash text-sm"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    {{-- State khusus jika setelah di-filter Alpine ternyata card kosong --}}
                    <div x-show="document.querySelectorAll('[x-show*=\'activeCategory\']:not([style*=\'display: none\'])').length === 0"
                        class="w-full bg-white border border-gray-100 rounded-3xl py-16 flex flex-col items-center justify-center text-center shadow-sm shadow-gray-100/40 mt-4"
                        x-cloak>
                        <div
                            class="w-14 h-14 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-400 flex items-center justify-center rounded-2xl mb-3.5 border border-gray-200/60 shadow-inner">
                            <i class="ti ti-basket text-xl"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-wider">Menu Kosong</h4>
                        <p class="text-xs text-gray-400 max-w-xs mt-1 font-medium px-4">
                            Kamu belum mendaftarkan item untuk kategori ini.
                        </p>
                    </div>
                @else
                    {{-- Clean Empty State Default Database --}}
                    <div
                        class="w-full bg-white border border-gray-100 rounded-3xl py-16 flex flex-col items-center justify-center text-center shadow-sm shadow-gray-100/40">
                        <div
                            class="w-14 h-14 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-400 flex items-center justify-center rounded-2xl mb-3.5 border border-gray-200/60 shadow-inner">
                            <i class="ti ti-basket text-xl"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-wider">Daftar Menu Tidak Ditemukan
                        </h4>
                        <p class="text-xs text-gray-400 max-w-xs mt-1 font-medium px-4">
                            Lapak kamu belum mengunggah produk menu apapun hari ini.
                        </p>
                    </div>
                @endif
            </div>

        </div>

    </div>

    {{-- Clean Custom Utility Styling --}}
    <style>
        /* Sembunyikan scrollbar bawaan browser pada filter horizontal tanpa mematikan fitur scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.25s ease-out forwards;
        }

        /* Set base style body agar rapi */
        body {
            background-color: #ffffff;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        body::-webkit-scrollbar {
            display: none;
        }
    </style>

    {{-- Script AJAX Status Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-shop-status');
            const cardBg = document.getElementById('shop-card-bg');
            const statusText = document.getElementById('shop-status-text');
            const statusDesc = document.getElementById('shop-status-desc');
            const statusLabel = document.getElementById('status-label');
            const dotPing = document.getElementById('dot-ping');
            const dotSolid = document.getElementById('dot-solid');
            const badgeContainer = document.getElementById('status-badge-container');

            if (toggleBtn) {
                toggleBtn.addEventListener('change', function() {
                    const isOpen = this.checked;

                    statusLabel.textContent = isOpen ? 'Buka' : 'Tutup';
                    statusText.textContent = isOpen ? 'Menerima Pesanan' : 'Lapak Beristirahat';
                    statusDesc.textContent = isOpen ? 'Pelanggan bisa memesan menu makanan.' :
                        'Menu disembunyikan sementara dari siswa.';

                    if (isOpen) {
                        cardBg.className =
                            "p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between bg-gradient-to-br from-emerald-500 to-teal-600 text-white";
                        badgeContainer.className =
                            "flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 bg-white/20 border-white/20";
                        dotPing.className =
                            "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-white";
                        dotSolid.className = "relative inline-flex rounded-full h-2 w-2 bg-white";
                    } else {
                        cardBg.className =
                            "p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between bg-gradient-to-br from-gray-800 to-slate-900 text-white";
                        badgeContainer.className =
                            "flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 bg-white/10 border-white/10";
                        dotPing.className =
                            "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-red-400";
                        dotSolid.className = "relative inline-flex rounded-full h-2 w-2 bg-red-500";
                    }

                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                    fetch('{{ route('vendor.shop.toggle-status') }}', {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                is_open: isOpen
                            })
                        })
                        .then(response => {
                            if (!response.ok) console.error('Gagal memperbarui status di server');
                        })
                        .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
@endsection
