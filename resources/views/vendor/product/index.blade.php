@extends('layouts.vendor')

@section('content')
    <div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-gray-800 font-black text-xl flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Produk
                </h3>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">Total: {{ count($products ?? range(1,15)) }} Item</p>
            </div>
            
            <button class="bg-[#7f1d1d] text-white w-10 h-10 rounded-2xl flex items-center justify-center shadow-lg active:scale-90 transition-all border-2 border-white">
                <i class="ti ti-plus text-xl"></i>
            </button>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-4 mb-2 no-scrollbar">
            <button class="px-4 py-2 bg-[#1e2a5e] text-white rounded-xl text-[10px] font-bold whitespace-nowrap shadow-sm">SEMUA</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">MINUMAN</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">MAKANAN BERAT</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-[10px] font-bold whitespace-nowrap">SNACK</button>
        </div>

        <div class="grid grid-cols-3 gap-x-3 gap-y-6">
            @php
                $items = isset($products) && count($products) > 0 ? $products : range(1, 15);
            @endphp

            @foreach($items as $index => $p)
            <div class="flex flex-col animate-fade-in group cursor-pointer">
                <div class="w-full aspect-square bg-slate-50 rounded-2xl border-2 border-gray-100 overflow-hidden relative shadow-sm transition-all group-active:scale-95">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                         <i class="ti ti-pencil text-white text-xl"></i>
                    </div>

                    <div class="absolute inset-0 flex flex-col">
                        <div class="h-[60%] bg-[#dcfce7] flex items-center justify-center">
                             <div class="w-8 h-4 bg-white/40 rounded-full blur-[1px]"></div>
                        </div>
                        <div class="h-[40%] bg-[#86efac]"></div>
                    </div>

                    <div class="absolute top-1 right-1">
                        <span class="flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                    </div>
                </div>

                <div class="w-full {{ $index % 2 == 0 ? 'bg-[#7f1d1d]' : 'bg-[#1e2a5e]' }} text-white text-[9px] text-center py-1.5 mt-2 rounded-xl font-extrabold shadow-md truncate px-1 uppercase">
                    {{ is_object($p) ? $p->name : 'Nama Produk #' . ($index + 1) }}
                </div>
                
                <div class="flex justify-center items-center gap-1 mt-1.5">
                    <span class="text-xs font-black text-gray-800">Rp 15.000</span>
                </div>

                <span class="text-[8px] text-gray-400 font-bold text-center uppercase tracking-tighter">Stok: 24</span>
            </div>
            @endforeach
        </div>

    </div>

    <style>
        /* Animasi halusan untuk transisi */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Hilangkan scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
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