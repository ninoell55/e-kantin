<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Shop;
use App\Models\ShopBill;

#[Signature('app:generate-monthly-bills')]
#[Description('Generate tagihan bulanan otomatis untuk semua warung aktif')]
class GenerateMonthlyBills extends Command
{
    public function handle()
    {
        $now   = Carbon::now();
        $count = 0;

        $shops = Shop::whereHas('user', function ($q) {
            $q->where('status', 'active');
        })->get();

        foreach ($shops as $shop) {
            $lastBill = ShopBill::where('shop_id', $shop->id)
                ->latest()
                ->first();

            if (!$lastBill) {
                $this->warn("⚠ [{$shop->name}] Belum punya tagihan — skip.");
                continue;
            }

            $nextDueDate = Carbon::parse($lastBill->due_date)->addMonth();

            // Cek tagihan bulan ini sudah ada belum
            $exists = ShopBill::where('shop_id', $shop->id)
                ->where('month', $nextDueDate->translatedFormat('F'))
                ->where('year', $nextDueDate->year)
                ->exists();

            if ($exists) {
                $this->line("→ [{$shop->name}] Tagihan bulan ini sudah ada — skip.");
                continue;
            }

            // Generate 5 hari sebelum jatuh tempo
            if ($now->greaterThanOrEqualTo($nextDueDate->copy()->subDays(5))) {
                ShopBill::create([
                    'shop_id'        => $shop->id,
                    'amount'         => $lastBill->amount,
                    'month'          => $now->translatedFormat('F'),
                    'year'           => $now->year,
                    'due_date'       => $nextDueDate,
                    'status'         => 'unpaid',
                    'payment_method' => null,
                    'payment_proof'  => null,
                    'paid_at'        => null,
                ]);

                $this->info("✔ [{$shop->name}] Tagihan baru dibuat — jatuh tempo {$nextDueDate->format('d M Y')}.");
                $count++;
            }
        }

        $this->info("\n✅ Selesai. Total {$count} tagihan baru dibuat.");
    }
}
