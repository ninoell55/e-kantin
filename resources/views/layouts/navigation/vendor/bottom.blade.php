<!-- Bottom Navigation Bar -->
<nav class="fixed bottom-0 left-0 right-0 bg-[#1e2756] rounded-t-[25px] p-3 shadow-2xl z-50">
    <ul class="flex items-center justify-around max-w-md mx-auto">
        <li class="group text-center">
            <a href="{{ route('vendor.dashboard') }}"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>
            <span class="text-xs text-white mt-1 block">Dashboard</span>
        </li>

        <li class="group text-center">
            <a href="#"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </a>
            <span class="text-xs text-white mt-1 block">Shop</span>
        </li>

        <li class="group text-center">
            <a href="#"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </a>
            <span class="text-xs text-white mt-1 block">Products</span>
        </li>

        <li class="group text-center">
            <a href="#"
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </a>
            <span class="text-xs text-white mt-1 block">Orders</span>
        </li>

        <li class="relative group text-center">
            <button
                class="flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 group-hover:bg-[#8b0000] text-white outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div
                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-4 hidden group-hover:block w-28 bg-white rounded-lg shadow-xl animate-fade-up border border-gray-100">
                <a href="{{ route('logout') }}"
                    class="block px-4 py-3 text-xs text-red-600 hover:bg-red-50 font-bold text-center">
                    Log Out
                </a>
            </div>
            <span class="text-xs text-white mt-1 block">Profile</span>
        </li>
    </ul>
</nav>

<style>
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translate(-50%, 10px);
        }

        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    .animate-fade-up {
        animation: fadeUp 0.2s ease-out forwards;
    }
</style>
