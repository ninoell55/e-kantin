<div style="margin-bottom: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <a href="{{ route('admin.seller.create') }}"
        style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        + Tambah Penjual
    </a>
</div>

<table
    style="width: 100%; border-collapse: collapse; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; border: 1px solid #dee2e6; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <thead>
        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; text-align: center;">No</th>
            <th style="padding: 12px; text-align: center;">Logo</th>
            <th style="padding: 12px; text-align: left;">Warung & Pemilik</th>
            <th style="padding: 12px; text-align: center;">WhatsApp</th>
            <th style="padding: 12px; text-align: right;">Nominal Sewa</th>
            <th style="padding: 12px; text-align: center;">Metode</th>
            <th style="padding: 12px; text-align: center;">Bukti TF</th>
            <th style="padding: 12px; text-align: center;">Status</th>
            <th style="padding: 12px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sellers as $index => $seller)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px; text-align: center;">{{ $index + 1 }}</td>

                {{-- KOLOM LOGO --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($seller->shop && $seller->shop->banner_path)
                        <img src="{{ asset($seller->shop->banner_path) }}" width="40" height="40"
                            style="object-fit: cover; border-radius: 50%; border: 1px solid #ddd;">
                    @else
                        <div
                            style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #999; font-size: 9px; margin: 0 auto;">
                            No Logo
                        </div>
                    @endif
                </td>

                <td style="padding: 10px;">
                    <div style="font-weight: bold; color: #333;">{{ $seller->shop->name ?? '-' }}</div>
                    <div style="font-size: 11px; color: #777;">{{ $seller->name }}</div>
                </td>

                {{-- ... (kolom WhatsApp & Nominal sama seperti sebelumnya) ... --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($seller->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $seller->phone) }}" target="_blank"
                            style="color: #28a745; text-decoration: none; font-weight: bold;">
                            {{ $seller->phone }}
                        </a>
                    @else
                        <span style="color: #ccc;">-</span>
                    @endif
                </td>

                <td style="padding: 10px; text-align: right; font-weight: bold;">
                    Rp {{ number_format($seller->shop->currentBill->amount ?? 0, 0, ',', '.') }}
                </td>

                {{-- KOLOM METODE PEMBAYARAN --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($seller->shop && $seller->shop->currentBill)
                        @php
                            $method = strtolower($seller->shop->currentBill->payment_method ?? '');
                        @endphp

                        @if ($method === 'transfer')
                            <span
                                style="padding: 3px 8px; border-radius: 4px; background: #ebf8ff; font-size: 11px; font-weight: 600; color: #2b6cb0; border: 1px solid #bee3f8;">
                                TRANSFER
                            </span>
                        @else
                            <span
                                style="padding: 3px 8px; border-radius: 4px; background: #f0fff4; font-size: 11px; font-weight: 600; color: #2f855a; border: 1px solid #c6f6d5;">
                                CASH
                            </span>
                        @endif
                    @else
                        <span style="color: #ccc;">-</span>
                    @endif
                </td>
                {{-- KOLOM BUKTI TRANSFER --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($seller->shop && $seller->shop->currentBill && $seller->shop->currentBill->payment_proof)
                        <a href="{{ asset($seller->shop->currentBill->payment_proof) }}" target="_blank">
                            <img src="{{ asset($seller->shop->currentBill->payment_proof) }}"
                                width="40" height="40"
                                style="object-fit: cover; border-radius: 4px; border: 1px solid #ddd; cursor: zoom-in;"
                                title="Klik untuk memperbesar">
                        </a>
                    @else
                        <span style="color: #bbb; font-style: italic; font-size: 11px;">Tidak ada</span>
                    @endif
                </td>

                {{-- ... (kolom Status & Aksi tetap sama) ... --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($seller->shop && $seller->shop->currentBill)
                        @php
                            $bill = $seller->shop->currentBill;
                            $status = $bill->status;
                            $dueDate = \Carbon\Carbon::parse($bill->due_date);
                            if ($status == 'unpaid' && now()->gt($dueDate)) {
                                $status = 'overdue';
                            }
                            $bgColor = match ($status) {
                                'paid' => '#28a745',
                                'unpaid' => '#dc3545',
                                'overdue' => '#8b0000',
                                default => '#ffc107',
                            };
                        @endphp
                        <span
                            style="background-color: {{ $bgColor }}; color: white; padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 800; display: inline-block; min-width: 60px;">
                            {{ strtoupper($status) }}
                        </span>
                    @endif
                </td>
                <td style="padding: 10px; text-align: center; white-space: nowrap;">
                    <div style="display: flex; justify-content: center; gap: 5px;">
                        @if ($seller->status == 'pending' || ($seller->shop->currentBill->status ?? '') != 'paid')
                            <form action="{{ route('admin.seller.activate', $seller->id) }}" method="POST"
                                style="margin: 0;">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="background-color: #28a745; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: bold;">Bayar</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.seller.edit', $seller->id) }}"
                            style="background-color: #ffc107; color: #212529; padding: 6px 10px; text-decoration: none; border-radius: 4px; font-size: 11px; font-weight: bold;">Edit</a>
                        <form action="{{ route('admin.seller.destroy', $seller->id) }}" method="POST"
                            style="margin: 0;">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="background-color: #dc3545; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: bold;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
