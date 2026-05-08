@extends('layouts.vendor')

@section('content')
<div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">
    
    <div class="mb-6">
        <h3 class="text-[#1e2a5e] font-black text-xl flex items-center gap-2">
            <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
            Pesanan Masuk
        </h3>
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">Kelola antrean pelanggan</p>
    </div>

    <div class="flex gap-2 overflow-x-auto pb-4 mb-4 no-scrollbar">
        <button class="px-4 py-2 bg-[#7f1d1d] text-white rounded-xl text-[10px] font-bold whitespace-nowrap shadow-md">BARU (3)</button>
        <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">DIPROSES</button>
        <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">SELESAI</button>
    </div>

    <div class="space-y-4">
        
        <div class="bg-white border-2 border-gray-100 rounded-2xl p-4 shadow-sm">
            <div class="flex justify-between items-start mb-3 pb-2 border-b border-dashed">
                <div>
                    <h4 class="text-sm font-black text-gray-800">#ORD-99281</h4>
                    <p class="text-[10px] text-gray-400 font-bold">12:45 WIB</p>
                </div>
                <span class="bg-amber-100 text-amber-600 text-[9px] px-2 py-1 rounded-lg font-black uppercase">Menunggu</span>
            </div>

            <div class="space-y-3 mb-4">
                <div class="flex items-center gap-3">
                    <img src="https://via.placeholder.com/50" class="w-10 h-10 rounded-xl object-cover">
                    <div class="flex-1">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Pizza Pepperoni</p>
                        <p class="text-[10px] text-gray-400">Jumlah : 2</p>
                    </div>
                    <p class="text-[11px] font-black text-[#1e2a5e]">Rp 30.000</p>
                </div>
            </div>

            <div class="flex gap-2">
                <button class="flex-1 bg-gray-100 text-gray-500 py-2.5 rounded-xl text-[11px] font-black uppercase transition-all active:scale-95">
                    Tolak
                </button>
                <button class="flex-[2] bg-[#1e2a5e] text-white py-2.5 rounded-xl text-[11px] font-black uppercase shadow-lg shadow-blue-900/20 transition-all active:scale-95">
                    Terima & Proses
                </button>
            </div>
        </div>

    </div>
</div>
@endsection