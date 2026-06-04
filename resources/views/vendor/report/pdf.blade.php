<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - {{ $shop->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1f2937;
            margin: 0;
            padding: 0;
            font-size: 11px;
        }

        .header {
            border-b: 2px solid #7f1d1d;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .shop-name {
            font-size: 20px;
            font-weight: 900;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .report-title {
            font-size: 11px;
            color: #6b7280;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .summary-box {
            width: 100%;
            margin-bottom: 25px;
        }

        .card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 12px;
            width: 45%;
            display: inline-block;
            vertical-align: top;
        }

        .card-dark {
            background: #1b2563;
            color: #ffffff;
            border: none;
        }

        .card-title {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9ca3af;
        }

        .card-dark .card-title {
            color: rgba(255, 255, 255, 0.6);
        }

        .card-value {
            font-size: 18px;
            font-weight: 900;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 8px 10px;
            font-size: 9px;
            font-weight: bold;
            color: #4b5563;
            text-transform: uppercase;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }

        .font-black {
            font-weight: bold;
            color: #111827;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 3px 6px;
            background: #f3f4f6;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT / HEADER --}}
    <div class="header">
        <span class="shop-name">{{ $shop->name }}</span>
        <div class="report-title">
            REKAP PENJUALAN E-KANTIN • Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
        </div>
    </div>

    {{-- KOTAK STATISTIK --}}
    <div class="summary-box">
        <div class="card card-dark" style="margin-right: 5%;">
            <div class="card-title">Total Pemasukan Bersih</div>
            <div class="card-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-title" style="color: #6b7280;">Pesanan Berhasil</div>
            <div class="card-value" style="color: #111827;">{{ $totalOrders }} Transaksi</div>
        </div>
    </div>

    {{-- TABEL MENU TERLARIS --}}
    <h3 style="font-size: 10px; text-transform: uppercase; color: #4b5563; margin-bottom: 10px;">5 Menu Terlaris</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th>Nama Produk</th>
                <th class="text-right">Kuantitas Terjual</th>
                <th class="text-right">Total Pemasukan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topProducts as $index => $prod)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="font-black">{{ $prod->product_name }}</td>
                    <td class="text-right">{{ $prod->total_qty }} Porsi</td>
                    <td class="text-right font-black" style="color: #7f1d1d;">Rp
                        {{ number_format($prod->total_sales, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #9ca3af;">Belum ada menu terjual</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TABEL DETAIL TRANSAKSI --}}
    <h3 style="font-size: 10px; text-transform: uppercase; color: #4b5563; margin-bottom: 10px;">Daftar Transaksi
        Selesai</h3>
    <table>
        <thead>
            <tr>
                <th>No. Invoice</th>
                <th>Tanggal Nota</th>
                <th>Nama Pelanggan</th>
                <th>Tipe</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="font-black">#{{ $order->invoice_number ?? 'INV-' . $order->id }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }} WIB</td>
                    <td>{{ $order->user->name }}</td>
                    <td><span class="badge">{{ $order->order_type }}</span></td>
                    <td class="text-right font-black">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #9ca3af;">Tidak ada riwayat transaksi pada
                        periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
