@extends('layouts.customer')

@section('title', $shop->name)

@section('content')
    <div class="w-full min-h-screen bg-[#f8fafc] px-4 sm:px-6 lg:px-8 pb-36">
        <div class="space-y-8">

            <div
                class="relative bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100 flex flex-col sm:flex-row items-center gap-6 overflow-hidden">
                <div
                    class="w-32 h-32 sm:w-40 sm:h-40 rounded-[2rem] bg-slate-100 overflow-hidden shadow-inner flex-shrink-0 border border-slate-100">
                    @if ($shop->banner_path)
                        <img src="{{ asset('storage/' . $shop->banner_path) }}" alt="{{ $shop->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="ti ti-building-store text-5xl"></i>
                        </div>
                    @endif
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                        <h1 class="text-2xl font-black text-slate-800">{{ $shop->name }}</h1>
                        <span
                            class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-xl {{ $shop->is_open ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                            {{ $shop->is_open ? 'Buka' : 'Tutup' }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-lg mx-auto sm:mx-0">
                        {{ $shop->description ?? 'Selamat datang di ' . $shop->name . ', nikmati sajian lezat kami.' }}
                    </p>
                    <div class="mt-4 flex items-center justify-center sm:justify-start gap-4">
                        <span
                            class="text-xs font-bold text-slate-400 flex items-center gap-1.5 bg-slate-50 px-3 py-1.5 rounded-xl">
                            <i class="ti ti-credit-card"></i> {{ $shop->payment_info ?? 'Tunai' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-800 px-1 tracking-wide">Menu Tersedia di {{ $shop->name }}</h3>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @forelse ($shop->products as $product)
                        <div
                            class="bg-white border border-slate-100 rounded-[2rem] p-3 shadow-xs hover:shadow-md transition-all flex flex-col justify-between relative {{ $product->is_available && $shop->is_open ? '' : 'opacity-65' }}">
                            <div>
                                <div
                                    class="w-full aspect-square bg-slate-50 rounded-2xl overflow-hidden mb-3 relative shadow-inner">
                                    @if ($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                            <i class="ti ti-soup text-4xl"></i>
                                        </div>
                                    @endif

                                    @if (!$product->is_available || !$shop->is_open)
                                        <div
                                            class="absolute inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center">
                                            <span
                                                class="text-[10px] font-bold text-white bg-slate-700 px-2.5 py-1 rounded-xl shadow-md">
                                                {{ !$shop->is_open ? 'Tutup' : 'Habis' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <h5 class="font-bold text-slate-800 text-xs sm:text-sm tracking-wide truncate px-0.5">
                                    {{ $product->name }}</h5>
                            </div>

                            <div class="mt-4 pt-2 border-t border-slate-50 flex items-center justify-between px-0.5">
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-slate-400 leading-none">Harga</span>
                                    <span class="text-xs font-black text-[#730f00] mt-1">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>

                                @if ($product->is_available && $shop->is_open)
                                    <form action="{{ route('customer.cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-8 h-8 bg-[#1b2563] text-white rounded-xl flex items-center justify-center hover:bg-[#730f00] transition-colors shadow-xs active:scale-95 cursor-pointer">
                                            <i class="ti ti-plus text-sm"></i>
                                        </button>
                                    </form>
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
                            <div class="text-slate-300 mb-2"><i class="ti ti-soup-off text-5xl"></i></div>
                            <p class="text-sm text-slate-500 font-bold">Menu belum tersedia di stan ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
