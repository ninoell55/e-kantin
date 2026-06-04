@extends('layouts.customer')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36 pt-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-800">Riwayat Pesanan</h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Daftar transaksi jajananmu</p>
            </div>

            <div class="space-y-4">
                @forelse($orders as $order)
                    <a href="{{ route('customer.order.show', $order->id) }}"
                        class="block bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-xs hover:shadow-md hover:border-[#1b2563]/20 transition-all group">
                        <div class="flex justify-between items-center mb-4">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $order->invoice_number }}</span>

                            <span
                                class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider
                                {{ $order->status == 'completed'
                                    ? 'bg-emerald-50 text-emerald-600'
                                    : ($order->status == 'cancelled'
                                        ? 'bg-red-50 text-[#730f00]'
                                        : 'bg-blue-50 text-[#1b2563]') }}">
                                {{ $order->status }}
                            </span>
                        </div>

                        <div class="flex justify-between items-end">
                            <div>
                                <h3 class="font-black text-slate-800">{{ $order->shop->name }}</h3>
                                <p class="text-[11px] font-bold text-slate-400 mt-1">
                                    {{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <p class="text-sm font-black text-[#730f00]">Rp
                                {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-20 bg-white rounded-[2.5rem] border border-slate-100 border-dashed">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ti ti-shopping-cart-off text-3xl text-slate-300"></i>
                        </div>
                        <p class="text-slate-500 font-black">Belum ada pesanan.</p>
                        <a href="{{ route('customer.dashboard') }}"
                            class="text-[10px] font-black text-[#1b2563] uppercase tracking-widest mt-2 inline-block border-b border-[#1b2563]">Mulai
                            Jajan</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
