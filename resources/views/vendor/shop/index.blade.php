@extends('layouts.vendor')

@section('content')
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Header Halaman --}}
        <div
            class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="flex items-center gap-1"><i class="ti ti-smart-home"></i> Vendor Panel</span>
                    <i class="ti ti-chevron-right text-[8px]"></i>
                    <span class="text-[#7f1d1d]">Pengaturan Toko</span>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Manajemen Lapak Kantin
                </h1>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-6 rounded-2xl border border-emerald-500/20 bg-emerald-50 p-4 text-sm text-emerald-800 font-bold flex items-center gap-2 shadow-sm">
                <i class="ti ti-circle-check text-base"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('vendor.shop.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')

            {{-- KOLOM KIRI: PREVIEW BANNER & STATUS TOKO --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Box Banner Preview --}}
                <div class="bg-gray-50 border border-gray-100 rounded-3xl p-4 shadow-sm text-center">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 text-left mb-3">Banner Lapak
                    </h3>
                    <div class="w-full h-40 bg-gray-200 rounded-2xl overflow-hidden relative border border-gray-100">
                        @if ($shop->banner_path)
                            <img id="banner-preview" src="{{ asset('storage/' . $shop->banner_path) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div id="banner-placeholder"
                                class="w-full h-full flex flex-col items-center justify-center bg-gray-900 text-white/40">
                                <i class="ti ti-photo text-3xl"></i>
                                <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Belum Ada Banner</span>
                            </div>
                        @endif
                    </div>
                    <label
                        class="mt-4 inline-flex items-center justify-center px-4 py-2 border border-gray-200 text-xs font-black uppercase tracking-wider text-gray-700 bg-white rounded-xl shadow-sm cursor-pointer hover:bg-gray-50 transition-all w-full">
                        <i class="ti ti-upload mr-1.5 text-sm"></i> Ganti Banner
                        <input type="file" name="banner" class="hidden"
                            onchange="previewFile(this, 'banner-preview', 'banner-placeholder')">
                    </label>
                    @error('banner')
                        <p class="text-red-600 text-[10px] font-bold mt-1 text-left">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Card Saklar Buka/Tutup Toko (State-Driven Dynamic Background) --}}
                <div id="shop-card-bg"
                    class="p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between {{ $shop->is_open ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white' : 'bg-gradient-to-br from-gray-800 to-slate-900 text-white' }}">
                    {{-- Decorative Background Glow --}}
                    <div
                        class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none transition-all duration-500 group-hover:scale-125">
                    </div>

                    <div class="flex justify-between items-center w-full relative z-10">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-60">Sistem Kantin</span>
                        </div>

                        {{-- Status Pill Indicator --}}
                        <div id="status-badge-container"
                            class="flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 {{ $shop->is_open ? 'bg-white/20 border-white/20' : 'bg-white/10 border-white/10' }}">
                            <span class="relative flex h-2 w-2">
                                <span id="dot-ping"
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $shop->is_open ? 'bg-white' : 'bg-red-400' }}"></span>
                                <span id="dot-solid"
                                    class="relative inline-flex rounded-full h-2 w-2 {{ $shop->is_open ? 'bg-white' : 'bg-red-500' }}"></span>
                            </span>
                            <span id="status-label" class="text-[10px] font-black uppercase tracking-wider text-white">
                                {{ $shop->is_open ? 'Buka' : 'Tutup' }}
                            </span>
                        </div>
                    </div>

                    {{-- Bagian Kontrol Switch Utama --}}
                    <div class="flex items-center justify-between pt-4 relative z-10">
                        <div class="max-w-[70%]">
                            <p id="shop-status-text" class="text-base font-black tracking-wide uppercase drop-shadow-sm">
                                {{ $shop->is_open ? 'Menerima Pesanan' : 'Lapak Beristirahat' }}
                            </p>
                            <p id="shop-status-desc" class="text-white/60 text-[10px] mt-0.5 leading-tight">
                                {{ $shop->is_open ? 'Pelanggan bisa memesan menu makanan.' : 'Menu disembunyikan sementara dari siswa.' }}
                            </p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" id="toggle-shop-status" class="sr-only peer"
                                {{ $shop->is_open ? 'checked' : '' }}>
                            {{-- Track Switch High Contrast --}}
                            <div
                                class="w-14 h-8 bg-black/20 backdrop-blur-md rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all after:shadow-lg peer-checked:bg-white/30 shadow-inner">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM DETAIL & METODE PEMBAYARAN --}}
            <div class="lg:col-span-2 bg-gray-50 border border-gray-100 rounded-3xl p-6 lg:p-8 space-y-6 shadow-sm">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Informasi Umum Toko</h3>

                {{-- Input Nama --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-gray-700 uppercase tracking-wider">Nama Lapak Kantin</label>
                    <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                        class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#7f1d1d] transition-all">
                    @error('name')
                        <p class="text-red-600 text-[10px] font-bold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Deskripsi --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-gray-700 uppercase tracking-wider">Deskripsi / Slogan
                        Lapak</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#7f1d1d] transition-all">{{ old('description', $shop->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-[10px] font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200/60 my-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    {{-- Input QR Pembayaran --}}
                    <div class="space-y-3">
                        <label class="text-xs font-black text-gray-700 uppercase tracking-wider block">QR Code Pembayaran
                            (Gopay/Dana/Qris)</label>
                        <div
                            class="w-full h-44 bg-white border border-gray-200 rounded-2xl overflow-hidden relative flex flex-col items-center justify-center p-2">
                            @if ($shop->qr_image_path)
                                <img id="qr-preview" src="{{ asset('storage/' . $shop->qr_image_path) }}"
                                    class="max-h-full max-w-full object-contain">
                            @else
                                <div id="qr-placeholder" class="text-center text-gray-400">
                                    <i class="ti ti-qrcode text-4xl"></i>
                                    <p class="text-[9px] font-bold uppercase tracking-wider mt-1">Belum Ada QR Code</p>
                                </div>
                            @endif
                        </div>
                        <label
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-200 text-xs font-black uppercase tracking-wider text-gray-700 bg-white rounded-xl shadow-sm cursor-pointer hover:bg-gray-50 transition-all w-full">
                            <i class="ti ti-qrcode mr-1.5 text-sm"></i> Upload QR Code
                            <input type="file" name="qr_image" class="hidden"
                                onchange="previewFile(this, 'qr-preview', 'qr-placeholder')">
                        </label>
                        @error('qr_image')
                            <p class="text-red-600 text-[10px] font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Teks Info Rekening --}}
                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black text-gray-700 uppercase tracking-wider">Keterangan Info
                                Pembayaran</label>
                            <input type="text" name="payment_info"
                                value="{{ old('payment_info', $shop->payment_info) }}"
                                placeholder="Contoh: DANA - 08123xxx a/n Nama Toko"
                                class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#7f1d1d] transition-all">
                            <p class="text-[9px] text-gray-400 font-medium leading-relaxed">Catatan ini akan tampil pada
                                struk checkout transfer siswa sebagai instruksi pembayaran alternatif.</p>
                            @error('payment_info')
                                <p class="text-red-600 text-[10px] font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Simpan Form --}}
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-3.5 bg-[#1b2563] text-white text-xs font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-900/10 hover:bg-[#151c4b] active:scale-[0.98] transition-all">
                                Simpan Perubahan Lapak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Script JS untuk Real-time File Image Preview --}}
    <script>
        function previewFile(input, previewId, placeholderId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    } else {
                        // Jika sebelumnya pakai placeholder, bikin tag img baru dinamis
                        const container = placeholder.parentElement;
                        placeholder.remove();
                        const newImg = document.createElement('img');
                        newImg.id = previewId;
                        newImg.src = e.target.result;
                        newImg.className = previewId === 'banner-preview' ? "w-full h-full object-cover" :
                            "max-h-full max-w-full object-contain";
                        container.appendChild(newImg);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-shop-status');
            const cardBg = document.getElementById('shop-card-bg');
            const statusText = document.getElementById('shop-status-text');
            const statusDesc = document.getElementById('shop-status-desc');
            const statusLabel = document.getElementById('status-label');
            const dotPing = document.getElementById('dot-ping');
            const dotSolid = document.getElementById('dot-solid');
            const badgeContainer = document.getElementById('status-badge-container');

            if (toggleBtn) {
                toggleBtn.addEventListener('change', function() {
                    const isOpen = this.checked;

                    statusLabel.textContent = isOpen ? 'Buka' : 'Tutup';
                    statusText.textContent = isOpen ? 'Menerima Pesanan' : 'Lapak Beristirahat';
                    statusDesc.textContent = isOpen ? 'Pelanggan bisa memesan menu makanan.' :
                        'Menu disembunyikan sementara dari siswa.';

                    if (isOpen) {
                        cardBg.className =
                            "p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between bg-gradient-to-br from-emerald-500 to-teal-600 text-white";
                        badgeContainer.className =
                            "flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 bg-white/20 border-white/20";
                        dotPing.className =
                            "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-white";
                        dotSolid.className = "relative inline-flex rounded-full h-2 w-2 bg-white";
                    } else {
                        cardBg.className =
                            "p-6 rounded-3xl transition-all duration-500 shadow-sm relative overflow-hidden group min-h-[145px] flex flex-col justify-between bg-gradient-to-br from-gray-800 to-slate-900 text-white";
                        badgeContainer.className =
                            "flex items-center gap-1.5 px-3 py-1 rounded-full border backdrop-blur-md transition-all duration-500 bg-white/10 border-white/10";
                        dotPing.className =
                            "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-red-400";
                        dotSolid.className = "relative inline-flex rounded-full h-2 w-2 bg-red-500";
                    }

                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                    fetch('{{ route('vendor.shop.toggle-status') }}', {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                is_open: isOpen
                            })
                        })
                        .then(response => {
                            if (!response.ok) console.error('Gagal memperbarui status di server');
                        })
                        .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
