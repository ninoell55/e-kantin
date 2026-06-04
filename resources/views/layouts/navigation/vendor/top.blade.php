<nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
    <!-- Container Utama: Sengaja max-w-full sesuai kebutuhan desainmu -->
    <div
        class="container mx-auto max-w-full px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-8 py-3 md:py-2.5">

        <!-- Baris Atas: Logo & Profil (Selalu presisi di HP) -->
        <div class="flex items-center justify-between w-full md:w-auto shrink-0">

            <!-- Logo Brand -->
            <div class="flex items-center gap-3 shrink-0">
                <div
                    class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-linear-to-br from-primary to-secondary shadow-lg shadow-(--color-primary)/20">

                    <i class="ti ti-bowl-spoon text-white text-2xl"></i>

                    <!-- Accent -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-tertiary border-2 border-white">
                    </div>
                </div>

                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-tight text-primary">
                        Foody
                    </span>
                    <span class="text-[10px] font-medium tracking-tighter text-gray-500">
                        E-Kantin SMKN 1 Cirebon
                    </span>
                </div>
            </div>

            <!-- Profile Dropdown Mobile (Hanya muncul di HP) -->
            <div class="relative group cursor-pointer md:hidden">
                <div class="w-10 h-10 rounded-xl p-0.5 bg-linear-to-tr from-amber-500 to-amber-300 shadow-sm">
                    <div
                        class="w-full h-full rounded-[10px] flex items-center justify-center bg-slate-900 text-white font-bold text-sm uppercase select-none">
                        {{ Auth::user()->name[0] }}
                    </div>
                </div>

                <!-- Dropdown Menu Mobile -->
                <div
                    class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 z-50 border border-slate-100 overflow-hidden">
                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Akun Saya</p>
                        <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('vendor.profile.edit') }}"
                        class="flex items-center gap-2 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold border-b border-slate-50">
                        <i class="ti ti-user text-base text-slate-400"></i> Edit Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-bold text-left">
                            <i class="ti ti-logout text-base"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Dropdown Desktop (Hanya muncul di layar lebar) -->
        <div class="relative group cursor-pointer hidden md:block shrink-0">
            <div class="flex items-center gap-3 pl-4 border-l border-slate-200/80">
                <!-- Info Text di samping avatar agar area kanan berbobot -->
                <div class="flex-col text-right leading-none hidden sm:flex">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-amber-600 transition-colors">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] font-bold text-slate-400 tracking-wider uppercase mt-0.5">Penjual</span>
                </div>
                <!-- Avatar Kotak Modern -->
                <div
                    class="w-10 h-10 md:w-11 md:h-11 rounded-xl p-0.5 bg-linear-to-tr from-amber-500 to-amber-300 shadow-sm transition-transform duration-200 group-hover:scale-105">
                    <div
                        class="w-full h-full rounded-[10px] flex items-center justify-center bg-slate-900 text-white font-black text-base uppercase select-none">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <!-- Dropdown Menu Desktop -->
            <div
                class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 z-50 border border-slate-100 overflow-hidden">
                <div class="px-4 py-3 bg-slate-50/80 border-b border-slate-100">
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Akun Saya</p>
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('vendor.profile.edit') }}"
                    class="flex items-center gap-2 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold border-b border-slate-100 transition-colors">
                    <i class="ti ti-user text-base text-slate-400"></i> Edit Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors text-left">
                        <i class="ti ti-logout text-base"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer Layout (Wajib agar konten di bawah tidak tertutup navbar fixed) -->
<div class="h-24"></div>
