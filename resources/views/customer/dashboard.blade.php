@extends('layouts.customer')

@section('title', 'Katalog E-Kantin')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36" x-data="{
        search: '{{ request('search', '') }}',
        activeCategory: '{{ request('category', '') }}',
        submitFilter() {
            this.$nextTick(() => {
                this.$refs.filterForm.submit();
            });
        }
    }">

        <div class="space-y-8">

            <div
                class="relative bg-gradient-to-r from-[#1b2563] to-[#2a388a] rounded-[2.5rem] p-8 overflow-hidden shadow-lg shadow-[#1b2563]/10">
                <div class="absolute -right-6 -bottom-6 w-40 h-40 bg-[#fbbf24]/10 rounded-full blur-2xl"></div>
                <div class="absolute right-12 top-6 text-white/10 select-none pointer-events-none">
                    <i class="ti ti-cookie text-8xl"></i>
                </div>
                <div class="relative z-10 max-w-md">
                    <span
                        class="text-[10px] font-bold uppercase tracking-widest text-[#fbbf24] bg-white/10 px-3 py-1 rounded-full border border-white/10">SMKN
                        1 Cirebon</span>
                    <h2 class="text-3xl font-black text-white mt-3 mb-2 tracking-wide">Mau jajan apa hari ini?</h2>
                    <p class="text-xs text-blue-100/80 leading-relaxed">
                        Pesan makanan favoritmu dari dalam kelas tanpa perlu lelah mengantre panjang di area stan kantin.
                    </p>
                </div>
            </div>

            <form x-ref="filterForm" action="{{ route('customer.dashboard') }}" method="GET"
                class="bg-white border border-slate-100 rounded-[2rem] p-5 shadow-xs space-y-4">

                <input type="hidden" name="category" x-model="activeCategory">

                <div class="relative flex items-center">
                    <div class="absolute left-4 text-slate-400">
                        <i class="ti ti-search text-xl"></i>
                    </div>
                    <input type="text" name="search" x-model="search" @input.debounce.500ms="submitFilter()"
                        placeholder="Cari jajanan, minuman, atau nama stan..."
                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-800 rounded-2xl text-sm focus:outline-none focus:border-[#1b2563] focus:bg-white transition-all">
                </div>

                <div class="space-y-2.5">
                    <h3 class="text-[11px] font-bold uppercase tracking-widest text-slate-400 px-1">Pilih Kategori</h3>
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                        <button type="button" @click="activeCategory = ''; submitFilter()"
                            :class="activeCategory === '' ?
                                'bg-[#1b2563] text-white shadow-md shadow-[#1b2563]/10 font-bold' :
                                'bg-white border border-slate-200 text-slate-600'"
                            class="px-5 py-2.5 rounded-xl text-xs font-semibold active:scale-95 transition-all whitespace-nowrap flex items-center gap-1.5">
                            <i class="ti ti-category text-sm"></i> Semua Menu
                        </button>

                        @foreach ($categories as $category)
                            <button type="button" @click="activeCategory = '{{ $category->slug }}'; submitFilter()"
                                :class="activeCategory === '{{ $category->slug }}' ?
                                    'bg-[#1b2563] text-white shadow-md shadow-[#1b2563]/10 font-bold' :
                                    'bg-white border border-slate-200 text-slate-600'"
                                class="px-5 py-2.5 rounded-xl text-xs font-semibold active:scale-95 transition-all whitespace-nowrap flex items-center gap-1.5">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </form>

            <div class="space-y-4">
                <div class="flex items-center justify-between px-1">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 tracking-wide">Lapak Kantin Utama</h3>
                        <p class="text-xs text-slate-400">Pilih stan kantin favoritmu sekolahan</p>
                    </div>
                    <span
                        class="text-xs text-[#1b2563] font-bold flex items-center gap-1 bg-blue-50/70 px-3 py-1.5 rounded-xl">
                        Geser Lapak <i class="ti ti-arrow-narrow-right text-base animate-pulse"></i>
                    </span>
                </div>

                <div class="flex items-center gap-6 overflow-x-auto pb-4 pt-1 px-1 scrollbar-none snap-x snap-mandatory">
                    @forelse($shops as $shop)
                        <div
                            class="snap-start flex-shrink-0 w-[310px] sm:w-[360px] bg-white border border-slate-100 rounded-[2.5rem] p-4 shadow-xs hover:shadow-md hover:border-slate-200/80 transition-all duration-300 relative group flex flex-col justify-between {{ $shop->is_open ? '' : 'opacity-70' }}">

                            <div>
                                <div
                                    class="w-full h-44 rounded-[1.8rem] bg-slate-100 border border-slate-50 overflow-hidden relative mb-4 shadow-inner">
                                    @if ($shop->banner_path)
                                        <img src="{{ asset('storage/' . $shop->banner_path) }}" alt="{{ $shop->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 text-slate-400">
                                            <i class="ti ti-building-store text-5xl"></i>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                    </div>

                                    <div class="absolute top-4 right-4 z-10">
                                        @if ($shop->is_open)
                                            <span
                                                class="text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-xl bg-emerald-500 text-white shadow-sm flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span> Buka
                                            </span>
                                        @else
                                            <span
                                                class="text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-xl bg-[#730f00] text-white shadow-sm">Tutup</span>
                                        @endif
                                    </div>

                                    <div class="absolute bottom-4 left-4 right-4 z-10">
                                        <h4 class="font-black text-white tracking-wide text-lg truncate drop-shadow-md">
                                            {{ $shop->name }}
                                        </h4>
                                    </div>
                                </div>

                                <div class="px-2">
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed min-h-[36px]">
                                        {{ $shop->description ?? 'Belum ada informasi deskripsi resmi mengenai stan menu kuliner ini.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between px-2">
                                <span
                                    class="text-[11px] text-slate-400 font-bold flex items-center gap-1.5 bg-slate-50 px-2.5 py-1.5 rounded-xl truncate max-w-[150px]">
                                    <i class="ti ti-credit-card text-xs text-slate-500"></i>
                                    {{ $shop->payment_info ?? 'Metode Tunai' }}
                                </span>

                                @if ($shop->is_open)
                                    <a href="{{ route('customer.shop.show', $shop) }}"
                                        class="inline-flex items-center gap-0.5 text-xs font-bold text-[#1b2563] bg-blue-50/40 hover:bg-blue-50 px-3.5 py-1.5 rounded-xl transition-all">
                                        Lihat Menu <i class="ti ti-chevron-right text-sm"></i>
                                    </a>
                                @else
                                    <span
                                        class="text-xs font-semibold text-slate-400 italic flex items-center gap-1 bg-slate-50 px-3 py-1.5 rounded-xl">
                                        <i class="ti ti-zodiac-taurus text-xs"></i> Istirahat
                                    </span>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div
                            class="w-full text-center py-16 bg-white border border-dashed border-slate-200 rounded-[2.5rem]">
                            <div class="text-slate-300 mb-2"><i class="ti ti-building-store-off text-5xl"></i></div>
                            <p class="text-sm text-slate-400 font-medium">Belum ada lapak kantin yang terdaftar.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="space-y-4">
                <div class="px-1">
                    <h3 class="text-sm font-bold text-slate-800 tracking-wide">Katalog Menu Utama</h3>
                    <p class="text-xs text-slate-400">Hidangan lezat higienis siap diambil pas jam istirahat sekolah</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @forelse ($products as $product)
                        <div
                            class="bg-white border border-slate-100 rounded-[2rem] p-3 shadow-xs hover:shadow-md transition-all flex flex-col justify-between relative {{ $product->is_available && $product->shop->is_open ? '' : 'opacity-65' }}">
                            <div>
                                <div
                                    class="w-full aspect-square bg-slate-50 rounded-2xl overflow-hidden mb-3 relative shadow-xs border border-slate-100">
                                    @if ($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                            <i class="ti ti-soup text-4xl"></i>
                                        </div>
                                    @endif

                                    @if (!$product->is_available)
                                        <div
                                            class="absolute inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center">
                                            <span
                                                class="text-[10px] font-bold text-white bg-[#730f00] px-2.5 py-1 rounded-xl flex items-center gap-0.5 shadow-md">
                                                <i class="ti ti-lock-x"></i>
                                                Habis
                                            </span>
                                        </div>
                                    @elseif(!$product->shop->is_open)
                                        <div
                                            class="absolute inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center">
                                            <span
                                                class="text-[10px] font-bold text-white bg-slate-700 px-2.5 py-1 rounded-xl flex items-center gap-0.5 shadow-md">
                                                <i class="ti ti-building-store"></i> Tutup
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <h5 class="font-bold text-slate-800 text-xs sm:text-sm tracking-wide truncate px-0.5">
                                    {{ $product->name }}</h5>
                                <p class="text-[10px] text-slate-400 truncate mt-0.5 flex items-center gap-1 px-0.5">
                                    <i class="ti ti-store text-[11px] text-slate-400"></i> {{ $product->shop->name }}
                                </p>
                            </div>

                            <div class="mt-4 pt-2 border-t border-slate-50 flex items-center justify-between px-0.5">
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-slate-400 leading-none">Harga</span>
                                    <span class="text-xs font-black text-[#730f00] mt-1">Rp

                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>

                                @php
                                    $cart = session()->get('cart', []);
                                    $isDifferentShop = false;

                                    // Cek apakah cart tidak kosong dan toko di cart berbeda dengan toko produk saat ini
                                    if (!empty($cart)) {
                                        $firstItem = reset($cart);
                                        if ($firstItem['shop_id'] != $product->shop_id) {
                                            $isDifferentShop = true;
                                        }
                                    }
                                @endphp

                                @if ($product->is_available && $product->shop->is_open)
                                    @if ($isDifferentShop)
                                        <button type="button" disabled title="Anda sedang memesan dari toko lain"
                                            class="w-8 h-8 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center cursor-not-allowed opacity-50">
                                            <i class="ti ti-lock text-sm"></i>
                                        </button>
                                    @else
                                        <form action="{{ route('customer.cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-8 h-8 bg-[#1b2563] text-white rounded-xl flex items-center justify-center hover:bg-[#730f00] transition-colors shadow-xs active:scale-95 cursor-pointer">
                                                <i class="ti ti-plus text-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button type="button" disabled
                                        class="w-8 h-8 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center cursor-not-allowed">
                                        <i class="ti ti-lock text-sm"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-20 bg-white border border-dashed border-slate-200 rounded-[2.5rem]">
                            <div class="text-slate-300 mb-2"><i class="ti ti-search-off text-5xl"></i></div>
                            <p class="text-sm text-slate-500 font-bold">Produk kuliner tidak ditemukan.</p>
                            <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci lain atau pilih kategori
                                jajanan yang berbeda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
