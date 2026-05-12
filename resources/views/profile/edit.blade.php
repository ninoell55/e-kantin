@extends('layouts.vendor')

@section('content')
    <div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">
        
        <div class="mb-6">
            <h3 class="text-[#1e2a5e] font-black text-xl flex items-center gap-2">
                <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                Pengaturan Profil
            </h3>
            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">
                Kelola informasi akun anda
            </p>
        </div>

        <div class="space-y-6">
            <div class="p-5 bg-white border-2 border-gray-50 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    <h4 class="text-sm font-bold text-[#1e2a5e] mb-4 uppercase tracking-tight">Informasi Umum</h4>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-5 bg-white border-2 border-gray-50 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    <h4 class="text-sm font-bold text-[#1e2a5e] mb-4 uppercase tracking-tight">Keamanan</h4>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-5 bg-red-50 border-2 border-red-100 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    <h4 class="text-sm font-bold text-red-600 mb-4 uppercase tracking-tight">Bahaya</h4>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full bg-[#7f1d1d] text-white py-3 rounded-2xl text-xs font-black uppercase shadow-lg active:scale-95 transition-all">
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>

    <style>
        /* Sembunyikan scrollbar agar tetap estetik sesuai tema mobile */
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body::-webkit-scrollbar {
            display: none;
        }
        
        /* Penyesuaian input bawaan Laravel agar senada dengan tema */
        input[type="text"], input[type="email"], input[type="password"] {
            border-radius: 12px !important;
            border-color: #f3f4f6 !important;
            font-size: 12px !important;
        }
    </style>
@endsection
