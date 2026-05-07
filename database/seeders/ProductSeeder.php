<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $shop1 = Shop::where('name', 'Warung Lestari')->first();
        $shop2 = Shop::where('name', 'Dapur SMK')->first();

        $makanan = Category::where('name', 'Makanan')->first();
        $minuman = Category::where('name', 'Minuman')->first();
        $snack = Category::where('name', 'Snack')->first();
        $paket = Category::where('name', 'Paket Hemat')->first();

        if ($shop1 && $makanan) {
            Product::firstOrCreate([
                'shop_id' => $shop1->id,
                'category_id' => $makanan->id,
                'name' => 'Nasi Goreng Spesial',
            ], [
                'slug' => 'nasi-goreng-spesial',
                'description' => 'Nasi goreng lengkap dengan telur, ayam, dan sayuran segar.',
                'price' => 17000,
                'is_available' => true,
            ]);

            Product::firstOrCreate([
                'shop_id' => $shop1->id,
                'category_id' => $minuman->id,
                'name' => 'Es Teh Manis',
            ], [
                'slug' => 'es-teh-manis',
                'description' => 'Es teh manis segar untuk menyegarkan akhir istirahat.',
                'price' => 6000,
                'is_available' => true,
            ]);

            Product::firstOrCreate([
                'shop_id' => $shop1->id,
                'category_id' => $snack->id,
                'name' => 'Roti Bakar Coklat',
            ], [
                'slug' => 'roti-bakar-coklat',
                'description' => 'Roti bakar isi coklat manis yang hangat.',
                'price' => 8000,
                'is_available' => true,
            ]);
        }

        if ($shop2 && $paket) {
            Product::firstOrCreate([
                'shop_id' => $shop2->id,
                'category_id' => $paket->id,
                'name' => 'Paket Hemat 1',
            ], [
                'slug' => 'paket-hemat-1',
                'description' => 'Paket nasi + ayam goreng + es teh untuk pelajar aktif.',
                'price' => 22000,
                'is_available' => true,
            ]);

            Product::firstOrCreate([
                'shop_id' => $shop2->id,
                'category_id' => $minuman->id,
                'name' => 'Jus Jeruk Segar',
            ], [
                'slug' => 'jus-jeruk-segar',
                'description' => 'Jus jeruk dingin kaya vitamin C.',
                'price' => 12000,
                'is_available' => true,
            ]);

            Product::firstOrCreate([
                'shop_id' => $shop2->id,
                'category_id' => $snack->id,
                'name' => 'Kentang Goreng',
            ], [
                'slug' => 'kentang-goreng',
                'description' => 'Kentang goreng renyah dengan pilihan saus sambal.',
                'price' => 10000,
                'is_available' => true,
            ]);
        }
    }
}
