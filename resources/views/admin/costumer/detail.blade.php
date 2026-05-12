<div style="max-width: 500px; margin: 40px auto; font-family: 'Segoe UI', sans-serif;">
    <div style="background: #fff; border-radius: 12px; border: 1px solid #ddd; box-shadow: 0 4px 10px rgba(0,0,0,0.05); overflow: hidden;">

        {{-- Header --}}
        <div style="background: #007bff; padding: 24px; text-align: center;">
            <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.2); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; color: white; margin-bottom: 10px;">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>
            <div style="color: white; font-size: 18px; font-weight: bold;">{{ $customer->name }}</div>
            <div style="color: rgba(255,255,255,0.8); font-size: 12px; margin-top: 4px;">{{ $customer->email }}</div>
        </div>

        {{-- Body --}}
        <div style="padding: 24px;">
            @php
                $rows = [
                    ['ID Number',   $customer->id_number],
                    ['Role',        strtoupper($customer->role)],
                    ['Status',      strtoupper($customer->status)],
                    ['WhatsApp',    $customer->phone ?? '-'],
                    ['Bergabung',   \Carbon\Carbon::parse($customer->created_at)->translatedFormat('d F Y')],
                ];
            @endphp

            @foreach ($rows as [$label, $value])
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 13px;">
                    <span style="color: #777;">{{ $label }}</span>
                    <span style="font-weight: 600; color: #333;">{{ $value }}</span>
                </div>
            @endforeach
        </div>

        {{-- Footer --}}
        <div style="padding: 16px 24px; display: flex; gap: 10px;">
            <a href="{{ route('admin.costumer.index') }}"
                style="flex: 1; text-align: center; background: #6c757d; color: white; padding: 10px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 13px;">
                ← Kembali
            </a>
            <form action="{{ route('admin.costumer.destroy', $customer->id) }}" method="POST" style="flex: 1;"
                onsubmit="return confirm('Hapus customer ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    style="width: 100%; background: #dc3545; color: white; border: none; padding: 10px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 13px;">
                    Hapus Customer
                </button>
            </form>
        </div>
    </div>
</div>
