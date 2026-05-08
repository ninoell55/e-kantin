@extends('layouts.vendor')

@section('content')
    <div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">

        <div class="grid grid-cols-2 gap-3 mb-8">
            <div class="bg-[#1e2a5e] p-4 rounded-3xl flex flex-col justify-between min-h-[120px] shadow-lg border border-white/10">
                <div class="flex items-center gap-2">
                    <div class="bg-[#ffc61a] p-1.5 rounded-xl shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#7c2d12]" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-white text-[11px] font-bold uppercase tracking-wider">Dompet</span>
                </div>
                <div>
                    <p class="text-white font-black text-lg">
                        Rp {{ number_format($shop->balance ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-white/50 text-[9px] uppercase tracking-tighter">Saldo Tersedia</p>
                </div>
            </div>

            <div class="bg-[#1e2a5e] p-4 rounded-3xl flex flex-col justify-between min-h-[120px] shadow-lg border border-white/10 relative">
                <div class="flex justify-between items-center w-full">
                    <span class="text-white/60 text-[9px] font-bold uppercase tracking-widest">Status</span>
                    <div class="flex items-center gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span id="dot-ping" class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $shop->is_open ? 'bg-green-400' : 'bg-red-400' }} opacity-75"></span>
                            <span id="dot-solid" class="relative inline-flex rounded-full h-2 w-2 {{ $shop->is_open ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        </span>
                        <span id="status-label" class="text-[9px] text-white font-bold uppercase tracking-tighter">
                            {{ $shop->is_open ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center pb-1">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="toggle-shop-status" class="sr-only peer" {{ $shop->is_open ? 'checked' : '' }}>
                        <div class="w-12 h-6 bg-slate-600 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[4px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 shadow-inner"></div>
                    </label>
                    <p id="shop-status-text" class="text-[#ffc61a] text-[10px] font-black mt-2 tracking-widest text-center leading-none">
                        {{ $shop->is_open ? 'WARUNG BUKA' : 'WARUNG TUTUP' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-gray-800 font-bold text-sm mb-5 flex items-center gap-2 px-2">
                <span class="w-1 h-4 bg-[#7f1d1d] rounded-full"></span>
                Kategori Menu
            </h3>
            
            <div class="flex justify-center gap-6">
                <div class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="bg-[#1e2a5e] w-14 h-14 rounded-2xl shadow-md flex items-center justify-center transition-transform group-active:scale-90">
                        <i class="ti ti-cup text-[#ffc61a] text-3xl"></i>
                    </div>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter">Minuman</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer text-center">
                    <div class="bg-[#7f1d1d] w-14 h-14 rounded-2xl shadow-md flex items-center justify-center transition-transform group-active:scale-90 border-2 border-white">
                        <i class="ti ti-soup text-[#ffc61a] text-3xl"></i>
                    </div>
                    <span class="text-[10px] font-bold text-gray-500 leading-tight uppercase tracking-tighter">Makanan<br>Berat</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer text-center">
                    <div class="bg-[#1e2a5e] w-14 h-14 rounded-2xl shadow-md flex items-center justify-center transition-transform group-active:scale-90">
                        <i class="ti ti-cookie text-[#ffc61a] text-3xl"></i>
                    </div>
                    <span class="text-[10px] font-bold text-gray-500 leading-tight uppercase tracking-tighter">Makanan<br>Ringan</span>
                </div>
            </div>
        </div>

        <div class="mb-5 px-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-800 font-bold text-sm flex items-center gap-2">
                    <span class="w-1 h-4 bg-[#7f1d1d] rounded-full"></span>
                    Daftar Produk
                </h3>
                <button class="bg-[#7f1d1d] text-white w-8 h-8 rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition-all border-2 border-white">
                    <i class="ti ti-plus text-lg"></i>
                </button>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-2 no-scrollbar">
                <button class="px-4 py-1.5 bg-[#1e2a5e] text-white rounded-xl text-[10px] font-bold whitespace-nowrap shadow-sm border border-[#1e2a5e]">SEMUA</button>
                <button class="px-4 py-1.5 bg-white text-gray-400 rounded-xl text-[10px] font-bold whitespace-nowrap shadow-sm border border-gray-100">MAKANAN</button>
                <button class="px-4 py-1.5 bg-white text-gray-400 rounded-xl text-[10px] font-bold whitespace-nowrap shadow-sm border border-gray-100">MINUMAN</button>
                <button class="px-4 py-1.5 bg-white text-gray-400 rounded-xl text-[10px] font-bold whitespace-nowrap shadow-sm border border-gray-100">SNACK</button>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-x-3 gap-y-6">
            @php
                $items = isset($products) && count($products) > 0 ? $products : range(1, 12);
            @endphp

            @foreach($items as $index => $p)
            <div class="flex flex-col animate-fade-in">
                <div class="w-full aspect-square bg-blue-50 rounded-2xl border-2 border-gray-100 overflow-hidden relative shadow-sm">
                    <div class="absolute inset-0 flex flex-col">
                        <div class="h-[60%] bg-[#dcfce7] flex items-center justify-center">
                             <div class="w-8 h-4 bg-white/60 rounded-full blur-[1px]"></div>
                        </div>
                        <div class="h-[40%] bg-[#86efac]"></div>
                    </div>
                </div>
                <div class="w-full {{ $index % 2 == 0 ? 'bg-[#7f1d1d]' : 'bg-[#1e2a5e]' }} text-white text-[9px] text-center py-1.5 mt-2 rounded-xl font-extrabold shadow-md uppercase px-1 truncate">
                    PRODUK #{{ $loop->iteration }}
                </div>
                <span class="text-xs font-black text-gray-800 mt-1.5 text-center leading-none">Rp 15.000</span>
            </div>
            @endforeach
        </div>

    </div>

    <style>
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body::-webkit-scrollbar {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-shop-status');
            const statusText = document.getElementById('shop-status-text');
            const statusLabel = document.getElementById('status-label');
            const dotPing = document.getElementById('dot-ping');
            const dotSolid = document.getElementById('dot-solid');

            if (toggleBtn) {
                toggleBtn.addEventListener('change', function() {
                    const isOpen = this.checked;
                    
                    statusText.textContent = isOpen ? 'WARUNG BUKA' : 'WARUNG TUTUP';
                    statusLabel.textContent = isOpen ? 'Aktif' : 'Nonaktif';
                    
                    if(isOpen) {
                        dotPing.classList.replace('bg-red-400', 'bg-green-400');
                        dotSolid.classList.replace('bg-red-500', 'bg-green-500');
                    } else {
                        dotPing.classList.replace('bg-green-400', 'bg-red-400');
                        dotSolid.classList.replace('bg-green-500', 'bg-red-500');
                    }

                    fetch('{{ route('vendor.shop.toggle-status') }}', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ is_open: isOpen })
                    });
                });
            }
        });
    </script>
@endsection