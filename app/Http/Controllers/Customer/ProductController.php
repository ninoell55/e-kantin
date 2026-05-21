<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //menampilkan daftar produk customer
    public function index(){
        //ambil produk yg tersedia
        $products = Product::where('is_available',true)->get();
        return view('customer.products.index', compact('products'));
    }
}
