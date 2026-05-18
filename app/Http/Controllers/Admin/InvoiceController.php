<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $bills = ShopBill::with('shop.user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('shop_id');

        return view('admin.invoice.index', compact('bills'));
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
}
