<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(){
    //ambil shops yg tersedia
        $shops = Shop::all();
         $products= Product::with(['shop','category'])->get();
         return view('layouts.navigation.customer.menu', compact('shops','products'));
}
}
