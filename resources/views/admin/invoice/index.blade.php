<style>
    #invoice-index-wrapper { padding: 24px; font-family: sans-serif; font-size: 14px; }
    .vendor-group { margin-bottom: 32px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
    .vendor-group-header { display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #f8f9fa; border-bottom: 1px solid #ddd; }
    .vendor-group-header img { border-radius: 50%; object-fit: cover; }
    .vendor-group-info { display: flex; flex-direction: column; gap: 2px; }
    .vendor-group-info strong { font-size: 15px; }
    .vendor-group-info span { font-size: 12px; color: #666; }
    .invoice-list-table { width: 100%; border-collapse: collapse; }
    .invoice-list-table th { background: #f1f3f5; padding: 10px 14px; text-align: left; font-size: 12px; border-bottom: 1px solid #ddd; }
    .invoice-list-table td { padding: 10px 14px; border-bottom: 1px solid #eee; }
    .invoice-list-table tbody tr:last-child td { border-bottom: none; }
    [data-status="paid"]    { color: #15803d; font-weight: 600; }
    [data-status="unpaid"]  { color: #92400e; font-weight: 600; }
    [data-status="overdue"] { color: #dc2626; font-weight: 600; }
    #invoice-index-header { margin-bottom: 24px; }
    #invoice-index-header h1 { margin: 0 0 4px; }
    #invoice-index-header p { margin: 0; color: #666; }
</style>

<div id="invoice-index-wrapper">

    <div id="invoice-index-header">
        <h1>Invoice Sewa Vendor</h1>
        <p>Daftar tagihan sewa per vendor</p>
    </div>

    @foreach($bills as $shopId => $shopBills)
        @php
            $shop   = $shopBills->first()->shop;
            $vendor = $shop->user;
        @endphp

        <div id="vendor-group-{{ $shopId }}" class="vendor-group">

            {{-- INFO VENDOR --}}
            <div class="vendor-group-header">
                @if($shop->banner_path)
                    <img src="{{ asset($shop->banner_path) }}" alt="Logo" width="40" height="40">
                @endif
                <div class="vendor-group-info">
                    <strong>{{ $shop->name }}</strong>
                    <span>{{ $vendor->name }}</span>
                    <span>{{ $vendor->email }}</span>
                    @if($vendor->phone)
                        <span>{{ $vendor->phone }}</span>
                    @endif
                </div>
            </div>

            {{-- TABEL TAGIHAN --}}
            <table class="invoice-list-table">
                <thead>
                    <tr>
                        <th>No. Invoice</th>
                        <th>Periode</th>
                        <th>Jatuh Tempo</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Bukti TF</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shopBills as $bill)
                        @php
                            $status = $bill->status;
                            if ($status === 'unpaid' && now()->gt(\Carbon\Carbon::parse($bill->due_date))) {
                                $status = 'overdue';
                            }
                            $invoiceNumber = 'INV-' . str_pad($bill->id, 4, '0', STR_PAD_LEFT) . '-' . $bill->year;
                        @endphp
                        <tr>
                            <td>{{ $invoiceNumber }}</td>
                            <td>{{ $bill->month }} {{ $bill->year }}</td>
                            <td>{{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d M Y') }}</td>
                            <td>Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td>{{ strtoupper($bill->payment_method ?? '-') }}</td>
                            <td>
                                @if($bill->payment_proof)
                                    <a href="{{ asset($bill->payment_proof) }}" target="_blank">Lihat Bukti</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td data-status="{{ $status }}">{{ strtoupper($status) }}</td>
                            <td>
                                <a href="{{ route('admin.invoice.detail', $bill->id) }}">Detail Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endforeach

</div>
