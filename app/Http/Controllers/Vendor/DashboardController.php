<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data lapak milik penjual yang sedang login (Tabel users -> shops)
        $shop = Auth::user()->shop;

        // Jika belum punya lapak, batalkan aksinya
        if (!$shop) {
            abort(403, 'Anda belum memiliki lapak terdaftar di sistem E-Kantin.');
        }

        $today = Carbon::today();

        // 2. Hitung Pendapatan Hari Ini (Langsung sum kolom total_price dari tabel orders!)
        $todayRevenue = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->where('status', 'completed')
            ->where('payment_status', 'paid') // Memastikan pesanan berstatus sukses dan lunas
            ->sum('total_price');

        // 3. Hitung Total Pesanan Masuk Hari Ini (Kecualikan yang cancelled)
        $todayOrdersCount = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->where('status', '!=', 'cancelled')
            ->count();

        // 4. Hitung Pesanan yang Sedang Diproses (status = processing)
        $processingOrdersCount = Order::where('shop_id', $shop->id)
            ->where('status', 'processing')
            ->count();

        // 5. Hitung Total Menu/Produk yang Dimiliki Lapak Ini
        $totalProductsCount = Product::where('shop_id', $shop->id)->count();

        // Ambil parameter filter kategori dari URL (jika ada)
        $selectedCategory = request('category');

        // Ambil daftar produk milik toko ini dengan filter kategori dinamis
        $products = Product::where('shop_id', $shop->id)
            ->when($selectedCategory, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // 6. Ambil Antrean Pesanan Aktif (FIFO: Urutkan dari yang paling lama masuk)
        // Memanfaatkan relasi langsung karena shop_id sudah terikat di order
        $pendingOrders = Order::with(['user', 'orderItems'])
            ->where('shop_id', $shop->id)
            ->whereIn('status', ['pending', 'processing'])
            ->orderBy('created_at', 'asc') // FIFO (First In First Out)
            ->get();

        $totalBalance = Order::where('shop_id', $shop->id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->sum('total_price');

        // 7. Lempar semua data ke tampilan Blade Dashboard Vendor
        return view('vendor.dashboard', compact(
            'shop',
            'todayRevenue',
            'todayOrdersCount',
            'totalBalance',
            'processingOrdersCount',
            'totalProductsCount',
            'products',
            'pendingOrders'
        ));
    }
}
