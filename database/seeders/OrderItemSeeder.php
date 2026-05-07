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
        $order1 = Order::where('invoice_number', 'INV-0001')->first();
        $order2 = Order::where('invoice_number', 'INV-0002')->first();

        $nasiGoreng = Product::where('slug', 'nasi-goreng-spesial')->first();
        $esTeh = Product::where('slug', 'es-teh-manis')->first();
        $paketHemat = Product::where('slug', 'paket-hemat-1')->first();
        $jusJeruk = Product::where('slug', 'jus-jeruk-segar')->first();

        if ($order1 && $nasiGoreng && $esTeh) {
            OrderItem::firstOrCreate([
                'order_id' => $order1->id,
                'product_id' => $nasiGoreng->id,
                'product_name' => $nasiGoreng->name,
            ], [
                'product_image_path' => $nasiGoreng->image_path,
                'quantity' => 1,
                'price' => $nasiGoreng->price,
            ]);

            OrderItem::firstOrCreate([
                'order_id' => $order1->id,
                'product_id' => $esTeh->id,
                'product_name' => $esTeh->name,
            ], [
                'product_image_path' => $esTeh->image_path,
                'quantity' => 1,
                'price' => $esTeh->price,
            ]);
        }

        if ($order2 && $paketHemat && $jusJeruk) {
            OrderItem::firstOrCreate([
                'order_id' => $order2->id,
                'product_id' => $paketHemat->id,
                'product_name' => $paketHemat->name,
            ], [
                'product_image_path' => $paketHemat->image_path,
                'quantity' => 1,
                'price' => $paketHemat->price,
            ]);

            OrderItem::firstOrCreate([
                'order_id' => $order2->id,
                'product_id' => $jusJeruk->id,
                'product_name' => $jusJeruk->name,
            ], [
                'product_image_path' => $jusJeruk->image_path,
                'quantity' => 1,
                'price' => $jusJeruk->price,
            ]);
        }
    }
}
