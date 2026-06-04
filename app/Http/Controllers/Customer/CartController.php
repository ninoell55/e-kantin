<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('customer.cart.index', compact('cart', 'total'));
    }

    public function add(Product $product)
    {
        // Cek ketersediaan produk dan status toko
        if (!$product->is_available || !$product->shop->is_open) {
            return redirect()->back()->with('error', 'Produk tidak tersedia atau toko tutup.');
        }

        $cart = session()->get('cart', []);

        // Logika 1 Order = 1 Shop
        // Jika sudah ada item di cart, cek apakah shop_id-nya sama
        if (!empty($cart)) {
            $firstItem = reset($cart);
            if ($firstItem['shop_id'] != $product->shop_id) {
                // Opsional: Hapus cart lama jika pindah toko, atau beri peringatan
                // session()->forget('cart'); 
                return redirect()->back()->with('error', 'Anda hanya dapat memesan dari satu toko dalam satu pesanan. Selesaikan atau hapus pesanan di toko sebelumnya.');
            }
        }

        // Jika produk sudah ada di cart, tambah quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Jika belum ada, tambah produk baru
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_path,
                "shop_id" => $product->shop_id,
                "shop_name" => $product->shop->name
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('customer.cart.index')->with('success', 'Produk berhasil ditambah ke keranjang!');
    }

    public function update(Request $request, string $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Keranjang diperbarui');
    }

    public function destroy(string $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }
}
