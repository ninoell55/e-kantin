<nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-999 w-[calc(100%-2rem)] max-w-xl transition-all duration-300">
    <div
        class="bg-[#0f153b]/95 border border-slate-800 p-2 rounded-3xl shadow-[0_20px_40px_-5px_rgba(0,0,0,0.5)] backdrop-blur-xl">
        <ul class="flex items-center justify-between gap-1 px-1">

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.dashboard'))
                    <a href="{{ route('vendor.dashboard') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-smart-home text-base"></i>
                        <span class="font-extrabold text-[11px]">Beranda</span>
                    </a>
                @else
                    <a href="{{ route('vendor.dashboard') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-smart-home text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.product.*'))
                    <a href="{{ route('vendor.product.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-box text-base"></i>
                        <span class="font-extrabold text-[11px]">Produk</span>
                    </a>
                @else
                    <a href="{{ route('vendor.product.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-box text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.order.*'))
                    <a href="{{ route('vendor.order.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-clipboard-list text-base"></i>
                        <span class="font-extrabold text-[11px]">Pesanan</span>
                    </a>
                @else
                    <a href="{{ route('vendor.order.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-clipboard-list text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.bills.*'))
                    <a href="{{ route('vendor.bills.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-credit-card text-base"></i>
                        <span class="font-extrabold text-[11px]">Tagihan</span>
                    </a>
                @else
                    <a href="{{ route('vendor.bills.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-credit-card text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.report.*'))
                    <a href="{{ route('vendor.report.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-chart-bar text-base"></i>
                        <span class="font-extrabold text-[11px]">Laporan</span>
                    </a>
                @else
                    <a href="{{ route('vendor.report.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-chart-bar text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('vendor.shop.*'))
                    <a href="{{ route('vendor.shop.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-settings text-base"></i>
                        <span class="font-extrabold text-[11px]">Toko</span>
                    </a>
                @else
                    <a href="{{ route('vendor.shop.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-settings text-xl"></i>
                    </a>
                @endif
            </li>

        </ul>
    </div>
</nav>
