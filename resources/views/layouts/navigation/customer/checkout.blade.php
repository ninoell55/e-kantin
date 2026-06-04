<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - E-Kantin SMEA</title>

<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#1E2A78',
                secondary: '#FFC928',
                dark: '#111827',
                danger: '#730f00',
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

<!-- Navbar -->
<nav class="bg-white px-4 md:px-10 py-3 flex justify-between items-center shadow-sm sticky top-0 z-50">
    
    <div class="flex items-center gap-2.5">
        <div class="bg-primary text-secondary w-10 h-10 rounded-xl flex items-center justify-center font-bold">
            EK
        </div>

        <h2 class="font-bold text-lg">
            <span class="text-primary">E-KANTIN</span>
            <span class="text-danger">SMEA</span>
        </h2>
    </div>

    <a href="/customer/cart" class="text-primary font-semibold text-sm hover:opacity-70 transition">
        ← Kembali
    </a>

</nav>

<!-- Main -->
<div class="max-w-6xl mx-auto px-4 md:px-8 py-8">
    <form action="{{ route('customer.checkout.store') }}" method="POST">
    @csrf

    <h1 class="text-2xl md:text-3xl font-bold text-primary mb-6">
        💳 Checkout Pesanan
    </h1>

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Left -->
        <div class="lg:col-span-2 flex flex-col gap-5">

            <!-- Data Pembeli -->
            <div class="bg-white rounded-3xl p-5 shadow-sm">

                <h2 class="font-bold text-primary text-lg mb-5">
                    👨‍🎓 Data Pembeli
                </h2>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-semibold text-dark mb-2 block">
                            Nama
                        </label>

                        <input
    type="text"
    name="customer_name"
    placeholder="Masukkan nama..."
    class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:border-primary"
    required
>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-dark mb-2 block">
                            Kelas
                        </label>

                       <input
    type="text"
    name="customer_class"
    placeholder="Contoh: XI RPL 1"
    class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:border-primary"
    required
>
                    </div>

                </div>

            </div>
            <div class="bg-white rounded-3xl p-5 shadow-sm">

    <h2 class="font-bold text-primary text-lg mb-5">
        📦 Detail Pesanan
    </h2>

    <div class="flex flex-col gap-4">

        <div>
            <label class="text-sm font-semibold text-dark mb-2 block">
                Tipe Pesanan
            </label>

            <select
                name="order_type"
                class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:border-primary"
            >
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>

        <div>
            <label class="text-sm font-semibold text-dark mb-2 block">
                Lokasi Pengantaran
            </label>

            <input
                type="text"
                name="delivery_location"
                placeholder="Contoh: XI RPL 1"
                class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:border-primary"
            >
        </div>

        <div>
            <label class="text-sm font-semibold text-dark mb-2 block">
                Catatan
            </label>

            <textarea
                name="notes"
                rows="4"
                class="w-full border border-slate-200 rounded-2xl px-4 py-3 outline-none focus:border-primary"
            ></textarea>
        </div>

    </div>

</div>

            <!-- Payment -->
            <div class="bg-white rounded-3xl p-5 shadow-sm">

                <h2 class="font-bold text-primary text-lg mb-5">
                    💰 Metode Pembayaran
                </h2>

                <div class="flex flex-col gap-4">

                    <!-- Tunai -->
            <label class="border-2 border-transparent has-[:checked]:border-primary rounded-2xl p-4 flex items-center gap-4 cursor-pointer">

    <input
        type="radio"
        name="payment_method"
        value="cash"
        checked
    >

    <div class="flex-1">
        <h3 class="font-bold text-dark">
            Tunai
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Bayar langsung saat mengambil pesanan.
        </p>
    </div>

    <span class="text-2xl">
        💵
    </span>

</label>

                    <!-- QR -->
                    <label class="border-2 border-transparent has-[:checked]:border-primary rounded-2xl p-4 flex items-center gap-4 cursor-pointer">

                        <input
    type="radio"
    name="payment_method"
    value="transfer"
>

                        <div class="flex-1">
                            <h3 class="font-bold text-dark">
                                QR Transfer
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Transfer langsung ke QR penjual.
                            </p>
                        </div>

                        <span class="text-2xl">
                            📱
                        </span>

                    </label>

                </div>

                <!-- QR Preview -->
                <div class="mt-5 bg-slate-100 rounded-2xl p-5 text-center">

                    <p class="text-sm font-semibold text-primary mb-4">
                        Scan QR Untuk Pembayaran
                    </p>

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=E-KANTIN-SMEA"
                        class="mx-auto rounded-xl"
                    >

                    <p class="text-xs text-gray-500 mt-4">
                        QR hanya contoh frontend sementara 😭🔥
                    </p>

                </div>

            </div>

        </div>

        <!-- Right -->
        <div>

            <div class="bg-white rounded-3xl p-5 shadow-sm sticky top-24">

                <h2 class="font-bold text-primary text-lg mb-5">
                    🧾 Ringkasan
                </h2>

                <div class="flex flex-col gap-4 text-sm">

    @php
        $totalItem = 0;
        $subtotal = 0;
    @endphp

    @foreach($cart as $item)

        @php
            $lineTotal = $item['price'] * $item['qty'];
            $totalItem += $item['qty'];
            $subtotal += $lineTotal;
        @endphp

        <div class="flex justify-between">

            <span class="text-gray-500">
                {{ $item['name'] }} × {{ $item['qty'] }}
            </span>

            <span class="font-semibold">
                Rp{{ number_format($lineTotal, 0, ',', '.') }}
            </span>

        </div>

    @endforeach

</div>

                <div class="border-t border-slate-200 my-5"></div>

                <div class="flex justify-between mb-3">

                    <span class="text-gray-500">
                        Total Item
                    </span>

                    <span class="font-semibold">
                        {{ $totalItem }}
                    </span>

                </div>

                <div class="flex justify-between mb-3">

                    <span class="text-gray-500">
                        Biaya Admin
                    </span>

                    <span class="text-green-600 font-semibold">
                        Gratis
                    </span>

                </div>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-bold text-dark text-lg">
                        Total
                    </span>

                    <span class="font-bold text-primary text-2xl">
                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                    </span>

                </div>

               <button
    type="submit"
    class="w-full mt-6 bg-secondary text-primary py-4 rounded-2xl font-bold hover:-translate-y-1 hover:shadow-lg transition-all"
>
    Buat Pesanan →
</button>

                </a>

            </div>

        </div>

    </div>
</form>
</div>

</body>
</html>