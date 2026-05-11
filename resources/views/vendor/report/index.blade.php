@extends('layouts.vendor')

@section('content')
    <div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">
        
        <div class="mb-6">
            <h3 class="text-[#1e2a5e] font-black text-xl flex items-center gap-2">
                <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                Laporan Penjualan
            </h3>
            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">Pantau statistik kantin anda</p>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-6">
            <div class="bg-[#f8fafc] p-4 rounded-3xl border-2 border-gray-50">
                <p class="text-gray-400 text-[9px] font-bold uppercase tracking-tighter mb-1">Pendapatan Mei</p>
                <p class="text-[#1e2a5e] font-black text-base leading-none">Rp 2.450.000</p>
                <div class="mt-2 flex items-center gap-1 text-green-500 text-[8px] font-bold">
                    <i class="ti ti-trending-up"></i> +12% dari bulan lalu
                </div>
            </div>

            <div class="bg-[#f8fafc] p-4 rounded-3xl border-2 border-gray-50">
                <p class="text-gray-400 text-[9px] font-bold uppercase tracking-tighter mb-1">Pesanan Selesai</p>
                <p class="text-[#7f1d1d] font-black text-base leading-none">156 Order</p>
                <div class="mt-2 flex items-center gap-1 text-gray-400 text-[8px] font-bold">
                    <i class="ti ti-calendar"></i> Per 8 Mei 2026
                </div>
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-4 mb-4 no-scrollbar">
            <button class="px-4 py-2 bg-[#1e2a5e] text-white rounded-xl text-[10px] font-bold whitespace-nowrap shadow-md">Harian</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">Mingguan</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">Bulanan</button>
        </div>

        <div class="bg-[#1e2a5e] p-5 rounded-3xl shadow-lg mb-8">
            <div class="flex justify-between items-end h-32 gap-2">
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-white/10 rounded-t-lg relative group h-[40%]">
                        <div class="absolute bottom-0 w-full bg-[#ffc61a] rounded-t-lg transition-all h-[60%] group-hover:h-[80%]"></div>
                    </div>
                    <span class="text-[8px] text-white/50 font-bold uppercase">Sen</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-white/10 rounded-t-lg relative h-[60%]">
                        <div class="absolute bottom-0 w-full bg-[#ffc61a] rounded-t-lg h-[40%]"></div>
                    </div>
                    <span class="text-[8px] text-white/50 font-bold uppercase">Sel</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-white/10 rounded-t-lg relative h-[80%]">
                        <div class="absolute bottom-0 w-full bg-[#ffc61a] rounded-t-lg h-[90%]"></div>
                    </div>
                    <span class="text-[8px] text-white/50 font-bold uppercase">Rab</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-white/10 rounded-t-lg relative h-[50%]">
                        <div class="absolute bottom-0 w-full bg-[#ffc61a] rounded-t-lg h-[70%]"></div>
                    </div>
                    <span class="text-[8px] text-white/50 font-bold uppercase">Kam</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-white/10 rounded-t-lg relative h-[90%]">
                        <div class="absolute bottom-0 w-full bg-[#ffc61a] rounded-t-lg h-[85%] border-2 border-white"></div>
                    </div>
                    <span class="text-[8px] text-white font-black uppercase">Jum</span>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h3 class="text-gray-800 font-bold text-sm mb-4 flex items-center gap-2">
                <span class="w-1 h-4 bg-[#7f1d1d] rounded-full"></span>
                Produk Terlaris
            </h3>

            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 border-2 border-gray-50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#dcfce7] rounded-xl flex items-center justify-center text-xl">🍕</div>
                        <div>
                            <p class="text-[11px] font-black text-gray-800 uppercase">Pizza Pepperoni</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">42 Terjual</p>
                        </div>
                    </div>
                    <p class="text-[11px] font-black text-[#1e2a5e]">Rp 630rb</p>
                </div>

                <div class="flex items-center justify-between p-3 border-2 border-gray-50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#fee2e2] rounded-xl flex items-center justify-center text-xl">🍜</div>
                        <div>
                            <p class="text-[11px] font-black text-gray-800 uppercase">Sphagetti Meatball</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">38 Terjual</p>
                        </div>
                    </div>
                    <p class="text-[11px] font-black text-[#1e2a5e]">Rp 570rb</p>
                </div>
            </div>
        </div>

    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection