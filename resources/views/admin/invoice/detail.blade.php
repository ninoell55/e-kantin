<style>
    #invoice-wrapper { padding: 24px; font-family: sans-serif; font-size: 14px; max-width: 720px; margin: 0 auto; }
    #invoice-card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
    #invoice-header { background: #1e293b; color: #fff; padding: 24px; display: flex; justify-content: space-between; align-items: flex-start; }
    #invoice-brand h2 { margin: 0 0 4px; font-size: 18px; }
    #invoice-brand p { margin: 0; font-size: 12px; opacity: 0.6; }
    #invoice-meta { text-align: right; font-size: 12px; opacity: 0.8; }
    #invoice-meta strong { font-size: 15px; opacity: 1; display: block; }
    #invoice-status { padding: 10px 24px; font-size: 13px; font-weight: 600; }
    #invoice-status.paid    { background: #e6f7ee; color: #15803d; }
    #invoice-status.unpaid  { background: #fef9ec; color: #92400e; }
    #invoice-status.overdue { background: #fef2f2; color: #dc2626; }
    #invoice-body { padding: 24px; }
    #invoice-parties { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }
    .party-label { font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 6px; }
    .party-name { font-size: 15px; font-weight: 600; margin-bottom: 4px; }
    .party-sub { font-size: 12px; color: #666; margin: 2px 0; }
    #invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    #invoice-table th { background: #f1f3f5; padding: 10px 14px; text-align: left; font-size: 12px; border-bottom: 1px solid #ddd; }
    #invoice-table td { padding: 12px 14px; border-bottom: 1px solid #eee; }
    #invoice-total { background: #f8f9fa; border-radius: 8px; padding: 14px 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    #invoice-total span { color: #666; font-size: 13px; }
    #invoice-total strong { font-size: 20px; }
    #invoice-payment-info { margin-bottom: 24px; }
    #invoice-payment-info h3 { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 12px; }
    .payment-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .payment-box { background: #f8f9fa; border-radius: 8px; padding: 12px 14px; }
    .payment-box-label { font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 4px; }
    .payment-box-value { font-size: 13px; font-weight: 600; }
    #invoice-proof { margin-bottom: 24px; }
    #invoice-proof h3 { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 10px; }
    #invoice-proof img { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; cursor: zoom-in; }
    #invoice-footer-note { border-top: 1px solid #eee; padding: 16px 24px; display: flex; justify-content: space-between; font-size: 12px; color: #888; }
    #invoice-actions { display: flex; gap: 10px; margin-bottom: 24px; }
    #invoice-actions a { padding: 9px 16px; border: 1px solid #ddd; border-radius: 8px; text-decoration: none; color: #333; font-size: 13px; }
    #invoice-actions button { padding: 9px 18px; background: #1e293b; color: #fff; border: none; border-radius: 8px; font-size: 13px; cursor: pointer; }
    @media print {
        #invoice-actions { display: none; }
        #invoice-wrapper { padding: 0; }
    }
</style>

@php
    $status = $bill->status;
    if ($status === 'unpaid' && now()->gt(\Carbon\Carbon::parse($bill->due_date))) {
        $status = 'overdue';
    }
    $invoiceNumber = 'INV-' . str_pad($bill->id, 4, '0', STR_PAD_LEFT) . '-' . $bill->year;
@endphp

<div id="invoice-wrapper">

    {{-- AKSI --}}
    <div id="invoice-actions">
        <a href="{{ route('admin.invoice.index') }}">← Kembali</a>
        <button onclick="window.print()">🖨 Print Invoice</button>
    </div>

    <div id="invoice-card">

        {{-- HEADER --}}
        <div id="invoice-header">
            <div id="invoice-brand">
                <h2>E-Kantin</h2>
                <p>Portal Administrasi Kantin</p>
            </div>
            <div id="invoice-meta">
                <strong>{{ $invoiceNumber }}</strong>
                <span>Diterbitkan: {{ now()->translatedFormat('d F Y') }}</span>
            </div>
        </div>

        {{-- STATUS --}}
        <div id="invoice-status" class="{{ $status }}">
            @if($status === 'paid')
                ✅ Lunas — dibayar pada {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d F Y') : '-' }}
            @elseif($status === 'overdue')
                ⚠️ Jatuh Tempo — belum dibayar sejak {{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d F Y') }}
            @else
                🕐 Belum Dibayar — jatuh tempo {{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d F Y') }}
            @endif
        </div>

        <div id="invoice-body">

            {{-- DARI & KEPADA --}}
            <div id="invoice-parties">
                <div>
                    <div class="party-label">Dari</div>
                    <div class="party-name">Admin E-Kantin</div>
                    <div class="party-sub">Portal Administrasi</div>
                </div>
                <div>
                    <div class="party-label">Kepada</div>
                    <div class="party-name">{{ $bill->shop->user->name }}</div>
                    <div class="party-sub">{{ $bill->shop->name }}</div>
                    <div class="party-sub">{{ $bill->shop->user->email }}</div>
                    @if($bill->shop->user->phone)
                        <div class="party-sub">{{ $bill->shop->user->phone }}</div>
                    @endif
                </div>
            </div>

            {{-- RINCIAN --}}
            <table id="invoice-table">
                <thead>
                    <tr>
                        <th>Deskripsi</th>
                        <th>Periode</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sewa Tempat Kantin</td>
                        <td>{{ $bill->month }} {{ $bill->year }}</td>
                        <td>{{ \Carbon\Carbon::parse($bill->due_date)->translatedFormat('d M Y') }}</td>
                        <td><strong>Rp {{ number_format($bill->amount, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>

            {{-- TOTAL --}}
            <div id="invoice-total">
                <span>Total Tagihan</span>
                <strong>Rp {{ number_format($bill->amount, 0, ',', '.') }}</strong>
            </div>

            {{-- INFO PEMBAYARAN --}}
            <div id="invoice-payment-info">
                <h3>Informasi Pembayaran</h3>
                <div class="payment-grid">
                    <div class="payment-box">
                        <div class="payment-box-label">Metode</div>
                        <div class="payment-box-value">{{ strtoupper($bill->payment_method ?? '-') }}</div>
                    </div>
                    <div class="payment-box">
                        <div class="payment-box-label">Status</div>
                        <div class="payment-box-value">{{ strtoupper($status) }}</div>
                    </div>
                    <div class="payment-box">
                        <div class="payment-box-label">Tanggal Bayar</div>
                        <div class="payment-box-value">
                            {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d M Y') : '-' }}
                        </div>
                    </div>
                    <div class="payment-box">
                        <div class="payment-box-label">No. Invoice</div>
                        <div class="payment-box-value">{{ $invoiceNumber }}</div>
                    </div>
                </div>
            </div>

            {{-- BUKTI TF --}}
            @if($bill->payment_proof)
                <div id="invoice-proof">
                    <h3>Bukti Transfer</h3>
                    <a href="{{ asset($bill->payment_proof) }}" target="_blank">
                        <img src="{{ asset($bill->payment_proof) }}" alt="Bukti Transfer">
                    </a>
                </div>
            @endif

        </div>

        {{-- FOOTER --}}
        <div id="invoice-footer-note">
            <span>Terima kasih telah bergabung bersama E-Kantin.</span>
            <span>{{ now()->translatedFormat('d F Y') }}</span>
        </div>

    </div>
</div>
