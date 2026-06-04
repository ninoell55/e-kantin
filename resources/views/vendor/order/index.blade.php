@extends('layouts.vendor')

@section('content')
    {{-- Container Benar-benar Full Screen (Edge-to-Edge) Selaras dengan Manajemen Produk & Dashboard --}}
    {{-- Inisialisasi Alpine.js state awal diset ke 'semua' --}}
    <div x-data="{ activeStatus: 'semua' }" class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Top Bar / Header Halaman Pesanan dengan Clean Breadcrumb --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Clean --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="text-gray-400 font-black flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </span>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d]">Pesanan Masuk</span>
                </nav>

                {{-- Judul Halaman --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full hidden sm:inline-block"></span>
                    Pesanan Masuk Lapak
                </h1>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1 sm:ml-3.5">Pantau antrean dapur
                    anda</p>
            </div>

            {{-- Info Statistik Ringkas / Minimalist Counter Badge --}}
            <div
                class="flex items-center gap-3 bg-gray-50/80 border border-gray-200/40 px-4 py-2.5 rounded-2xl w-full md:w-auto">
                <div class="w-8 h-8 rounded-xl bg-[#7f1d1d]/10 text-[#7f1d1d] flex items-center justify-center">
                    <i class="ti ti-receipt text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Total
                        Antrean</span>
                    <span class="text-xs font-black text-gray-900 mt-0.5 leading-none">
                        {{ $orders->total() }} Pesanan
                    </span>
                </div>
            </div>
        </div>

        {{-- Navigasi Filter Minimalis Berfungsi Dinamis Menggunakan Alpine.js --}}
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-5">
            <div
                class="flex gap-1.5 bg-gray-100/80 p-1.5 rounded-2xl w-full sm:w-auto overflow-x-auto no-scrollbar border border-gray-200/30">

                <button type="button" @click="activeStatus = 'semua'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'semua' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Semua
                </button>

                <button type="button" @click="activeStatus = 'pending'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'pending' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Baru
                </button>

                <button type="button" @click="activeStatus = 'processing'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'processing' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Dimasak
                </button>

                <button type="button" @click="activeStatus = 'ready'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'ready' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Siap
                </button>

                <button type="button" @click="activeStatus = 'completed'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'completed' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Selesai
                </button>

                <button type="button" @click="activeStatus = 'cancelled'"
                    class="px-5 py-2 rounded-xl text-xs whitespace-nowrap transition-all duration-200"
                    :class="activeStatus === 'cancelled' ? 'bg-[#1b2563] text-white font-black shadow-sm' :
                        'text-gray-500 hover:text-gray-900 font-bold'">
                    Batal
                </button>

            </div>
        </div>

        {{-- AREA GRID UTAMA: Responsif Sempurna Mengikuti Pola Etalase Produk --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse($orders as $o)
                {{-- Menyembunyikan/menampilkan card secara dinamis berdasarkan status --}}
                <div x-show="activeStatus === 'semua' || activeStatus === '{{ $o->status }}'"
                    class="bg-white border border-gray-100/80 rounded-3xl p-5 flex flex-col justify-between hover:border-gray-200 hover:shadow-xl hover:shadow-gray-200/30 transition-all duration-300">

                    {{-- Konten Utama Card --}}
                    <div>
                        {{-- Card Header --}}
                        <div class="flex justify-between items-start mb-4 pb-3 border-b border-dashed border-gray-200">
                            <div>
                                <h4 class="text-sm font-black text-gray-800 tracking-tight">
                                    #{{ $o->invoice_number ?? 'INV-' . $o->id }}
                                </h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide mt-0.5">
                                    {{ $o->created_at->format('H:i') }} WIB • {{ $o->user->name }}
                                </p>
                            </div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-blue-50 border border-blue-100 text-blue-600',
                                    'processing' => 'bg-orange-50 border border-orange-100 text-orange-600',
                                    'ready' => 'bg-amber-50 border border-amber-100 text-amber-600',
                                    'completed' => 'bg-emerald-50 border border-emerald-100 text-emerald-600',
                                    'cancelled' => 'bg-red-50 border border-red-100 text-red-600',
                                ];
                            @endphp
                            <span
                                class="{{ $statusColors[$o->status] ?? 'bg-gray-50 text-gray-500' }} text-[9px] px-2.5 py-0.5 rounded-md font-black uppercase tracking-wider">
                                {{ $o->status }}
                            </span>
                        </div>

                        {{-- Order Items Preview --}}
                        <div class="space-y-3 mb-5">
                            @foreach ($o->orderItems->take(2) as $item)
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        @if ($item->product_image_path)
                                            <img src="{{ asset('storage/' . $item->product_image_path) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <i class="ti ti-cookie text-gray-300 text-sm"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[11px] font-extrabold text-gray-800 leading-none truncate">
                                            {{ $item->product_name }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase">
                                            Jumlah : {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <p class="text-[11px] font-black text-[#1b2563] flex-shrink-0">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach

                            @if ($o->orderItems->count() > 2)
                                <p class="text-[9px] text-gray-400 font-bold italic pl-13">
                                    + {{ $o->orderItems->count() - 2 }} menu lainnya...
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-2 pt-2 border-t border-gray-50 mt-auto">
                        {{-- Tombol Detail Tetap Sama --}}
                        <a href="{{ route('vendor.order.show', $o->id) }}"
                            class="flex-1 bg-gray-50 text-gray-500 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 text-center border border-gray-100 hover:bg-gray-100 flex items-center justify-center">
                            Detail
                        </a>

                        {{-- KONDISI 1: JIKA TRANSFER DAN BELUM LUNAS (Butuh Verifikasi Pembayaran) --}}
                        @if (
                            ($o->payment_method === 'transfer' || $o->payment_method === 'online') &&
                                $o->payment_status !== 'paid' &&
                                $o->status !== 'cancelled')
                            <form action="{{ route('vendor.order.verifyPayment', $o->id) }}" method="POST"
                                class="flex-[2] flex gap-1">
                                @csrf @method('PUT')
                                {{-- Tombol Terima Transferan --}}
                                <button type="submit" name="payment_status" value="paid"
                                    class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl text-[9px] font-black uppercase tracking-tight shadow-sm transition-all active:scale-95 hover:bg-emerald-700 text-center">
                                    KONFIRMASI
                                </button>
                                {{-- Tombol Tolak Transferan --}}
                                <button type="submit" name="payment_status" value="failed"
                                    class="bg-rose-50 text-rose-600 border border-rose-100 px-3 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-tight transition-all active:scale-95 hover:bg-rose-100 text-center">
                                    TOLAK
                                </button>
                            </form>

                            {{-- KONDISI 2: JIKA COD ATAU TRANSFER YANG SUDAH LUNAS (Alur Proses Dapur Biasa) --}}
                        @else
                            <form action="{{ route('vendor.order.updateStatus', $o->id) }}" method="POST"
                                class="flex-[2] flex">
                                @csrf @method('PUT')
                                @if ($o->status === 'pending')
                                    <button type="submit" name="status" value="processing"
                                        class="w-full bg-[#1b2563] text-white py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:bg-[#151e4d]">
                                        TERIMA & PROSES
                                    </button>
                                @elseif($o->status === 'processing')
                                    <button type="submit" name="status" value="ready"
                                        class="w-full bg-[#fbbf24] text-white py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:bg-[#e0a71a]">
                                        SIAP DIAMBIL
                                    </button>
                                @elseif($o->status === 'ready')
                                    <button type="submit" name="status" value="completed"
                                        class="w-full bg-emerald-600 text-white py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:bg-emerald-700">
                                        SELESAI
                                    </button>
                                @else
                                    <button type="button" disabled
                                        class="w-full bg-gray-100 text-gray-400 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed">
                                        CLOSED
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>

                </div>
            @empty
                {{-- Clean Empty State Selaras dengan Halaman Produk --}}
                <div
                    class="w-full bg-white border border-gray-100 rounded-3xl py-16 flex flex-col items-center justify-center text-center shadow-sm shadow-gray-100/40 col-span-full">
                    <div
                        class="w-14 h-14 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-400 flex items-center justify-center rounded-2xl mb-3.5 border border-gray-200/60 shadow-inner">
                        <i class="ti ti-basket text-xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-wider">Antrean Kosong</h4>
                    <p class="text-xs text-gray-400 max-w-xs mt-1 font-medium px-4">
                        Saat ini tidak ada pesanan masuk dengan status tersebut.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Section --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>

    {{-- Clean Custom Utility Styling --}}
    <style>
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
