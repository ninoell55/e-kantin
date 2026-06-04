@extends('layouts.vendor')

@section('content')
    {{-- Container Edge-to-Edge Selaras dengan Dashboard --}}
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Top Bar / Header Halaman Detail Produk dengan Clean Breadcrumb (Match Style) --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Clean --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <a href="{{ route('vendor.dashboard') }}"
                        class="text-gray-400 hover:text-[#1b2563] transition-colors flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </a>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <a href="{{ route('vendor.product.index') }}"
                        class="text-gray-400 hover:text-[#1b2563] transition-colors">
                        Manajemen Produk
                    </a>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d] font-black">Detail Menu</span>
                </nav>

                {{-- Judul Halaman --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Detail Informasi Menu
                </h1>
            </div>

            {{-- Info Kategori / Minimalist Counter Badge --}}
            <div
                class="flex items-center gap-3 bg-gray-50/80 border border-gray-200/40 px-4 py-2.5 rounded-2xl w-full md:w-auto">
                <div class="w-8 h-8 rounded-xl bg-[#1b2563]/10 text-[#1b2563] flex items-center justify-center">
                    <i class="ti ti-category text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Kategori</span>
                    <span class="text-xs font-black text-gray-900 mt-0.5 leading-none">
                        {{ $product->category->name ?? 'Kategori Umum' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- MAIN DISPLAY: Grid Belah Dua Kiri Foto, Kanan Detail --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            {{-- BAGIAN KIRI: Frame Foto Menu Berukuran Besar & Logika Status --}}
            <div class="md:col-span-1 space-y-4">
                <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm shadow-gray-100/30">
                    <div
                        class="w-full aspect-square bg-gray-50 rounded-2xl overflow-hidden relative shadow-inner border border-gray-100">
                        @if ($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            {{-- Placeholder jika foto kosong --}}
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center p-6 bg-gradient-to-b from-gray-50 to-gray-100/50 text-gray-400">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-sm border border-gray-100 mb-2">
                                    <i class="ti ti-photo-off text-xl text-gray-300"></i>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-400/80">No Media
                                    Cover</span>
                            </div>
                        @endif

                        {{-- Status Badge Mengambang --}}
                        <div class="absolute top-3 right-3">
                            @if ($product->is_available)
                                <span
                                    class="bg-emerald-500 text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-xl shadow-md border border-white/20">
                                    Aktif Dijual
                                </span>
                            @else
                                <span
                                    class="bg-gray-500 text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-xl shadow-md border border-white/20">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Status Riwayat Log Data --}}
                <div class="p-4 rounded-2xl bg-gray-50/80 border border-gray-200/40 space-y-2.5">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-400 font-bold">Dibuat Pada:</span>
                        <span class="text-gray-700 font-black">{{ $product->created_at->translatedFormat('d M Y - H:i') }}
                            WIB</span>
                    </div>
                    <div class="flex justify-between items-center text-xs border-t border-gray-200/40 pt-2.5">
                        <span class="text-gray-400 font-bold">Terakhir Diubah:</span>
                        <span class="text-gray-700 font-black">{{ $product->updated_at->translatedFormat('d M Y - H:i') }}
                            WIB</span>
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: Data Spesifikasi Menu & Tombol Manajemen --}}
            <div class="md:col-span-2 space-y-4">

                {{-- Blok Nama, Harga Utama & Tombol Kontrol --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm shadow-gray-100/30 space-y-5">
                    <div class="flex justify-between items-start gap-4 flex-col sm:flex-row">
                        <div class="space-y-1">
                            <h2 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight leading-tight">
                                {{ $product->name }}
                            </h2>
                            <p class="text-[10px] font-bold text-gray-400 tracking-wider">
                                URL SLUG: <span
                                    class="text-[#1b2563] bg-blue-50/50 px-1.5 py-0.5 rounded border border-blue-100/30 font-mono">{{ $product->slug }}</span>
                            </p>
                        </div>

                        {{-- Panel Manajemen Tombol Aksi Kanan Atas --}}
                        <div class="flex items-center gap-1.5 w-full sm:w-auto justify-end relative z-20">
                            {{-- Toggle Status Cepat --}}
                            <form action="{{ route('vendor.product.toggle-status', $product->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="h-9 px-4 rounded-xl border flex items-center justify-center gap-1.5 text-xs font-black transition-all duration-200
                                    {{ $product->is_available ? 'bg-emerald-50 border-emerald-100 text-emerald-600 hover:bg-emerald-100' : 'bg-gray-100 border-gray-200 text-gray-400 hover:bg-gray-200' }}"
                                    title="Ubah Status Ketersediaan">
                                    <i
                                        class="ti {{ $product->is_available ? 'ti-circle-check' : 'ti-circle-x' }} text-sm"></i>
                                    <span>{{ $product->is_available ? 'Set Jual Habis' : 'Set Siap Jual' }}</span>
                                </button>
                            </form>

                            {{-- Edit Menu --}}
                            <a href="{{ route('vendor.product.edit', $product->id) }}"
                                class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-100 text-gray-400 hover:text-[#1b2563] hover:bg-blue-50 hover:border-blue-100 flex items-center justify-center transition-all duration-200"
                                title="Edit Menu">
                                <i class="ti ti-edit text-sm"></i>
                            </a>

                            {{-- Hapus Menu --}}
                            <form action="{{ route('vendor.product.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Hapus permanen menu {{ $product->name }} dari sistem?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-9 h-9 rounded-xl bg-red-50/50 border border-red-100/40 text-red-400 hover:text-white hover:bg-red-600 hover:border-red-600 flex items-center justify-center transition-all duration-200"
                                    title="Hapus Menu">
                                    <i class="ti ti-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div
                        class="pt-4 border-t border-gray-50 flex flex-col gap-1 bg-gray-50/40 p-4 rounded-2xl border border-gray-200/20">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Harga Jual
                            Menu</span>
                        <span class="text-2xl font-black text-[#7f1d1d] tracking-tight mt-1">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- Blok Deskripsi Produk --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm shadow-gray-100/30 space-y-3">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-1 h-3.5 bg-[#7f1d1d] rounded-full"></div>
                        <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-widest">Deskripsi / Komposisi
                            Hidangan</h3>
                    </div>

                    @if ($product->description)
                        <p class="text-xs font-semibold text-gray-600 leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </p>
                    @else
                        <div class="text-center py-4 text-gray-400 text-xs font-medium italic">
                            Vendor tidak menyertakan keterangan deskripsi tertulis untuk hidangan ini.
                        </div>
                    @endif
                </div>

                {{-- Tips Info Lapak / Edukasi Sistem --}}
                <div class="bg-blue-50/40 border border-blue-100/60 p-5 rounded-3xl flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-[#1b2563]/5 text-[#1b2563] flex items-center justify-center shrink-0">
                        <i class="ti ti-info-circle text-base"></i>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-black text-gray-900 uppercase tracking-wide">Petunjuk Etalase Murid</h4>
                        <p class="text-[11px] text-gray-400 leading-normal font-medium">
                            Jika status dirubah ke <strong class="text-red-600">Stok Habis</strong>, menu ini akan otomatis
                            diberi penanda abu-abu gelap di aplikasi pre-order siswa SMKN 1 Cirebon agar mereka tidak dapat
                            memasukkan item ini ke keranjang belanjaan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Gaya Custom Animasi --}}
    <style>
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
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
