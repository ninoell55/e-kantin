@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36 pt-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-800">Detail Pesanan</h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ $order->invoice_number }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xs">
                <!-- Status & Shop Info -->
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Toko</p>
                        <h3 class="font-black text-slate-800 text-lg">{{ $order->shop->name }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                        <span
                            class="inline-block px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider
                            {{ $order->status == 'completed'
                                ? 'bg-emerald-50 text-emerald-600'
                                : ($order->status == 'cancelled'
                                    ? 'bg-red-50 text-[#730f00]'
                                    : 'bg-blue-50 text-[#1b2563]') }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="grid grid-cols-2 gap-4 mb-8 bg-slate-50 p-4 rounded-2xl">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase">Tipe</p>
                        <p class="text-xs font-black text-slate-700 mt-0.5">{{ ucfirst($order->order_type) }}</p>
                    </div>
                    @if ($order->delivery_location)
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase">Lokasi</p>
                            <p class="text-xs font-black text-slate-700 mt-0.5">{{ $order->delivery_location }}</p>
                        </div>
                    @endif
                </div>

                <!-- Items -->
                <div class="space-y-4 border-b border-slate-100 pb-6 mb-6">
                    @foreach ($order->orderItems as $item)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span
                                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 text-[10px] font-black text-slate-400">
                                    {{ $item->quantity }}x
                                </span>
                                <span class="text-sm font-semibold text-slate-700">{{ $item->product_name }}</span>
                            </div>
                            <span class="text-sm font-black text-slate-800">Rp
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="flex justify-between items-center">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Bayar</span>
                    <span class="text-2xl font-black text-[#730f00]">Rp
                        {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <!-- Verification Notice -->
                @if ($order->payment_method == 'transfer' && $order->payment_status == 'verifying')
                    <div
                        class="mt-8 p-4 bg-amber-50 rounded-2xl text-amber-800 text-[11px] font-black text-center border border-amber-100">
                        <i class="ti ti-clock mr-1"></i> Bukti transfer sedang dalam verifikasi.
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <a href="{{ route('customer.order.index') }}"
                class="block w-full mt-8 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-[#1b2563] transition-all">
                Kembali ke Riwayat
            </a>
        </div>
    </div>
@endsection
