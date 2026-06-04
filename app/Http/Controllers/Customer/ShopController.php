<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{
    public function show(string $id)
    {
        // Mengambil data toko beserta produk yang tersedia
        $shop = Shop::with(['products' => function ($query) {
            $query->where('is_available', true);
        }])->findOrFail($id);

        return view('customer.shop.show', compact('shop'));
    }
}
