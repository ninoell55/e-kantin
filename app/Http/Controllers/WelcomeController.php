<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;

class WelcomeController extends Controller
{
    public function index()
    {
        $shops = Shop::withCount('products')->get();
        $products = Product::with('shop')->latest()->take(8)->get();

        return view('welcome', compact('shops', 'products'));
    }
}
