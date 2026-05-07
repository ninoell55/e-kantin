<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\ShopBill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopBillSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $shop1 = Shop::where('name', 'Warung Lestari')->first();
        $shop2 = Shop::where('name', 'Dapur SMK')->first();

        if ($shop1) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop1->id,
                'month' => 'Mei',
                'year' => now()->year,
            ], [
                'amount' => 300000,
                'due_date' => now()->addDays(7)->toDateString(),
                'payment_method' => 'transfer',
                'status' => 'unpaid',
            ]);
        }

        if ($shop2) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop2->id,
                'month' => 'Mei',
                'year' => now()->year,
            ], [
                'amount' => 275000,
                'due_date' => now()->addDays(7)->toDateString(),
                'payment_method' => 'cash',
                'status' => 'unpaid',
            ]);
        }
    }
}
