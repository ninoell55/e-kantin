<x-guest-layout>
    <!-- Header Title -->
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-primary tracking-wide drop-shadow-sm">Login</h2>
        <p class="text-xs text-gray-400 mt-2 font-medium tracking-wide">Masuk untuk melanjutkan.</p>
    </div>

    <!-- Session Status Alert -->
    @if (session('status'))
        <div
            class="mb-5 font-medium text-sm text-green-600 text-center bg-green-50 py-2.5 rounded-xl border border-green-200 animate-pulse">
            {{ session('status') }}
        </div>
    @endif

    <!-- Authentication Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!--Input Field -->
        <div class="transition-all duration-300 transform focus-within:translate-x-1">
            <label for="login_identifier"
                class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2 px-1">
                EMAIL / NOMOR IDENTITAS (NIS/NIP)
            </label>
            <input id="login_identifier" type="text" name="login_identifier" value="{{ old('login_identifier') }}"
                required autofocus
                class="w-full px-5 py-4 bg-[#f0f0f0] border-2 border-transparent text-gray-800 rounded-2xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-300 text-sm font-medium placeholder-gray-400 shadow-inner focus:shadow-md"
                placeholder="Email, NIS siswa, atau NIP guru" />

            @if ($errors->get('login_identifier'))
                <p class="text-xs text-red-600 mt-1.5 px-1 flex items-center gap-1 animate-shake">
                    <span class="text-red-500">⚠</span> {{ $errors->first('login_identifier') }}
                </p>
            @endif
        </div>

        <!-- Password Input Field -->
        <div class="transition-all duration-300 transform focus-within:translate-x-1">
            <label for="password" class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2 px-1">
                KATA SANDI
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-5 py-4 bg-[#f0f0f0] border-2 border-transparent text-gray-800 rounded-2xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-300 text-sm font-medium placeholder-gray-400 shadow-inner focus:shadow-md"
                placeholder="kata sandi" />

            @if ($errors->get('password'))
                <p class="text-xs text-red-600 mt-1.5 px-1 flex items-center gap-1 animate-shake">
                    <span class="text-red-500">⚠</span> {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        <!-- Submit Action Button -->
        <div class="pt-4">
            <button type="submit"
                class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-primary/20 hover:bg-primary/95 hover:shadow-xl hover:shadow-primary/30 active:scale-[0.98] transition-all duration-200 tracking-wider text-sm flex items-center justify-center gap-2">
                <span>Masuk</span>
            </button>
        </div>

        <!-- Remember Me Config Token -->
        <input type="hidden" name="remember" value="1">
    </form>
</x-guest-layout>
