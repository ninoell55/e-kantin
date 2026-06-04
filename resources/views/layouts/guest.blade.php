<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Foody E-Kantin'))</title>

    <!-- Tabler Icons Webfont -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-white min-h-screen flex flex-col justify-between antialiased overflow-x-hidden selection:bg-primary selection:text-white">

    <div>
        <!-- Banner Bagian Atas dengan Efek Lengkung Geometris -->
        <div class="relative h-72 bg-cover bg-center animate-fade-in-down duration-700 ease-out"
            style="background-image: url('{{ asset('images/login.png') }}'); border-bottom-left-radius: 50% 20%; border-bottom-right-radius: 50% 20%;">

            <div class="absolute inset-0 bg-secondary/10"
                style="border-bottom-left-radius: 50% 20%; border-bottom-right-radius: 50% 20%;"></div>

            <!-- Floating Logo Center -->
            <div
                class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 z-10 transition-all duration-500 hover:scale-105">
                <div
                    class="p-2.5 rounded-4xl shadow-xl w-24 h-24 flex items-center justify-center border border-gray-50/50 backdrop-blur-sm animate-pop-in">
                    <div class="flex items-center gap-3 shrink-0">
                        <div
                            class="relative flex items-center justify-center w-16 h-16 rounded-full bg-linear-to-br from-primary to-secondary shadow-lg shadow-(--color-primary)/20">

                            <i class="ti ti-bowl-spoon text-white text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wadah Utama Pengisian Form ($slot dinamis masuk ke sini) -->
        <div class="w-full max-w-md mx-auto px-8 pt-20 transform move-up-smooth">
            {{ $slot }}
        </div>
    </div>

    <!-- Ruang Kosong Bawah / Spacing Tambahan -->
    <div class="pb-12"></div>

    <!-- Custom Animation Stylesheet Injection -->
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
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
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
