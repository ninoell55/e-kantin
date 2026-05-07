<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $vendor1 = User::where('email', 'vendor1@ekantin.test')->first();
        $vendor2 = User::where('email', 'vendor2@ekantin.test')->first();

        if ($vendor1) {
            Shop::firstOrCreate([
                'user_id' => $vendor1->id,
                'name' => 'Warung Lestari',
            ], [
                'description' => 'Warung sederhana dengan pilihan makanan dan minuman bergizi untuk siswa.',
                'payment_info' => 'QRIS: 085712345678',
                'is_open' => true,
            ]);
        }

        if ($vendor2) {
            Shop::firstOrCreate([
                'user_id' => $vendor2->id,
                'name' => 'Dapur SMK',
            ], [
                'description' => 'Dapur kantin yang menyediakan paket praktis dan camilan favorit siswa.',
                'payment_info' => 'QRIS: 085798765432',
                'is_open' => true,
            ]);
        }
    }
}
