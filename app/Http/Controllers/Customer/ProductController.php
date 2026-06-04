<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //menampilkan daftar produk customer
    public function index(){
        $products= Product::with('shop')->get();
        return view('layouts.navigation.customer.menu',compact('products'));
    }
}
