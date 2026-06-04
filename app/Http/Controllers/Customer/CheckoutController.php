<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'customer_name' => ['required', 'string'],
        'customer_class' => ['required', 'string'],
        'order_type' => ['required', 'in:pickup,delivery'],
        'payment_method' => ['required', 'in:cash,transfer'],
        'delivery_location' => ['nullable', 'string'],
        'notes' => ['nullable', 'string'],
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Keranjang kosong.');
    }

    DB::transaction(function () use ($request, $cart) {

        $groupedCart = collect($cart)->groupBy('shop_id');

        foreach ($groupedCart as $shopId => $items) {

            $subtotal = 0;

            foreach ($items as $item) {
                $subtotal += $item['price'] * $item['qty'];
            }

            $deliveryFee =
                $request->order_type === 'delivery'
                ? 2000
                : 0;

            $totalPrice = $subtotal + $deliveryFee;

            $lastOrder = Order::latest('id')->first();

            $nextNumber = $lastOrder
                ? $lastOrder->id + 1
                : 1;

            $invoiceNumber =
                'INV-' .
                str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $paymentStatus =
                $request->payment_method === 'cash'
                ? 'unpaid'
                : 'verifying';

            $finalNotes =
                "Nama: {$request->customer_name}\n" .
                "Kelas: {$request->customer_class}\n\n" .
                ($request->notes ?? '');

            $order = Order::create([
                'user_id' => auth()->id(),
                'shop_id' => $shopId,
                'invoice_number' => $invoiceNumber,

                'order_type' => $request->order_type,

                'delivery_location' =>
                    $request->delivery_location,

                'delivery_fee' => $deliveryFee,

                'total_price' => $totalPrice,

                'payment_method' =>
                    $request->payment_method,

                'payment_status' =>
                    $paymentStatus,

                'status' => 'pending',

                'notes' => $finalNotes,
            ]);

            foreach ($items as $item) {

                OrderItem::create([
                    'order_id' => $order->id,

                    'product_id' => $item['id'],

                    'product_name' => $item['name'],

                    'product_image_path' =>
                        $item['image'] ?? null,

                    'quantity' => $item['qty'],

                    'price' => $item['price'],
                ]);
            }
        }
    });

    session()->forget('cart');

    return redirect('/customer/tracking')
        ->with('success', 'Pesanan berhasil dibuat.');
}

public function index()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect('/customer/cart')
            ->with('error', 'Keranjang kosong.');
    }

    $totalItem = 0;
    $subtotal = 0;

    foreach ($cart as $item) {
        $totalItem += $item['qty'];
        $subtotal += $item['price'] * $item['qty'];
    }

    return view(
        'layouts.navigation.customer.checkout',
        compact(
            'cart',
            'totalItem',
            'subtotal'
        )
    );
}
}
