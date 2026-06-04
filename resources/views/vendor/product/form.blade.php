@extends('layouts.vendor')

@section('content')
    {{-- Container Benar-benar Full Screen (Edge-to-Edge) --}}
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Top Bar / Header Halaman Form Produk dengan Clean Breadcrumb (Match Style) --}}
        <div
            class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div class="flex flex-col">
                {{-- Breadcrumb Minimalis Clean --}}
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <a href="{{ route('vendor.dashboard') }}"
                        class="text-gray-400 hover:text-[#1b2563] transition-colors flex items-center gap-1">
                        <i class="ti ti-smart-home text-xs"></i> Vendor Panel
                    </a>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <a href="{{ route('vendor.product.index') }}"
                        class="text-gray-400 hover:text-[#1b2563] transition-colors">
                        Manajemen Produk
                    </a>
                    <i class="ti ti-chevron-right text-[8px] text-gray-300"></i>
                    <span class="text-[#7f1d1d]">
                        {{ $method === 'PUT' ? 'Edit Menu' : 'Tambah Baru' }}
                    </span>
                </nav>

                {{-- Judul Halaman --}}
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    {{ $title }}
                </h1>
            </div>

            {{-- Info Statistik Ringkas / Minimalist Counter Badge --}}
            <div
                class="flex items-center gap-3 bg-gray-50/80 border border-gray-200/40 px-4 py-2.5 rounded-2xl w-full md:w-auto">
                <div
                    class="w-8 h-8 rounded-xl flex items-center justify-center
            {{ $method === 'PUT' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-[#1b2563]' }}">
                    <i class="ti {{ $method === 'PUT' ? 'ti-edit' : 'ti-plus' }} text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Aksi
                        Sistem</span>
                    <span class="text-xs font-black text-gray-900 mt-0.5 leading-none uppercase tracking-wider">
                        {{ $method === 'PUT' ? 'Mode Edit' : 'Mode Baru' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Main Form Container --}}
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            @method($method)

            {{-- SISI KIRI: Upload & Preview Media Foto Menu --}}
            <div class="md:col-span-1 space-y-4">
                <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm shadow-gray-100/50 text-center">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block text-left mb-3">Foto
                        Produk</span>

                    <div
                        class="w-full aspect-square bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center relative overflow-hidden group hover:border-gray-300 transition-all duration-300">
                        <img id="image-preview"
                            src="{{ $product->image_path ? asset('storage/' . $product->image_path) : '#' }}"
                            class="absolute inset-0 w-full h-full object-cover z-20 {{ $product->image_path ? '' : 'hidden' }}">

                        <div id="upload-placeholder"
                            class="flex flex-col items-center justify-center p-4 text-center z-10 {{ $product->image_path ? 'hidden' : '' }}">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#1e2a5e]/5 text-[#1e2a5e] flex items-center justify-center mb-2 shadow-inner">
                                <i class="ti ti-photo-plus text-lg"></i>
                            </div>
                            <span class="text-[11px] font-extrabold text-gray-800">Pilih Gambar</span>
                            <span class="text-[9px] text-gray-400 mt-1">Format JPG, PNG (Max 2MB)</span>
                        </div>

                        <input type="file" name="image" id="product-image-input"
                            class="absolute inset-0 opacity-0 cursor-pointer z-30" accept="image/*"
                            onchange="previewImage(this)">
                    </div>
                    @error('image')
                        <p class="text-left text-red-600 text-[10px] font-bold mt-2"><i class="ti ti-alert-circle"></i>
                            {{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- SISI KANAN: Detail Form Inputs --}}
            <div class="md:col-span-2 space-y-4">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm shadow-gray-100/50 space-y-4">

                    {{-- Nama Menu --}}
                    <div class="flex flex-col">
                        <label for="name"
                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Nama Hidangan /
                            Menu</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            placeholder="Contoh: Mie Gulung Rice Paper"
                            class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-800 focus:outline-none focus:border-[#1e2a5e] focus:bg-white transition-all shadow-inner">
                        @error('name')
                            <p class="text-red-600 text-[10px] font-bold mt-1"><i class="ti ti-alert-circle"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Row Kategori Dinamik & Harga Jual --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Dropdown Kategori Berelasi category_id --}}
                        <div class="flex flex-col">
                            <label for="category_id"
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Kategori
                                Menu</label>
                            <div class="relative w-full">
                                <select name="category_id" id="category_id"
                                    class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-800 appearance-none focus:outline-none focus:border-[#1e2a5e] focus:bg-white transition-all shadow-inner">
                                    <option value="" disabled selected>Pilih Kategori Relasi</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="ti ti-chevron-down text-sm"></i>
                                </div>
                            </div>
                            @error('category_id')
                                <p class="text-red-600 text-[10px] font-bold mt-1"><i class="ti ti-alert-circle"></i>
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga Jual --}}
                        <div class="flex flex-col">
                            <label for="price"
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Harga Jual
                                (IDR)</label>
                            <div class="relative w-full">
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-black text-gray-400 border-r border-gray-200 pr-2.5">
                                    Rp</div>
                                <input type="number" name="price" id="price"
                                    value="{{ old('price', $product->price) }}" placeholder="5000" min="500"
                                    class="w-full bg-gray-50/50 border border-gray-200 rounded-xl pl-14 pr-4 py-3 text-sm font-black text-gray-800 focus:outline-none focus:border-[#1e2a5e] focus:bg-white transition-all shadow-inner">
                            </div>
                            @error('price')
                                <p class="text-red-600 text-[10px] font-bold mt-1"><i class="ti ti-alert-circle"></i>
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tambahan Input Deskripsi Menu --}}
                    <div class="flex flex-col">
                        <label for="description"
                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Deskripsi Singkat
                            Menu</label>
                        <textarea name="description" id="description" rows="3"
                            placeholder="Tulis rincian komposisi bahan makanan atau level kepedasan..."
                            class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3 text-xs font-bold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#1e2a5e] focus:bg-white transition-all shadow-inner">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-[10px] font-bold mt-1"><i class="ti ti-alert-circle"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Saklar Ketersediaan --}}
                    <div class="p-4 rounded-2xl bg-gray-50/70 border border-gray-100 flex items-center justify-between">
                        <div>
                            <h5 class="text-xs font-black text-gray-800 uppercase tracking-wide">Menu Siap Dijual</h5>
                            <p class="text-[10px] text-gray-400 mt-0.5 leading-tight">Geser saklar untuk merubah status stok
                                makanan di aplikasi murid.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="is_available" value="1" class="sr-only peer"
                                {{ old('is_available', $method === 'POST' ? true : $product->is_available) ? 'checked' : '' }}>
                            <div
                                class="w-12 h-7 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-inner">
                            </div>
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-50">
                        <a href="{{ route('vendor.product.index') }}"
                            class="px-5 py-3 bg-gray-100 text-gray-700 text-xs font-black rounded-xl transition-all">Batal</a>
                        <button type="submit"
                            class="px-6 py-3 bg-[#7f1d1d] text-white text-xs font-black rounded-xl shadow-md flex items-center gap-2">
                            <i class="ti ti-device-floppy text-sm"></i>
                            <span>Simpan Menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('upload-placeholder');
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
