<nav class="fixed bottom-0 left-0 right-0 bg-[#1e2756] rounded-t-[25px] p-3 shadow-2xl z-50">
    <ul class="flex items-center justify-around max-w-md mx-auto">
        <li class="group text-center">
            <a href="{{ route('vendor.dashboard') }}"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>
            <span class="text-[10px] text-white mt-1 block">Beranda</span>
        </li>

        <li class="group text-center">
            <a href="{{ route('vendor.product.index') }}"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </a>
            <span class="text-[10px] text-white mt-1 block">Produk</span>
        </li>

        <li class="group text-center">
            <a href="{{ route('vendor.order.index') }}"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </a>
            <span class="text-[10px] text-white mt-1 block">Pesanan</span>
        </li>

        <li class="group text-center">
            <a href="{{ route('vendor.report.index') }}"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </a>
            <span class="text-[10px] text-white mt-1 block">Laporan</span>
        </li>

       
    </ul>
</nav>