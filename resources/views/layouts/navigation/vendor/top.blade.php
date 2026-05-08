<!-- Top Navigation Bar -->
<nav
    class="fixed top-0 left-0 right-0 bg-secondary/95 backdrop-blur-md text-white shadow-lg z-50 border-b border-white/10">
    <div class="container mx-auto flex items-center justify-between gap-4 px-4 py-3 max-w-md">

        <!-- Logo Section -->
        <div class="shrink-0 transition-transform hover:scale-105">
            <div
                class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-inner border border-white/20">
                <!-- Pastikan logo.png kamu punya background transparan -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain drop-shadow-md">
            </div>
        </div>

        <!-- Search Bar Section -->
        <div class="flex-1 group/search">
            <!-- Wrapper dengan ring focus agar interaktif saat diklik -->
            <div
                class="bg-[#F3E9DE] rounded-full px-4 py-2.5 flex items-center gap-2 shadow-inner border-2 border-transparent focus-within:border-tertiary focus-within:ring-2 focus-within:ring-tertiary/30 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-primary/60 group-focus-within/search:text-primary transition-colors"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Cari menu kantin..."
                    class="bg-transparent outline-none w-full text-primary placeholder-primary/50 text-sm font-inter font-medium">
            </div>
        </div>

        <!-- Profile & Dropdown Section -->
        <div class="relative group cursor-pointer">
            <!-- Avatar dengan ring gradient -->
            <div
                class="w-11 h-11 rounded-full p-0.5 bg-linear-to-tr from-tertiary to-yellow-100 shadow-md transition-transform duration-300 group-hover:scale-105">
                <img src="https://i.pravatar.cc/100" alt="Profile"
                    class="w-full h-full rounded-full object-cover border-2 border-secondary bg-white">
            </div>

            <!-- Dropdown Menu (Muncul saat hover) -->
            <div
                class="absolute right-0 mt-3 w-44 bg-white rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-50 border border-slate-100 overflow-hidden">
                <!-- Header Dropdown (Opsional, bikin UX lebih personal) -->
                <div class="px-4 py-3 bg-slate-50 border-b border-slate-100 text-left">
                    <p class="text-[10px] text-slate-500 font-inter uppercase tracking-wider">Akun Saya</p>
                    <p class="text-sm font-bold text-primary truncate">Jihan Syahira</p>
                </div>

                <!-- Tombol Logout -->
                <a href="{{ route('logout') }}"
                    class="flex items-center justify-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-bold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </a>
            </div>
        </div>

    </div>
</nav>
