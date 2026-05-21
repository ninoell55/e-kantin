<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //menampilkan cart
    public function index(){
        //ambil cart dari session
        $cart = session()->get('cart',[]);

        return view('customer.cart.index',compact('cart'));
    }

    //tambah produk ke cart
    public function add(Product $product){
        //ambil cart dari session 
        $cart = session()->get('cart',[]);
        //jika produk sudah ada di cart
        if (isset($cart[$product->id])){
            //tambah quantity
            $cart[$product->id]['quantity']++;
        } else{
            //tambah produk baru ke cart
            $cart[$product->id]= [
                'product_id' => $product->id,
                'shop_id'=> $product->shop_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        //simpan cart kembali ke session
        session()->put('cart',$cart);

        return back()->with('success','produk berhasil ditambahkan ke cart');
    }

    //update quantity cart
    public function update(Request $request, Product $product){
        //validasi quantity
        $request->validate(['quantity' => 'required|integer|min:1']);

        //ambil cart
        $cart = session()->get('cart',[]);

        //cek apakah produk ada di cart
        if (isset($cart[$product->id])){

        //update quantity
        $cart[$product->id]['quantity']= $request->quantity;

        //simpan kembali
        session()->put('cart',$cart);
        }

        return back()->with('success', 'cart berhasil diupdate');
    }

    //hapus item dari cart
    public function remove(Product $product){
        //ambil cart
        $cart = session()->get('cart',[]);

        //cek apakah produk ada
        if (isset($cart[$product->id])){
           
        //hapus item
            unset($cart[$product->id]);

            //simpan kembali
            session()->put('cart',$cart);
        }

        return back()->with('success', 'item berhasil dihapus');
    }

    //kosongkan cart
    public function clear(){
        //hapus session cart
        session()->forget('cart');

        return back()->with('success', 'cart berhasil dikosongkan');
    }

    //kurangi quantity cart
    public function decrease(Product $product){
        //ambil cart dari session
        $cart= session()->get('cart', []);
        //cek apakah produk ada di cart
        if (isset($cart [$product->id])){
            //kurangi quantity
            $cart[$product->id]['quantity']--;
            //kalau quantity <=0, hapus item
            if ($cart[$product->id]['quantity']<=0){
                unset($cart[$product->id]);
            }
            //simpan kembali ke session
            session()->put('cart',$cart);
        }

        return back()->with('success', 'quantity berhasil dikurangi.');
}
}