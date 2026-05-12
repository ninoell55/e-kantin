<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data lapak milik penjual yang sedang login
        $shop = Auth::user()->shop;

        // Jika belum punya lapak, arahkan ke halaman setup (atau berikan error)
        if (!$shop) {
            abort(403, 'Anda belum memiliki lapak terdaftar.');
        }

        $today = Carbon::today();

        // 2. Hitung Pendapatan Hari Ini (Hanya pesanan yang sudah dibayar)
        $todayRevenue = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->where('payment_status', 'paid')
            ->sum('total_price');

        // 3. Hitung Total Pesanan Masuk Hari Ini
        $todayOrdersCount = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->count();


        $pendingOrders = Order::with(['user', 'items'])
            ->where('shop_id', $shop->id)
            ->whereIn('status', ['pending', 'processing'])
            ->orderBy('created_at', 'asc') // Urutkan dari yang paling lama menunggu
            ->get();

        // 5. Lempar semua data ke tampilan Blade
        return view('vendor.dashboard', compact(
            'shop',
            'todayRevenue',
            'todayOrdersCount',
            'pendingOrders'
        ));
    }
}
