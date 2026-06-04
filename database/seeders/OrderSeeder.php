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
        // 1. Ambil Data Customer (Siswa & Guru sesuai UserSeeder)
        $ridho  = User::where('id_number', '222310123')->first(); // Siswa
        $indah  = User::where('id_number', '222310124')->first(); // Siswa
        $afika  = User::where('id_number', '19880412001')->first(); // Guru
        $jihan  = User::where('id_number', '19950718005')->first(); // Guru

        // 2. Ambil Data Lapak/Shop yang Benar
        $shopLestari = Shop::where('name', 'Warung Bu Lestari')->first();
        $shopDapur   = Shop::where('name', 'Dapur Kreatif SMK')->first();
        $shopMirice  = Shop::where('name', 'Mirice (Mie Gulung Rice Paper)')->first();

        // --- SKENARIO 1: Siswa Ridho beli di Warung Bu Lestari (Selesai & Cash) ---
        if ($ridho && $shopLestari) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-2026-0001',
            ], [
                'user_id' => $ridho->id,
                'shop_id' => $shopLestari->id,
                'order_type' => 'pickup',
                'delivery_location' => null,
                'delivery_fee' => 0,
                'total_price' => 20000,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'status' => 'completed',
                'notes' => 'Ambil pas istirahat pertama, sendoknya dua ya bun.',
            ]);
        }

        // --- SKENARIO 2: Siswa Indah order di Dapur SMK (Sedang Diverifikasi via VA/Transfer) ---
        if ($indah && $shopDapur) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-2026-0002',
            ], [
                'user_id' => $indah->id,
                'shop_id' => $shopDapur->id,
                'order_type' => 'delivery',
                'delivery_location' => 'Gedung Rektorat Lantai 2, Ruang TU',
                'delivery_fee' => 2000,
                'total_price' => 27000,
                'payment_method' => 'transfer',
                'payment_status' => 'verifying', // Status yang kamu tanyakan tadi, menunggu konfirmasi admin
                'status' => 'pending', // Masih pending karena transfernya belum divalidasi
                'notes' => 'Tolong antarkan sebelum jam istirahat selesai.',
            ]);
        }

        // --- SKENARIO 3: Bu Afika (Guru) order di Mirice (Sedang Diproses/Dimasak Vendor) ---
        if ($afika && $shopMirice) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-2026-0003',
            ], [
                'user_id' => $afika->id,
                'shop_id' => $shopMirice->id,
                'order_type' => 'delivery',
                'delivery_location' => 'Ruang Guru Utama (Meja Depan)',
                'delivery_fee' => 3000,
                'total_price' => 33000,
                'payment_method' => 'cash',
                'payment_status' => 'paid', // Ceritanya sudah bayar cash / langganan
                'status' => 'processing', // Sedang digulung & digoreng oleh vendor
                'notes' => 'Mie gulungnya bumbu balado ekstra pedas ya mas Nino.',
            ]);
        }

        // --- SKENARIO 4: Bu Jihan (Guru) order di Warung Bu Lestari (Siap Diambil/Ready) ---
        if ($jihan && $shopLestari) {
            Order::firstOrCreate([
                'invoice_number' => 'INV-2026-0004',
            ], [
                'user_id' => $jihan->id,
                'shop_id' => $shopLestari->id,
                'order_type' => 'pickup',
                'delivery_location' => null,
                'delivery_fee' => 0,
                'total_price' => 15000,
                'payment_method' => 'cash',
                'payment_status' => 'unpaid', // Bayar nanti pas ambil makanan
                'status' => 'ready', // Makanan sudah matang, tinggal diambil ke kantin
                'notes' => 'Jus mangganya jangan terlalu manis, kurangin susunya.',
            ]);
        }
    }
}
