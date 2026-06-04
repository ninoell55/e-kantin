@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36">
        <div class="max-w-2xl mx-auto py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-800 flex items-center gap-2">
                    <i class="ti ti-shopping-cart text-[#1b2563]"></i> Keranjang
                </h1>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola pesanan jajananmu</p>
            </div>

            @if (session('cart') && count(session('cart')) > 0)
                <div class="space-y-4">
                    <!-- Shop Label -->
                    <div class="flex items-center gap-2 px-2">
                        <i class="ti ti-store text-[#1b2563]"></i>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                            {{ session('cart')[array_key_first(session('cart'))]['shop_name'] }}
                        </span>
                    </div>

                    @foreach (session('cart') as $id => $details)
                        <div
                            class="bg-white p-5 rounded-[2.5rem] shadow-xs border border-slate-100 flex items-center gap-4">
                            <!-- Image -->
                            <div
                                class="w-20 h-20 bg-slate-50 rounded-2xl overflow-hidden flex-shrink-0 border border-slate-100">
                                <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/400x400' }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <!-- Info -->
                            <div class="flex-1 min-w-0">
                                <h4 class="font-black text-slate-800 truncate">{{ $details['name'] }}</h4>
                                <p class="text-xs font-black text-[#730f00] mt-0.5">Rp
                                    {{ number_format($details['price'], 0, ',', '.') }}</p>

                                <div class="flex items-center gap-3 mt-3">
                                    <!-- Counter -->
                                    <div class="flex items-center bg-slate-50 rounded-xl p-1 border border-slate-100">
                                        <form action="{{ route('customer.cart.update', $id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                            <button type="submit"
                                                class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-[#1b2563] {{ $details['quantity'] <= 1 ? 'opacity-30 pointer-events-none' : '' }}">
                                                <i class="ti ti-minus text-xs font-black"></i>
                                            </button>
                                        </form>

                                        <span
                                            class="font-black text-slate-800 text-sm w-8 text-center">{{ $details['quantity'] }}</span>

                                        <form action="{{ route('customer.cart.update', $id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                            <button type="submit"
                                                class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-[#1b2563]">
                                                <i class="ti ti-plus text-xs font-black"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete -->
                            <form action="{{ route('customer.cart.destroy', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-10 h-10 flex items-center justify-center text-red-300 hover:bg-red-50 hover:text-[#730f00] rounded-2xl transition-all">
                                    <i class="ti ti-trash text-base"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Total Payment Card -->
                <div class="mt-8 bg-[#1b2563] rounded-[2.5rem] p-8 text-white shadow-xl shadow-[#1b2563]/20">
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-blue-200 font-bold text-xs uppercase tracking-widest">Total Bayar</span>
                        <span class="text-2xl font-black tracking-tight">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('customer.checkout') }}"
                        class="block w-full bg-white text-[#1b2563] text-center py-4 rounded-2xl font-black text-sm uppercase tracking-wider hover:bg-blue-50 transition-all active:scale-[0.98]">
                        Checkout Sekarang
                    </a>
                </div>
            @else
                <!-- Empty State -->
                <div class="py-20 text-center">
                    <div
                        class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 border border-slate-100 shadow-sm">
                        <i class="ti ti-shopping-cart-off text-4xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-500 font-black">Keranjang masih kosong</p>
                    <a href="{{ route('customer.dashboard') }}"
                        class="inline-block mt-4 text-[#1b2563] font-black text-[10px] uppercase tracking-widest border-b-2 border-[#1b2563]">
                        Mulai Jajan
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
