<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop; // Pastikan model Shop diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan riwayat pesanan
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('customer.order.index', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::with(['orderItems', 'shop'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return view('customer.order.show', compact('order'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('swal_error', 'Keranjang kosong.');
        }

        $firstItem = reset($cart);
        $shop = Shop::find($firstItem['shop_id']);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('customer.order.checkout', compact('cart', 'subtotal', 'shop'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('customer.cart.index')->with('swal_error', 'Keranjang kosong.');

        $request->validate([
            'order_type'        => 'required|in:pickup,delivery',
            'delivery_location' => 'required_if:order_type,delivery|nullable|string|max:255',
            'payment_method'    => 'required|in:cash,transfer',
            'payment_proof'     => 'required_if:payment_method,transfer|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $deliveryFee = ($request->order_type === 'delivery') ? 2000 : 0;
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $totalPrice = $subtotal + $deliveryFee;

        $imagePath = null;
        if ($request->hasFile('payment_proof')) {
            $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $order = null;
        DB::transaction(function () use ($request, $cart, $imagePath, $deliveryFee, $totalPrice, &$order) {
            $firstItem = reset($cart);
            $order = Order::create([
                'user_id'           => Auth::id(),
                'shop_id'           => $firstItem['shop_id'],
                'invoice_number'    => 'INV-' . time() . '-' . Auth::id(),
                'order_type'        => $request->order_type,
                'delivery_location' => $request->delivery_location,
                'delivery_fee'      => $deliveryFee,
                'total_price'       => $totalPrice,
                'payment_method'    => $request->payment_method,
                'payment_status'    => ($request->payment_method === 'transfer') ? 'verifying' : 'unpaid',
                'payment_proof'     => $imagePath,
                'status'            => 'pending'
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_image_path' => $item['image'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
        });

        session()->forget('cart');
        return redirect()->route('customer.order.show', $order->id)
            ->with('swal_success', 'Pesanan berhasil dibuat!');
    }
}
