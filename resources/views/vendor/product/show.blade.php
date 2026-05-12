@extends('layouts.vendor')

@section('content')
<div class="max-w-md mx-auto px-6 pt-[100px] pb-[110px] min-h-screen bg-white">
    
    <div class="mb-6">
        <h2 class="text-[#1e2a5e] font-black text-2xl tracking-tight leading-none">
            (Nama Produk)
        </h2>
    </div>

    <div class="w-full aspect-square rounded-[40px] border-[6px] border-[#1e2a5e] overflow-hidden shadow-sm mb-8">
        <img src="https://via.placeholder.com/400" alt="Detail Produk" class="w-full h-full object-cover">
    </div>

    <div class="flex justify-center gap-6 mb-10">
        <a href="{{ route('vendor.product.edit') }}" 
           class="w-14 h-14 bg-[#1e2a5e] rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-all border-2 border-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>

        <button onclick="confirm('Yakin ingin menghapus produk ini?')"
           class="w-14 h-14 bg-[#7f1d1d] rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-all border-2 border-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>

    <div class="px-2">
        <p class="text-gray-700 font-medium text-sm leading-relaxed text-center italic">
            "Terbuat dari daging ikan sapu sapu pedes isinya sayuran ada sirip ikan dan campuran air kali ciliwung dikit"
        </p>
    </div>

</div>

<style>
    p {
        font-family: 'Inter', sans-serif;
    }
</style>
@endsection