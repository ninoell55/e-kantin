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
        $vendors = User::where('role', 'vendor')
            ->where('status', 'active')
            ->with('shop')
            ->get();

        return view('admin.cash-payment.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'amount'  => 'required|numeric|min:1000',
        ], [
            'shop_id.required' => 'Pilih warung terlebih dahulu.',
            'shop_id.exists'   => 'Warung tidak ditemukan.',
            'amount.required'  => 'Nominal wajib diisi.',
            'amount.numeric'   => 'Nominal harus berupa angka.',
            'amount.min'       => 'Nominal minimal Rp 1.000.',
        ]);

        $paidAt = now();

        ShopBill::create([
            'shop_id'        => $request->shop_id,
            'amount'         => $request->amount,
            'month'          => $paidAt->translatedFormat('F'),
            'year'           => $paidAt->year,
            'due_date'       => $paidAt->copy()->addDays(30),
            'status'         => 'paid',
            'paid_at'        => $paidAt,
            'payment_method' => 'cash',
            'payment_proof'  => null,
        ]);

        return redirect()->route('admin.cash-payment.index')
            ->with('success', 'Pembayaran tunai berhasil dicatat.');
    }
}
