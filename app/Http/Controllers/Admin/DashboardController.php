<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\ShopBill;
use App\Models\Shop;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stat cards
        $totalKategori = Category::count();
        $totalPengguna = User::where('role', 'customer')->count();
        $totalPenjual  = User::where('role', 'vendor')->count();
        $totalTagihan  = ShopBill::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // Status pembayaran donut
        $paidCount    = ShopBill::where('status', 'paid')->count();
        $unpaidCount  = ShopBill::where('status', 'unpaid')
            ->where('due_date', '>=', now())->count();
        $overdueCount = ShopBill::where('status', 'unpaid')
            ->where('due_date', '<', now())->count();

        // Chart bulanan (12 bulan tahun ini)
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = ShopBill::where('status', 'paid')
                ->whereMonth('paid_at', $m)
                ->whereYear('paid_at', now()->year)
                ->sum('amount');
        }

        // Daftar vendor + bill
        $vendors = User::where('role', 'vendor')
            ->with(['shop.currentBill'])
            ->latest()
            ->take(5)
            ->get();

        // Notifikasi: vendor overdue
        $overdueVendors = User::where('role', 'vendor')
            ->whereHas('shop.bills', function ($q) {
                $q->where('status', 'unpaid')->where('due_date', '<', now());
            })
            ->with('shop')
            ->take(3)
            ->get();

        // Notifikasi: baru dibayar
        $recentPaid = ShopBill::where('status', 'paid')
            ->whereNotNull('paid_at')
            ->where('paid_at', '>=', now()->subDays(7))
            ->with('shop')
            ->latest('paid_at')
            ->take(2)
            ->get();

        // Ringkasan bulan ini
        $targetSewa      = ShopBill::whereMonth('due_date', now()->month)
            ->whereYear('due_date', now()->year)
            ->sum('amount');
        $menungguTagihan = ShopBill::where('status', 'unpaid')
            ->whereMonth('due_date', now()->month)
            ->whereYear('due_date', now()->year)
            ->sum('amount');

        return view('admin.dashboard', compact(
            'totalKategori',
            'totalPengguna',
            'totalPenjual',
            'totalTagihan',
            'paidCount',
            'unpaidCount',
            'overdueCount',
            'monthlyRevenue',
            'vendors',
            'overdueVendors',
            'recentPaid',
            'targetSewa',
            'menungguTagihan'
        ));
    }
}
