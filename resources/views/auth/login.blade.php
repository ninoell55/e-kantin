<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex flex-col justify-between antialiased overflow-x-hidden">

    <div>
        <div class="relative h-72 bg-cover bg-center animate-fade-in-down duration-700 ease-out" 
             style="background-image: url('{{ asset('images/login.png') }}'); border-bottom-left-radius: 50% 20%; border-bottom-right-radius: 50% 20%;">
            
            <div class="absolute inset-0 bg-[#661a15]/10" style="border-bottom-left-radius: 50% 20%; border-bottom-right-radius: 50% 20%;"></div>
            
            <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 z-10 transition-all duration-500 hover:scale-105">
                <div class="bg-white p-2.5 rounded-2xl shadow-xl w-24 h-24 flex items-center justify-center border border-gray-50/50 backdrop-blur-sm animate-pop-in">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-auto object-contain">
                </div>
            </div>
        </div>

        <div class="w-full max-w-md mx-auto px-8 pt-20 transform move-up-smooth">
            
            <div class="text-center mb-10">
                <h2 class="text-4xl font-extrabold text-[#661a15] tracking-wide drop-shadow-sm">Login</h2>
                <p class="text-xs text-gray-400 mt-2 font-medium tracking-wide">Masuk untuk melanjutkan.</p>
            </div>

            @if (session('status'))
                <div class="mb-5 font-medium text-sm text-green-600 text-center bg-green-50 py-2.5 rounded-xl border border-green-200 animate-pulse">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="transition-all duration-300 transform focus-within:translate-x-1">
                    <label for="email" class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2 px-1">
                        NAMA
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-5 py-4 bg-[#f0f0f0] border-2 border-transparent text-gray-800 rounded-2xl focus:bg-white focus:border-[#1f285a] focus:ring-0 transition-all duration-300 text-sm font-medium placeholder-gray-400 shadow-inner focus:shadow-md"
                        placeholder="nama" />
                    
                    @if ($errors->get('email'))
                        <p class="text-xs text-red-600 mt-1.5 px-1 flex items-center gap-1 animate-shake">
                            <span class="text-red-500">⚠</span> {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="transition-all duration-300 transform focus-within:translate-x-1">
                    <label for="password" class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2 px-1">
                        KATA SANDI
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-5 py-4 bg-[#f0f0f0] border-2 border-transparent text-gray-800 rounded-2xl focus:bg-white focus:border-[#1f285a] focus:ring-0 transition-all duration-300 text-sm font-medium placeholder-gray-400 shadow-inner focus:shadow-md"
                        placeholder="kata sandi" />
                    
                    @if ($errors->get('password'))
                        <p class="text-xs text-red-600 mt-1.5 px-1 flex items-center gap-1 animate-shake">
                            <span class="text-red-500">⚠</span> {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full py-4 bg-[#1f285a] text-white font-bold rounded-2xl shadow-lg shadow-[#1f285a]/20 hover:bg-[#151b3d] hover:shadow-xl hover:shadow-[#1f285a]/30 active:scale-[0.98] transition-all duration-200 tracking-wider text-sm flex items-center justify-center gap-2">
                        <span>Masuk</span>
                    </button>
                </div>

                <input type="hidden" name="remember" value="1">
            </form>
        </div>
    </div>

    <div class="pb-12"></div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .move-up-smooth {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-pop-in {
            animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }
    </style>

</body>
</html>