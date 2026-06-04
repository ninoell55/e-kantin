<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Ambil semua order yang sudah kita daftarkan di OrderSeeder kemarin
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->error('Data Order tidak ditemukan! Jalankan OrderSeeder terlebih dahulu.');
            return;
        }

        foreach ($orders as $order) {
            // 2. Ambil semua produk yang dijual oleh toko tempat customer ini memesan (sesuai shop_id di order)
            $shopProducts = Product::where('shop_id', $order->shop_id)->get();

            // Jika toko tersebut ternyata tidak punya menu makanan sama sekali di database
            if ($shopProducts->isEmpty()) {
                continue;
            }

            // 3. Tentukan berapa banyak variasi item yang dibeli dalam satu invoice (Acak: 1 sampai 2 menu berbeda)
            $itemCount = rand(1, min(2, $shopProducts->count()));

            // Acak menunya agar bervariasi tiap running seed
            $randomProducts = $shopProducts->random($itemCount);

            $calculatedTotalPrice = 0;

            foreach ($randomProducts as $product) {
                // Tentukan jumlah porsi per menu yang dibeli (Acak: 1 - 2 porsi)
                $qty = rand(1, 2);
                $itemSubtotal = $product->price * $qty;
                $calculatedTotalPrice += $itemSubtotal;

                // Insert detail item pesanan
                OrderItem::firstOrCreate([
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                ], [
                    'product_name' => $product->name,
                    // Menyesuaikan kolom database kamu (apakah 'image' atau 'image_path')
                    'product_image_path' => $product->image ?? $product->image_path ?? null,
                    'quantity'     => $qty,
                    'price'        => $product->price,
                ]);
            }

            // 4. LOGIKA TAMBAHAN: Update total_price di tabel orders agar klop dengan total harga item + ongkir
            $order->update([
                'total_price' => $calculatedTotalPrice + ($order->delivery_fee ?? 0)
            ]);
        }

        $this->command->info('Mantap! Semua detail item pesanan (OrderItem) berhasil disinkronkan ke masing-masing invoice.');
    }
}
