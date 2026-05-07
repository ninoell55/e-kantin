<div class="flex justify-center pt-4"> 
    <nav class="w-[92%] max-w-md bg-[#7B0B00] rounded-[25px] p-3 shadow-lg">
        <div class="flex items-center justify-between gap-3 px-2">
            
            <div class="flex-shrink-0">
                <div class="w-11 h-11 bg-white/20 rounded-full flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                </div>
            </div>

            <div class="flex-1">
                <div class="bg-[#F3E9DE] rounded-full px-4 py-2 flex items-center justify-between">
                    <input 
                        type="text" 
                        placeholder="Cari ....." 
                        class="bg-transparent outline-none w-full text-[#3B4266] placeholder-[#3B4266] text-xs"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#3B4266]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <div class="relative group">
                <img 
                    src="https://i.pravatar.cc/100" 
                    alt="Profile"
                    class="w-11 h-11 rounded-full object-cover border-2 border-white cursor-pointer"
                >
                <div class="absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                    <a href="/logout" class="block px-4 py-3 text-xs text-red-700 hover:bg-red-50 rounded-xl font-bold text-center">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</div>