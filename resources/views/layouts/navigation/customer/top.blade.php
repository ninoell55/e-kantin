<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Foody • SMKN 1 Cirebon</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-gray-50">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
        <!-- Logo - Pakai Icon dari Font Awesome -->

        <div class="shrink-0 transition-transform hover:scale-105">
            <div
                class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-inner border border-white/20">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain drop-shadow-md">
            </div>
        </div>
        
        <!-- Nav Desktop -->
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('customer.dashboard') }}" class="text-gray-600 hover:text-blue-900 transition font-medium text-sm">Beranda</a>
            <a href="{{ route('customer.menu') }}" class="text-gray-600 hover:text-blue-900 transition font-medium text-sm">Menu</a>
            <a href="{{ route('customer.tracking') }}" class="text-gray-600 hover:text-blue-900 transition font-medium text-sm">Tracking</a>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-4">
            <!-- Cart -->
            <a href="{{ route('customer.cart') }}" class="relative">
                <div class="bg-yellow-400/10 p-2 rounded-full">
                    <i class="fas fa-shopping-bag text-red-700 text-lg"></i>
                </div>
                <span class="cart-badge absolute -top-1 -right-1 bg-red-700 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-sm">0</span>
            </a>
            
            <!-- Profile -->
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full bg-gradient-to-r from-blue-900 to-red-700 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                    <i class="fas fa-user text-xs"></i>
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-semibold text-gray-800">
                         {{ Auth::user()->name }}
            </p>
                    <p class="text-[10px] text-gray-400">Siswa Aktif</p>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-24">