@extends('layouts.vendor')

@section('content')
    {{-- Container Benar-benar Full Screen (Edge-to-Edge) Selaras dengan Index Order & Dashboard --}}
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Top Bar / Header Halaman dengan Clean Breadcrumb --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Clean --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="text-gray-400 font-black flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </span>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <a href="{{ route('vendor.order.index') }}" class="hover:text-gray-600 transition-colors">Pesanan
                        Masuk</a>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d]">Detail Invoice</span>
                </nav>

                {{-- Judul Halaman --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full hidden sm:inline-block"></span>
                    Invoice #{{ $order->invoice_number ?? 'INV-' . $order->id }}
                </h1>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1 sm:ml-3.5">
                    Dibuat pada {{ $order->created_at->format('H:i') }} WIB • {{ $order->created_at->format('d M Y') }}
                </p>
            </div>

            {{-- Status Badge Ringkas --}}
            @php
                $statusColors = [
                    'pending' => 'bg-blue-50 border border-blue-100 text-blue-600',
                    'processing' => 'bg-orange-50 border border-orange-100 text-orange-600',
                    'ready' => 'bg-amber-50 border border-amber-100 text-amber-600',
                    'completed' => 'bg-emerald-50 border border-emerald-100 text-emerald-600',
                    'cancelled' => 'bg-red-50 border border-red-100 text-red-600',
                ];
            @endphp
            <div class="w-full md:w-auto">
                <span
                    class="{{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-500' }} text-xs px-4 py-2 rounded-2xl font-black uppercase tracking-widest block text-center md:inline-block shadow-sm">
                    Status: {{ $order->status }}
                </span>
            </div>
        </div>

        {{-- AREA LAYOUT RESPONSIF UTAMA: 1 Kolom di Mobile, 3 Kolom di Layar Besar (lg) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- KOLOM KIRI (Makan Tempat 2 Kolom di Layar Gede): Rincian Menu --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between px-1">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Rincian Menu</h4>
                    <span class="text-[10px] font-black text-[#7f1d1d]">{{ $order->orderItems->count() }} Items</span>
                </div>

                {{-- Wrapper Menu Segaris dengan Style Dashboard --}}
                <div class="bg-gray-50/50 rounded-3xl p-4 border border-gray-100/80">
                    <div class="space-y-3">
                        @foreach ($order->orderItems as $item)
                            <div
                                class="bg-white rounded-2xl p-4 flex items-center gap-4 shadow-sm border border-gray-50 hover:border-gray-200 transition-all duration-200">
                                <div
                                    class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if ($item->product_image_path)
                                        <img src="{{ asset('storage/' . $item->product_image_path) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <i class="ti ti-cookie text-gray-300 text-lg"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-black text-gray-800 truncate">{{ $item->product_name }}</p>
                                    <p class="text-xs text-gray-400 font-bold uppercase mt-1">
                                        {{ $item->quantity }} Porsi x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <p class="text-sm font-black text-[#1b2563] flex-shrink-0">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Catatan Pembeli jika Ada --}}
                @if ($order->notes)
                    <div class="p-4 bg-amber-50/60 rounded-3xl border border-amber-100/80">
                        <span
                            class="text-[9px] font-black text-amber-600 uppercase tracking-widest flex items-center gap-1">
                            <i class="ti ti-note text-xs"></i> Catatan Pembeli
                        </span>
                        <p class="text-xs text-amber-800 font-semibold mt-1.5">"{{ $order->notes }}"</p>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN (Makan Tempat 1 Kolom di Layar Gede): Pelanggan & Ringkasan Bayar --}}
            <div class="space-y-6">
                {{-- Action Buttons --}}
                <div class="flex gap-2 pt-2 border-t border-gray-50 mt-auto">

                    {{-- KONDISI 1: JIKA TRANSFER DAN BELUM LUNAS (Butuh Verifikasi Pembayaran) --}}
                    @if (
                        ($order->payment_method === 'transfer' || $order->payment_method === 'online') &&
                            $order->payment_status !== 'paid' &&
                            $order->status !== 'cancelled')
                        <form action="{{ route('vendor.order.verifyPayment', $order->id) }}" method="POST"
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
                        <form action="{{ route('vendor.order.updateStatus', $order->id) }}" method="POST"
                            class="flex-[2] flex">
                            @csrf @method('PUT')
                            @if ($order->status === 'pending')
                                <button type="submit" name="status" value="processing"
                                    class="w-full bg-[#1b2563] text-white py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:bg-[#151e4d]">
                                    TERIMA & PROSES
                                </button>
                            @elseif($order->status === 'processing')
                                <button type="submit" name="status" value="ready"
                                    class="w-full bg-[#fbbf24] text-white py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:bg-[#e0a71a]">
                                    SIAP DIAMBIL
                                </button>
                            @elseif($order->status === 'ready')
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

                {{-- Customer Card --}}
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 px-1">Informasi Pelanggan
                    </h4>
                    <div class="bg-[#1b2563] rounded-3xl p-6 text-white shadow-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-white/50">Pelanggan</span>
                            <h2 class="text-xl font-black tracking-tight mt-1">{{ $order->user->name }}</h2>

                            {{-- Tambahan: Kontak --}}
                            <div class="mt-2 flex items-center gap-2 text-[10px] font-bold text-white/70">
                                <i class="ti ti-phone"></i> {{ $order->user->phone ?? 'Tidak ada nomor' }}
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-5 pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-white/50">Tipe</p>
                                    <p class="text-xs font-black mt-0.5 uppercase tracking-wide text-amber-300">
                                        {{ $order->order_type }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-white/50">Metode</p>
                                    <p class="text-xs font-black mt-0.5 uppercase tracking-wide text-emerald-300">
                                        {{ $order->payment_method }}</p>
                                </div>
                            </div>
                        </div>
                        <i class="ti ti-user-circle absolute -right-4 -bottom-4 text-8xl text-white/5"></i>
                    </div>
                </div>

                {{-- Tambahan: Status Pembayaran (Sangat Penting!) --}}
                <div class="mt-6">
                    <div
                        class="p-4 rounded-3xl border {{ $order->payment_status === 'paid' ? 'bg-emerald-50 border-emerald-100' : 'bg-rose-50 border-rose-100' }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <p
                                    class="text-[9px] font-black uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'text-emerald-700' : 'text-rose-700' }}">
                                    Status Pembayaran
                                </p>
                                <p
                                    class="text-sm font-black mt-1 {{ $order->payment_status === 'paid' ? 'text-emerald-900' : 'text-rose-900' }}">
                                    {{ $order->payment_status === 'paid' ? 'SUDAH DIBAYAR' : 'BELUM LUNAS' }}
                                </p>
                            </div>

                            {{-- Kalau Transfer dan Belum Lunas, kasih tombol cek --}}
                            @if ($order->payment_method === 'transfer' && $order->payment_status !== 'paid')
                                <button type="button"
                                    onclick="document.getElementById('modalBukti').classList.remove('hidden')"
                                    class="bg-white text-rose-600 px-3 py-1.5 rounded-lg text-[10px] font-black shadow-sm">
                                    LIHAT BUKTI
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kalkulasi Pembayaran --}}
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 px-1">Ringkasan Biaya
                    </h4>
                    <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                        <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-gray-700 font-black">Rp
                                {{ number_format($order->total_price - $order->delivery_fee, 0, ',', '.') }}</span>
                        </div>
                        @if ($order->order_type === 'delivery')
                            <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-widest">
                                <span>Ongkir Kelas</span>
                                <span class="text-gray-700 font-black">Rp
                                    {{ number_format($order->delivery_fee, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-gray-200">
                            <span class="text-xs font-black text-gray-900 uppercase tracking-wider">Total Bayar</span>
                            <span class="text-2xl font-black text-[#7f1d1d] tracking-tight text-right">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
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

    {{-- Modal Lihat Bukti Transfer --}}
    <div id="modalBukti"
        class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl p-6 w-full max-w-sm shadow-2xl animate-fade-in">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xs font-black uppercase tracking-widest text-gray-800">Bukti Transfer</h3>
                <button onclick="document.getElementById('modalBukti').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="rounded-2xl overflow-hidden border border-gray-100 bg-gray-50">
                @if ($order->payment_proof)
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer"
                        class="w-full h-auto">
                @else
                    <div class="py-10 text-center text-gray-400 text-xs">Bukti tidak ditemukan</div>
                @endif
            </div>

            <button onclick="document.getElementById('modalBukti').classList.add('hidden')"
                class="w-full mt-4 bg-gray-900 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">
                TUTUP
            </button>
        </div>
    </div>
@endsection
