<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShopBill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashPaymentController extends Controller
{
    public function index()
    {
        $bills = ShopBill::with(['shop.user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('shop_id');

        $vendors = User::where('role', 'vendor')
            ->where('status', 'active')
            ->with(['shop.currentBill'])
            ->get();

        $ratePerMonth = 750000;

        return view('admin.invoice.index', compact('bills', 'vendors', 'ratePerMonth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'months'  => 'required|integer|min:1|max:12',
        ], [
            'shop_id.required' => 'Pilih warung terlebih dahulu.',
            'months.required'  => 'Jumlah bulan wajib diisi.',
            'months.min'       => 'Minimal 1 bulan.',
            'months.max'       => 'Maksimal 12 bulan.',
        ]);

        $ratePerMonth = 750000;
        $months       = (int) $request->months;
        $totalAmount  = $ratePerMonth * $months;
        $paidAt       = now();

        for ($i = 0; $i < $months; $i++) {
            $billDate = $paidAt->copy()->addMonths($i);

            ShopBill::create([
                'shop_id'        => $request->shop_id,
                'amount'         => $ratePerMonth,
                'month'          => $billDate->translatedFormat('F'),
                'year'           => $billDate->year,
                'due_date'       => $billDate->copy()->addDays(30),
                'status'         => 'paid',
                'paid_at'        => $paidAt,
                'payment_method' => 'cash',
                'payment_proof'  => null,
            ]);
        }

        return redirect()->route('admin.cash-payment.index')
            ->with('success', "Pembayaran tunai {$months} bulan (Rp " . number_format($totalAmount, 0, ',', '.') . ") berhasil dicatat.");
    }
}
