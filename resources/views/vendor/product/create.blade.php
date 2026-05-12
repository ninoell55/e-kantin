@extends('layouts.vendor')

@section('content')
<div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">
    
    <div class="mb-8">
        <h3 class="text-[#1e2a5e] font-black text-xl flex items-center gap-2">
            <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
            Tambah Produk
        </h3>
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">Masukan menu baru anda</p>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6 px-2">
        @csrf

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Nama Produk :</label>
            <input type="text" name="name" 
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Harga :</label>
            <input type="number" name="price" 
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all"
                placeholder="Rp">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Stok :</label>
            <input type="number" name="stock" 
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Deskripsi :</label>
            <textarea name="description" rows="3"
                class="w-full px-8 py-4 border-2 border-[#1e2a5e] rounded-[40px] focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all resize-none"></textarea>
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Foto Produk :</label>
            <div class="flex items-center gap-4">
                <div class="w-24 h-24 bg-[#dcfce7] rounded-2xl border-2 border-gray-100 overflow-hidden flex items-center justify-center relative shadow-sm">
                     <i class="ti ti-photo text-3xl text-green-600/30"></i>
                     <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <p class="text-[10px] text-gray-400 font-medium italic">*Klik kotak untuk upload foto</p>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-[#1e2a5e] text-white py-4 rounded-full font-black uppercase tracking-widest shadow-lg shadow-blue-900/20 active:scale-95 transition-all">
                Simpan Produk
            </button>
        </div>

    </form>
</div>

<style>
    input:focus, textarea:focus {
        border-color: #1e2a5e !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection