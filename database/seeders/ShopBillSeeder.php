<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\ShopBill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShopBillSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Mengambil semua data lapak yang sudah di-seed oleh UserSeeder
        $shop1 = Shop::where('name', 'Warung Bu Lestari')->first();
        $shop2 = Shop::where('name', 'Dapur Kreatif SMK')->first();
        $shop3 = Shop::where('name', 'Mirice (Mie Gulung Rice Paper)')->first();
        $shop4 = Shop::where('name', 'Gorengan Hot Pak Opang')->first();
        $shop5 = Shop::where('name', 'Soto & Bakso Mang Fathan')->first();

        $currentYear = now()->year;

        // 1. Skenario Vendor 1: Tagihan Sudah Lunas (Paid) via Transfer
        if ($shop1) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop1->id,
                'month' => 'Mei',
                'year' => $currentYear,
            ], [
                'amount' => 300000,
                'due_date' => Carbon::create($currentYear, 5, 10)->toDateString(),
                'payment_method' => 'transfer',
                'payment_proof' => 'bills/proofs/sW0TovxZOOi0JcHWfi0HxX2V1MlmRH4PEJ8CPsSZ.png', // Contoh data dummy bukti transfer
                'status' => 'paid',
                'created_at' => Carbon::create($currentYear, 5, 1),
                'updated_at' => Carbon::create($currentYear, 5, 5), // Berbeda artinya sudah diproses
            ]);
        }

        // 2. Skenario Vendor 2: Sedang Menunggu Verifikasi Admin (Verifying)
        if ($shop2) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop2->id,
                'month' => 'Mei',
                'year' => $currentYear,
            ], [
                'amount' => 275000,
                'due_date' => Carbon::create($currentYear, 5, 15)->toDateString(),
                'payment_method' => 'transfer',
                'payment_proof' => 'bills/proofs/sW0TovxZOOi0JcHWfi0HxX2V1MlmRH4PEJ8CPsSZ.png', // Ceritanya vendor sudah upload bukti sewa
                'status' => 'verifying',
                'created_at' => Carbon::create($currentYear, 5, 1),
                'updated_at' => Carbon::create($currentYear, 5, 12),
            ]);
        }

        // 3. Skenario Vendor 3: Default Baru (Unpaid) - Belum Disentuh Sama Sekali
        if ($shop3) {
            $createdAt = Carbon::create($currentYear, 5, 1);
            ShopBill::firstOrCreate([
                'shop_id' => $shop3->id,
                'month' => 'Mei',
                'year' => $currentYear,
            ], [
                'amount' => 350000,
                'due_date' => now()->addDays(5)->toDateString(),
                'payment_method' => 'cash', // Bawaan default migration
                'payment_proof' => null,
                'status' => 'unpaid',
                // Set timestamps kembar identik agar memicu Skenario 4 ("Pilih Metode Bayar") di Blade kita kemarin
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        // 4. Skenario Vendor 4: Fix Memilih Tunai (Unpaid) - Tapi Belum Bayar Ke Bendahara
        if ($shop4) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop4->id,
                'month' => 'Mei',
                'year' => $currentYear,
            ], [
                'amount' => 250000,
                'due_date' => now()->addDays(3)->toDateString(),
                'payment_method' => 'cash',
                'payment_proof' => null,
                'status' => 'unpaid',
                'created_at' => Carbon::create($currentYear, 5, 1),
                'updated_at' => Carbon::create($currentYear, 5, 3), // Di-update tanggal 3 (Picu tombol kuning detail)
            ]);
        }

        // 5. Skenario Vendor 5: Tagihan Jatuh Tempo / Menunggak (Overdue)
        if ($shop5) {
            ShopBill::firstOrCreate([
                'shop_id' => $shop5->id,
                'month' => 'April', // Bulan lalu ceritanya kelupaan belum dibayar
                'year' => $currentYear,
            ], [
                'amount' => 300000,
                'due_date' => Carbon::create($currentYear, 4, 15)->toDateString(),
                'payment_method' => 'cash',
                'payment_proof' => null,
                'status' => 'overdue',
                'created_at' => Carbon::create($currentYear, 4, 1),
                'updated_at' => Carbon::create($currentYear, 4, 1),
            ]);
        }
    }
}
