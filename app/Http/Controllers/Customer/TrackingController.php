<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class TrackingController extends Controller
{
    public function index()
{
    $orders = Order::where('user_id',auth()->id())
        ->latest()
        ->get();

    return view(
        'layouts.navigation.customer.tracking',
        compact('orders')
    );
}

public function cancel(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    if ($order->status !== 'pending') {
        return back()->with(
            'error',
            'Pesanan tidak dapat dibatalkan.'
        );
    }

    $order->delete();

    return back()->with(
        'success',
        'Pesanan berhasil dibatalkan.'
    );
}
}
