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
                    <span class="text-[#7f1d1d]">Laporan Keuangan</span>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Rekap Penjualan Toko
                </h1>
            </div>

            {{-- Form Filter Rentang Waktu --}}
            <form action="{{ route('vendor.report.index') }}" method="GET"
                class="w-full sm:w-auto flex flex-wrap items-center gap-2">
                <select name="filter" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-200 text-gray-800 text-xs px-4 py-2.5 rounded-xl font-bold uppercase tracking-wider focus:outline-none focus:ring-1 focus:ring-[#7f1d1d]">
                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Kustom Tanggal</option>
                </select>

                @if ($filter == 'custom')
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="bg-gray-50 border border-gray-200 text-xs px-4 py-2.5 rounded-xl font-semibold">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="bg-gray-50 border border-gray-200 text-xs px-4 py-2.5 rounded-xl font-semibold">
                    <button type="submit"
                        class="bg-[#1b2563] text-white text-[10px] font-black uppercase px-4 py-2.5 rounded-xl tracking-wider">Cari</button>
                @endif
                {{-- Letakkan di dalam form filter atau di samping tombol 'Cari' --}}
                <a href="{{ route('vendor.report.exportPdf', request()->all()) }}"
                    class="bg-rose-50 border border-rose-200 text-rose-700 text-[10px] font-black uppercase px-4 py-2.5 rounded-xl tracking-wider flex items-center gap-1.5 transition-all hover:bg-rose-100 active:scale-95">
                    <i class="ti ti-file-text text-xs"></i> Export PDF
                </a>
            </form>
        </div>

        {{-- GRID STATISTIK UTAMA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            {{-- Total Pendapatan --}}
            <div
                class="bg-[#1b2563] rounded-3xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col justify-between min-h-[140px]">
                <div>
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-white/50">Total Pemasukan Bersih</p>
                    <h2 class="text-3xl font-black tracking-tight mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </h2>
                </div>
                <p class="text-[10px] font-bold text-white/60 tracking-wide mt-4">
                    Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
                </p>
                <i class="ti ti-wallet absolute -right-4 -bottom-4 text-8xl text-white/5"></i>
            </div>

            {{-- Total Pesanan Sukses --}}
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-6 flex flex-col justify-between min-h-[140px]">
                <div>
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">Pesanan Berhasil</p>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight mt-2">{{ $totalOrders }} Trx</h2>
                </div>
                <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center gap-1 mt-4">
                    <i class="ti ti-circle-check"></i> 100% Selesai & Lunas
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- TABEL RIWAYAT TRANSAKSI (Makan tempat 2 kolom di lg) --}}
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 px-1">Rincian Riwayat Nota</h3>

                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50 border-b border-gray-100 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                    <th class="p-4">Invoice</th>
                                    <th class="p-4">Pelanggan</th>
                                    <th class="p-4">Tipe</th>
                                    <th class="p-4 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-xs">
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="p-4 font-black text-gray-800">
                                            #{{ $order->invoice_number ?? 'INV-' . $order->id }}
                                            <span
                                                class="block text-[9px] font-normal text-gray-400 mt-0.5">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td class="p-4 font-bold text-gray-700">{{ $order->user->name }}</td>
                                        <td class="p-4">
                                            <span
                                                class="text-[9px] font-black uppercase px-2 py-1 rounded-md {{ $order->order_type == 'delivery' ? 'bg-amber-50 text-amber-600' : 'bg-purple-50 text-purple-600' }}">
                                                {{ $order->order_type }}
                                            </span>
                                        </td>
                                        <td class="p-4 font-black text-right text-gray-900">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-gray-400 font-medium">Tidak ada
                                            transaksi terkap pada periode ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PRODUK TERLARIS (Makan tempat 1 kolom di lg) --}}
            <div class="space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 px-1">Menu Paling Laris</h3>

                <div class="bg-gray-50/50 border border-gray-100/80 rounded-3xl p-4 space-y-3">
                    @forelse($topProducts as $index => $prod)
                        <div
                            class="bg-white rounded-2xl p-4 flex items-center justify-between shadow-sm border border-gray-50">
                            <div class="flex items-center gap-3 min-w-0">
                                {{-- Badge Peringkat --}}
                                <span
                                    class="w-5 h-5 flex items-center justify-center bg-amber-50 text-amber-700 font-black text-[10px] rounded-full">
                                    {{ $index + 1 }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-black text-gray-800 truncate">{{ $prod->product_name }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold mt-0.5">{{ $prod->total_qty }} Porsi
                                        Terjual</p>
                                </div>
                            </div>
                            <p class="text-xs font-black text-[#7f1d1d] flex-shrink-0">
                                Rp {{ number_format($prod->total_sales, 0, ',', '.') }}
                            </p>
                        </div>
                    @empty
                        <div class="py-6 text-center text-gray-400 text-xs font-medium">Belum ada menu terjual.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
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
