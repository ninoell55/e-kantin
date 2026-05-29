@extends('layouts.vendor')

@section('content')
<div class="max-w-md mx-auto px-4 pt-[85px] pb-[110px] min-h-screen bg-white">
    
    <div class="mb-8">
        <h3 class="text-[#1e2a5e] font-black text-xl flex items-center gap-2">
            <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
            Edit Produk
        </h3>
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest ml-3">Perbarui data menu anda</p>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6 px-2">
        @csrf
        @method('PUT') <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Nama Produk :</label>
            <input type="text" name="name" value="Pizza Pepperoni" 
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Harga :</label>
            <input type="number" name="price" value="15000"
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Stok :</label>
            <input type="number" name="stock" value="10"
                class="w-full px-6 py-3 border-2 border-[#1e2a5e] rounded-full focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all">
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Deskripsi :</label>
            <textarea name="description" rows="3"
                class="w-full px-8 py-4 border-2 border-[#1e2a5e] rounded-[40px] focus:ring-2 focus:ring-[#1e2a5e]/20 outline-none text-sm font-semibold text-gray-700 transition-all resize-none">Terbuat dari daging ikan sapu sapu pedes isinya sayuran ada sirip ikan dan campuran air kali ciliwung dikit</textarea>
        </div>

        <div class="space-y-2">
            <label class="block text-[#7f1d1d] font-bold text-sm ml-2">Foto Produk :</label>
            <div class="flex items-center gap-4">
                <div class="w-24 h-24 bg-[#f8fafc] rounded-2xl border-2 border-[#1e2a5e] overflow-hidden relative shadow-sm">
                     <img src="https://via.placeholder.com/100" class="w-full h-full object-cover opacity-60">
                     <div class="absolute inset-0 flex items-center justify-center">
                        <i class="ti ti-camera-rotate text-2xl text-[#1e2a5e]"></i>
                     </div>
                     <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 font-bold uppercase">Ganti Foto?</p>
                    <p class="text-[8px] text-gray-400 italic leading-tight">Klik gambar untuk memilih file baru</p>
                </div>
            </div>
        </div>

        <div class="pt-4 flex gap-3">
            <a href="{{ route('vendor.product.show') }}" 
                class="flex-1 text-center border-2 border-gray-200 text-gray-400 py-4 rounded-full font-black uppercase tracking-widest text-[10px] active:scale-95 transition-all">
                Batal
            </a>
            <button type="submit" 
                class="flex-[2] bg-[#1e2a5e] text-white py-4 rounded-full font-black uppercase tracking-widest text-[10px] shadow-lg shadow-blue-900/20 active:scale-95 transition-all">
                Update Produk
            </button>
        </div>

    </form>
</div>

<style>
    input:focus, textarea:focus { border-color: #1e2a5e !important; }
    input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
</style>
@endsection