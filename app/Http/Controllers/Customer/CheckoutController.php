<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    //menampilkan halaman checkout
    public function index(){
        //ambil cart dari session
        $cart=session()->get('cart',[]);
        //hitung total
        $total=0;
        foreach ($cart as $item){
            $total += $item['price']*$item['quantity'];
        }
        return view('customer.checkout.index',compact('cart', 'total'));
    }

    //simpan checkout
    public function store(Request $request){
        //validasi input
        $request->validate(['payment_method'=>'required|in:cash,transfer',
        'notes'=>'nullable|string',
        'order_type'=>'required|in:pickup,delivery',
        'delivery_location'=>'nullable|string|max:255'
        ]);
        //ambil cart dari session
        $cart = session()->get('cart',[]);
        //cegah checkout jika cart kosong
        if (count($cart)<1){
            return back()->with('error','keranjang kosong');
        }

        //hitung total
        $total =0;
        foreach ($cart as $item){
            $total += $item['price']*$item['quantity'];
        }

        //buat order
        $order = Order::create([
            'user_id' => auth()->id(),
            'shop_id'=>reset($cart)['shop_id'],
            'total_price'=>$total,
            'payment_method'=>$request->payment_method,
            'payment_status'=>'unpaid',
            'status'=>'pending',
            'notes'=>$request->notes,
        ]);
        //simpan order items
        foreach ($cart as $item){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$item['product_id'],
                'product_name'=>$item['name'],
                'quantity'=>$item['quantity'],
                'price'=>$item['price'],
            ]);
        }

        //hapus session cart
        session()->forget('cart');
        //redirect
        return redirect()
        ->route('customer.cart.index')
        ->with('success', 'pesanan berhasil dibuat');
    }
}
