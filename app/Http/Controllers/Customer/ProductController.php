<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // Load shop untuk menampilkan info toko di halaman produk
        $product->load('shop');

        return view('customer.product.show', compact('product'));
    }
}
