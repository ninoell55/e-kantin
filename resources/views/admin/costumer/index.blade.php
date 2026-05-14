<div
    style="margin-bottom: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: space-between; align-items: center;">
    <h2 style="margin: 0;">Daftar Customer</h2>
    <a href="{{ route('admin.costumer.create') }}"
        style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        + Tambah Customer
    </a>
</div>


@if (session('success'))
    <div
        style="background: #d4edda; color: #155724; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; font-size: 13px;">
        {{ session('success') }}
    </div>
@endif

<table
    style="width: 100%; border-collapse: collapse; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; border: 1px solid #dee2e6; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <thead>
        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; text-align: center;">No</th>
            <th style="padding: 12px; text-align: left;">ID Number</th>
            <th style="padding: 12px; text-align: left;">Nama & Email</th>
            <th style="padding: 12px; text-align: center;">WhatsApp</th>
            <th style="padding: 12px; text-align: center;">Status</th>
            <th style="padding: 12px; text-align: center;">Bergabung</th>
            <th style="padding: 12px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($customers as $index => $customer)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px; text-align: center;">{{ $index + 1 }}</td>

                {{-- ID Number --}}
                <td style="padding: 10px;">
                    <span
                        style="font-family: monospace; background: #f0f0f0; padding: 3px 8px; border-radius: 4px; font-size: 12px;">
                        {{ $customer->id_number }}
                    </span>
                </td>

                {{-- Nama & Email --}}
                <td style="padding: 10px;">
                    <div style="font-weight: bold; color: #333;">{{ $customer->name }}</div>
                    <div style="font-size: 11px; color: #777;">{{ $customer->email }}</div>
                </td>

                {{-- WhatsApp --}}
                <td style="padding: 10px; text-align: center;">
                    @if ($customer->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer->phone) }}" target="_blank"
                            style="color: #28a745; text-decoration: none; font-weight: bold;">
                            {{ $customer->phone }}
                        </a>
                    @else
                        <span style="color: #ccc;">-</span>
                    @endif
                </td>

                {{-- Status --}}
                <td style="padding: 10px; text-align: center;">
                    @php
                        $bgColor = $customer->status === 'active' ? '#28a745' : '#dc3545';
                    @endphp
                    <span
                        style="background-color: {{ $bgColor }}; color: white; padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 800;">
                        {{ strtoupper($customer->status) }}
                    </span>
                </td>

                {{-- Bergabung --}}
                <td style="padding: 10px; text-align: center; color: #777; font-size: 12px;">
                    {{ \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d M Y') }}
                </td>

                {{-- Aksi --}}
                <td style="padding: 10px; text-align: center; white-space: nowrap;">
                    <div style="display: flex; justify-content: center; gap: 5px;">
                        <a href="{{ route('admin.costumer.detail', $customer->id) }}"
                            style="background-color: #17a2b8; color: white; padding: 6px 10px; text-decoration: none; border-radius: 4px; font-size: 11px; font-weight: bold;">
                            Detail
                        </a>

                        @if ($customer->status === 'banned')
                            {{-- Tombol Aktifkan --}}
                            <form action="{{ route('admin.costumer.activate', $customer->id) }}" method="POST"
                                style="margin: 0;"
                                onsubmit="return confirm('Aktifkan kembali {{ $customer->name }}?')">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="background-color: #28a745; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: bold;">
                                    Aktifkan
                                </button>
                            </form>
                        @else
                            {{-- Tombol Ban --}}
                            <form action="{{ route('admin.costumer.ban', $customer->id) }}" method="POST"
                                style="margin: 0;" onsubmit="return confirm('Ban customer {{ $customer->name }}?')">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="background-color: #dc3545; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: bold;">
                                    Ban
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="padding: 30px; text-align: center; color: #999; font-style: italic;">
                    Belum ada customer terdaftar.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
