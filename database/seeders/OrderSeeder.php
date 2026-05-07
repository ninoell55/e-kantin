<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $customer1 = User::where('email', 'customer1@ekantin.test')->first();
        $customer2 = User::where('email', 'customer2@ekantin.test')->first();
        $shop1 = Shop::where('name', 'Warung Lestari')->first();
        $shop2 = Shop::where('name', 'Dapur SMK')->first();

        if ($customer1 && $shop1) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-0001',
            ], [
                'user_id' => $customer1->id,
                'shop_id' => $shop1->id,
                'order_type' => 'pickup',
                'total_price' => 32000,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'status' => 'completed',
                'notes' => 'Ambil di kasir, tanpa sambal.',
            ]);
        }

        if ($customer2 && $shop2) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-0002',
            ], [
                'user_id' => $customer2->id,
                'shop_id' => $shop2->id,
                'order_type' => 'delivery',
                'delivery_location' => 'Gedung A, Lantai 2',
                'delivery_fee' => 5000,
                'total_price' => 37000,
                'payment_method' => 'transfer',
                'payment_status' => 'verifying',
                'status' => 'processing',
                'notes' => 'Antar ke ruang kelas setelah bel istirahat.',
            ]);
        }
    }
}
