<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // 1. Siapkan Query Produk
        $productQuery = Product::with('shop');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $productQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('shop', function ($shopQuery) use ($searchTerm) {
                        $shopQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        if ($request->filled('category')) {
            $productQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $products = $productQuery->latest()->get();

        // 2. Optimasi Shop: 
        // Jika user sedang memfilter, kita bisa memprioritaskan toko yang memiliki produk tersebut
        $shops = Shop::query()
            ->when($request->filled('search') || $request->filled('category'), function ($query) use ($productQuery) {
                // Opsional: Hanya tampilkan toko yang punya produk hasil filter
                $productIds = $productQuery->pluck('shop_id')->unique();
                return $query->whereIn('id', $productIds);
            })
            ->orderBy('is_open', 'desc')
            ->get();

        return view('customer.dashboard', compact('categories', 'shops', 'products'));
    }
}
