<nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-md transition-all duration-300">
    <div
        class="bg-[#0f153b]/95 border border-slate-800 p-2 rounded-3xl shadow-[0_20px_40px_-5px_rgba(0,0,0,0.5)] backdrop-blur-xl">
        <ul class="flex items-center justify-between gap-1 px-1">

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('customer.dashboard'))
                    <a href="{{ route('customer.dashboard') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-smart-home text-base"></i>
                        <span class="font-extrabold text-[11px]">Beranda</span>
                    </a>
                @else
                    <a href="{{ route('customer.dashboard') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-smart-home text-xl"></i>
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('customer.cart.index'))
                    <a href="{{ route('customer.cart.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-shopping-cart text-base"></i>
                        <span class="font-extrabold text-[11px]">Keranjang</span>
                    </a>
                @else
                    <a href="{{ route('customer.cart.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200 relative">
                        <i class="ti ti-shopping-cart text-xl"></i>
                        @if (session('cart_count') && session('cart_count') > 0)
                            <span
                                class="absolute top-2 right-2 bg-primary text-tertiary text-[9px] font-black w-4 h-4 rounded-full flex items-center justify-center border border-[#0f153b]">
                                {{ session('cart_count') }}
                            </span>
                        @endif
                    </a>
                @endif
            </li>

            <li class="flex-1 flex justify-center">
                @if (request()->routeIs('customer.order.index'))
                    <a href="{{ route('customer.order.index') }}"
                        class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-[18px] bg-primary text-tertiary font-black text-xs tracking-wide shadow-lg shadow-primary/50 transition-all duration-300 w-full">
                        <i class="ti ti-clipboard-list text-base"></i>
                        <span class="font-extrabold text-[11px]">Pesanan</span>
                    </a>
                @else
                    <a href="{{ route('customer.order.index') }}"
                        class="flex items-center justify-center w-11 h-11 rounded-[18px] text-slate-400 hover:text-tertiary hover:bg-white/5 transition-all duration-200">
                        <i class="ti ti-clipboard-list text-xl"></i>
                    </a>
                @endif
            </li>

        </ul>
    </div>
</nav>
