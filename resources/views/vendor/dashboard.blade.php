@extends('layouts.vendor')

<!-- Asumsi di file layouts/vendor.blade.php kamu menggunakan @yield('content') -->
@section('content')
    <!-- Wrapper utama dengan padding atas-bawah agar tidak tertutup Navbar -->
    <div class="max-w-md mx-auto px-4 pt-24 pb-32 min-h-screen bg-slate-50">

        <!-- Header & Toggle Buka/Tutup Lapak -->
        <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-100 mb-6 flex justify-between items-center">
            <div>
                <p class="text-xs text-slate-500 font-inter mb-1">Halo, Selamat Datang!</p>
                <!-- Nanti nama ini diambil dari database: Auth::user()->shop->name -->
                <h2 class="text-xl font-bold text-primary truncate w-40">{{ $shop->name }}</h2>
            </div>

            <!-- Toggle Switch UI murni Tailwind -->
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" id="toggle-shop-status" class="sr-only peer" {{ $shop->is_open ? 'checked' : '' }}>
                <div
                    class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-status-ready">
                </div>
                <span id="shop-status-text" class="ml-3 text-sm font-bold text-slate-700 peer-checked:text-status-ready">
                    {{ $shop->is_open ? 'Buka' : 'Tutup' }}
                </span>
            </label>
        </div>

        <!-- Grid Statistik Hari Ini -->
        <h3 class="text-sm font-bold text-primary mb-3 font-inter">Ringkasan Hari Ini</h3>
        <div class="grid grid-cols-2 gap-4 mb-8">

            <!-- Card: Pendapatan -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-[10px] text-slate-500 font-inter uppercase tracking-wider">Pendapatan</p>
                <p class="text-lg font-bold text-slate-800">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
            </div>

            <!-- Card: Pesanan Masuk -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <p class="text-[10px] text-slate-500 font-inter uppercase tracking-wider">Total Pesanan</p>
                <p class="text-lg font-bold text-slate-800">{{ $todayOrdersCount }} <span
                        class="text-xs font-normal text-slate-400">porsi</span>
                </p>
            </div>

        </div>

        <!-- Section: Pesanan Perlu Tindakan -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-sm font-bold text-primary font-inter">
                Perlu Disiapkan
                <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full ml-1">
                    {{ $pendingOrders->count() }}
                </span>
            </h3>
            <a href="#" class="text-xs font-bold text-tertiary hover:underline">Lihat Semua</a>
        </div>

        <div class="flex flex-col gap-3">
            @forelse ($pendingOrders as $order)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col gap-3">
                    <div class="flex justify-between items-start border-b border-slate-50 pb-2">
                        <div>
                            <!-- Invoice dinamis -->
                            <p class="text-xs font-bold text-slate-800">{{ $order->invoice_number ?? 'INV-' . $order->id }}
                            </p>
                            <!-- Nama pembeli dari tabel users -->
                            <p class="text-[10px] text-slate-500 mt-0.5">Pemesan: <span
                                    class="font-bold text-primary">{{ $order->user->name }}</span></p>
                        </div>

                        <!-- Badge Status Dinamis -->
                        @if ($order->payment_status === 'unpaid')
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#fef3c7] text-status-pending border border-[#fde68a]">
                                Belum Dibayar (Tunai)
                            </span>
                        @elseif($order->payment_status === 'verifying')
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                Cek Bukti QR
                            </span>
                        @else
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-status-ready border border-green-200">
                                Lunas - Dimasak
                            </span>
                        @endif
                    </div>

                    <div class="flex justify-between items-end">
                        <div class="text-xs text-slate-600">
                            <!-- Looping isi makanan yang dibeli -->
                            @foreach ($order->items as $item)
                                <p>{{ $item->quantity }}x {{ $item->product_name }}</p>
                            @endforeach
                        </div>
                        <!-- Total Harga per Struk -->
                        <p class="font-bold text-primary text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <button
                            class="py-2 text-xs font-bold text-primary bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">
                            Detail
                        </button>

                        <!-- Logika tombol berubah sesuai status pembayaran -->
                        @if ($order->payment_status === 'unpaid' && $order->payment_method === 'cash')
                            <button
                                class="py-2 text-xs font-bold text-white bg-primary rounded-xl hover:bg-primary/90 transition-colors shadow-md shadow-primary/30">
                                Terima Tunai
                            </button>
                        @elseif($order->status === 'processing')
                            <button
                                class="py-2 text-xs font-bold text-white bg-status-ready rounded-xl hover:bg-green-600 transition-colors shadow-md shadow-green-500/30">
                                Siap Diambil
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Tampilan jika tidak ada orderan yang masuk -->
                <div class="text-center py-8 bg-white rounded-2xl border border-slate-100 border-dashed">
                    <p class="text-slate-400 text-sm font-inter">Belum ada pesanan masuk.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Tambahkan di baris paling bawah, sebelum -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-shop-status');
            const statusText = document.getElementById('shop-status-text');

            if (toggleBtn) {
                toggleBtn.addEventListener('change', function() {
                    // Ambil status checkbox (true/false)
                    const isOpen = this.checked;


                    // Jalankan proses AJAX menggunakan Fetch API
                    fetch('{{ route('vendor.shop.toggle-status') }}', {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                // Ambil CSRF token dari tag meta di head
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                is_open: isOpen
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Jika berhasil ke database, ubah teks permanen
                                statusText.textContent = data.is_open ? 'Buka' : 'Tutup';
                            } else {
                                // Jika error dari server, kembalikan posisi toggle
                                toggleBtn.checked = !isOpen;
                                statusText.textContent = !isOpen ? 'Buka' : 'Tutup';
                                alert('Gagal mengubah status lapak: ' + data.message);
                            }
                        })
                        .catch(error => {
                            // Jika koneksi internet putus / error server parah
                            console.error('Error:', error);
                            toggleBtn.checked = !isOpen;
                            statusText.textContent = !isOpen ? 'Buka' : 'Tutup';
                            alert('Terjadi kesalahan jaringan.');
                        });
                });
            }
        });
    </script>
@endsection
