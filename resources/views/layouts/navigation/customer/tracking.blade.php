<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tracking Pesanan - E-Kantin</title>

<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#1E2A78',
                secondary: '#FFC928',
                dark: '#111827',
                success: '#16a34a',
            },
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            }
        }
    }
}
</script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-slate-100 font-sans min-h-screen">

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-4">
    {{ session('error') }}
</div>
@endif

<!-- Navbar -->
<nav class="bg-white px-4 md:px-10 py-3 flex justify-between items-center shadow-sm">

    <div class="flex items-center gap-2">
        <div class="bg-primary text-secondary w-10 h-10 rounded-xl flex items-center justify-center font-bold">
            EK
        </div>

        <h2 class="font-bold text-lg">
            <span class="text-primary">E-KANTIN</span>
            <span class="text-red-900">SMEA</span>
        </h2>
    </div>

    <a href="{{ route('customer.menu') }}" class="text-primary font-semibold text-sm">
        ← Menu
    </a>

</nav>

<!-- Main -->
<div class="max-w-3xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="bg-primary text-white rounded-3xl p-8 text-center shadow-lg">
        <div class="text-6xl mb-4">🍜</div>

        <h1 class="text-3xl font-bold mb-3">
            Pesanan Sedang Diproses
        </h1>

        <p class="text-sm opacity-80 leading-relaxed">
            Santai aja 😭🔥 kantin lagi nyiapin pesanan kamu.
            Nanti tinggal ambil kalau status sudah siap.
        </p>
    </div>

    @forelse($orders as $order)

        @if($order->status == 'cancelled')
            <div class="bg-red-100 text-red-700 rounded-2xl p-4 mb-6 mt-6">
                Pesanan telah dibatalkan.
            </div>
        @endif

        <div class="bg-white rounded-3xl p-8 mt-6 text-center">

            <h2 class="font-bold text-xl mb-3">
                {{ $order->invoice_number }}
            </h2>

            <p class="text-gray-500">
                {{ $order->shop->name }}
            </p>

            <p class="text-gray-500">
                Status: {{ ucfirst($order->status) }}
            </p>

        </div>

        <div class="bg-white rounded-3xl p-8 mt-4">

            @foreach($order->orderItems as $item)

                <div class="flex justify-between text-sm mb-2">

                    <span>
                        {{ $item->product_name }}
                        ×
                        {{ $item->quantity }}
                    </span>

                    <span>
                        Rp{{ number_format($item->price * $item->quantity,0,',','.') }}
                    </span>

                </div>

            @endforeach

        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-3xl p-6 md:p-8 mt-6 shadow-sm">

            <h2 class="font-bold text-primary text-xl mb-8">
                📦 Live Tracking
            </h2>

            <div class="flex flex-col gap-8">

                <!-- Step 1 -->
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-success text-white flex items-center justify-center font-bold">
                            ✓
                        </div>
                        <div class="w-1 h-16 bg-success"></div>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark">Pesanan Dibuat</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Pesanan berhasil masuk ke sistem e-kantin.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-success text-white flex items-center justify-center font-bold">
                            ✓
                        </div>
                        <div class="w-1 h-16 bg-success"></div>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark">Menunggu Pembayaran</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Pembayaran sedang diverifikasi.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                @if ($order->status == 'processing')

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-secondary text-primary flex items-center justify-center font-bold">
                            ⏳
                        </div>
                        <div class="w-1 h-16 bg-slate-200"></div>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark">Diproses Kantin</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Penjual sedang menyiapkan makanan kamu.
                        </p>
                    </div>
                </div>
                @elseif ($order->status == 'ready' || $order->status == 'completed')
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-success text-white flex items-center justify-center font-bold">
                            ✓
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark">Sudah diproses</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Penjual sedang menyiapkan makanan kamu.
                        </p>
                    </div>
                </div>
                @else

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-gray-400 flex items-center justify-center font-bold">
                            •
                        </div>
                        <div class="w-1 h-16 bg-slate-200"></div>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-400">Diproses Kantin</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Penjual sedang menyiapkan makanan kamu.
                        </p>
                    </div>
                </div>

                @endif

                <!-- Step 4 -->
                @if ($order->status == 'ready' || $order->status == 'completed')

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-success text-white flex items-center justify-center font-bold">
                            ✓
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark">Siap Diambil</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Ambil pesanan di stand kantin nanti 😭🔥
                        </p>
                    </div>
                </div>

                @else

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-gray-400 flex items-center justify-center font-bold">
                            •
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-400">Siap Diambil</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Ambil pesanan di stand kantin nanti 😭🔥
                        </p>
                    </div>
                </div>

                @endif

            </div>

            @if($order->status === 'pending')
            <form
                action="{{ route('customer.orders.cancel', $order) }}"
                method="POST"
                class="mt-4"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Batalkan pesanan ini?')"
                    class="bg-red-600 text-white px-4 py-2 rounded-xl"
                >
                    Batalkan Pesanan
                </button>
            </form>
            @endif

        </div>

    @empty

        <div class="bg-white rounded-3xl p-8 mt-6 text-center">
            <h2 class="font-bold text-xl mb-3">
                Belum Ada Pesanan
            </h2>
            <p class="text-gray-500">
                Kamu belum pernah membuat pesanan.
            </p>
        </div>

    @endforelse

    <a href="{{ route('customer.menu') }}">
        <button class="w-full mt-10 bg-primary text-white py-4 rounded-2xl font-bold hover:-translate-y-1 transition-all">
            Kembali ke Menu
        </button>
    </a>

</div>

</body>
</html>