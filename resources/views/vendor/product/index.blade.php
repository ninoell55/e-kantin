@extends('layouts.vendor')

@section('content')
    {{-- Container Benar-benar Full Screen (Edge-to-Edge) Selaras dengan Dashboard --}}
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Top Bar / Header Halaman Produk dengan Clean Breadcrumb --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Clean --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="text-gray-400 font-black flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </span>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d]">Manajemen Produk</span>
                </nav>


                {{-- Judul Halaman --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Manajemen Produk Lapak
                </h1>
            </div>

            {{-- Info Statistik Ringkas / Minimalist Counter Badge --}}
            <div
                class="flex items-center gap-3 bg-gray-50/80 border border-gray-200/40 px-4 py-2.5 rounded-2xl w-full md:w-auto">
                <div class="w-8 h-8 rounded-xl bg-[#7f1d1d]/10 text-[#7f1d1d] flex items-center justify-center">
                    <i class="ti ti-box text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Total
                        Menu</span>
                    <span class="text-xs font-black text-gray-900 mt-0.5 leading-none">
                        {{ is_object($products) ? $products->total() : count($products ?? []) }} Item Terdaftar
                    </span>
                </div>
            </div>
        </div>

        {{-- PANEL KANAN: Manajemen & Katalog Menu Utama dengan Filter Alpine.js --}}
        <div class="lg:col-span-3" x-data="{
            activeCategory: 'semua',
            {{-- Fungsi dinamis menghitung apakah ada item yang terlihat setelah di-filter --}}
            checkEmpty() {
                let visibleCards = document.querySelectorAll('.product-card:not([style*=\'display: none\'])');
                return visibleCards.length === 0;
            }
        }">

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
                            $pCategory = isset($p->category->name) ? strtolower($p->category->name) : 'semua';
                        @endphp

                        {{-- Card Item Di-handle oleh Alpine x-show & ditambahkan class unique 'product-card' --}}
                        <div x-show="activeCategory === 'semua' || activeCategory === '{{ $pCategory }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="product-card bg-white border border-gray-100/80 rounded-3xl p-3 flex flex-col justify-between group hover:border-gray-200 hover:shadow-xl hover:shadow-gray-200/30 transition-all duration-300 relative">

                            {{-- LINK UTAMA: Nembus halaman show.blade.php tanpa tabrakan nesting tag HTML --}}
                            <a href="{{ route('vendor.product.show', $p->id) }}" class="absolute inset-0 z-10 rounded-3xl"
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

                                <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-gray-50">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[8px] font-black text-gray-400 uppercase tracking-wider leading-none">Harga</span>
                                        <span class="text-xs font-black text-gray-900 mt-1 tracking-tight">
                                            Rp {{ number_format($p->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-1.5 z-50">

                                        {{-- 1. TOMBOL TOGGLE STATUS STOK (Available / Out of Stock) --}}
                                        <form action="{{ route('vendor.product.toggle-status', $p->id) }}" method="POST"
                                            class="inline">
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

                {{-- State khusus Reaktif Alpine jika setelah di-filter ternyata card bernilai kosong --}}
                <div x-show="checkEmpty()"
                    class="w-full bg-white border border-gray-100 rounded-3xl py-16 flex flex-col items-center justify-center text-center shadow-sm shadow-gray-100/40 mt-4"
                    x-cloak>
                    <div
                        class="w-14 h-14 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-400 flex items-center justify-center rounded-2xl mb-3.5 border border-gray-200/60 shadow-inner">
                        <i class="ti ti-basket text-xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-wider">Menu Kosong</h4>
                    <p class="text-xs text-gray-400 max-w-xs mt-1 font-medium px-4">
                        Kamu belum mendaftarkan item untuk kategori ini pada halaman ini.
                    </p>
                </div>
            @else
                {{-- Clean Empty State Default Database (Jika Kosong dari Query Controller) --}}
                <div
                    class="w-full bg-white border border-gray-100 rounded-3xl py-16 flex flex-col items-center justify-center text-center shadow-sm shadow-gray-100/40">
                    <div
                        class="w-14 h-14 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-400 flex items-center justify-center rounded-2xl mb-3.5 border border-gray-200/60 shadow-inner">
                        <i class="ti ti-basket text-xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-wider">Daftar Menu Tidak Ditemukan</h4>
                    <p class="text-xs text-gray-400 max-w-xs mt-1 font-medium px-4">
                        Lapak kamu belum mengunggah produk menu apapun saat ini.
                    </p>
                </div>
            @endif
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
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
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
@endsection
