<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBill;
use App\Models\User;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $bills = ShopBill::with('shop.user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('shop_id');

        // Tambahan: untuk dropdown di modal catat pembayaran
        $vendors = User::where('role', 'vendor')
            ->where('status', 'active')
            ->with(['shop.currentBill'])
            ->get();

        return view('admin.invoice.index', compact('bills', 'vendors'));
    }

    public function show($id)
    {
        $bill = ShopBill::with('shop.user')->findOrFail($id);

        $status = $bill->status;
        if ($status === 'unpaid' && now()->gt(Carbon::parse($bill->due_date))) {
            $status = 'overdue';
        }

        $invoiceNumber = 'INV-' . str_pad($bill->id, 4, '0', STR_PAD_LEFT) . '-' . $bill->year;
        return view('admin.invoice.detail', compact('bill', 'status', 'invoiceNumber'));
    }

    public function confirmPayment($id)
    {
        $bill = ShopBill::findOrFail($id);
        $paidAt = now();
        $bill->update([
            'status'   => 'paid',
            'paid_at'  => $paidAt,
            'due_date' => $paidAt->copy()->addDays(30),
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}