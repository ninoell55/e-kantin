<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'shops' => $product->shop->name,
            'image' => $product->image,
            'shop_id' => $product->shop_id,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);

    return back();
}

public function index()
{
    $cart = session()->get('cart', []);

    return view('layouts.navigation.customer.cart', compact('cart'));
}

public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {

        if($request->action == 'plus') {
            $cart[$id]['qty']++;
        }

        if($request->action == 'minus') {
            $cart[$id]['qty']--;

            if($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }
    }

    session()->put('cart', $cart);

    return back();
}
}