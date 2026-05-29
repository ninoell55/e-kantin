<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\ShopBill;
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
                            ->where(function($q) {
                                $q->whereMonth('paid_at', now()->month)
                                  ->whereYear('paid_at', now()->year)
                                  ->orWhereNull('paid_at');
                            })
                            ->sum('amount');

        // Status pembayaran (donut)
        $paidCount    = ShopBill::where('status', 'paid')->count();
        $overdueCount = ShopBill::where('status', 'unpaid')
                            ->where('due_date', '<', now())
                            ->count();
        $unpaidCount  = ShopBill::where('status', 'unpaid')
                            ->where('due_date', '>=', now())
                            ->count();

        // Daftar vendor + tagihan (tabel bawah)
        $vendors = User::where('role', 'vendor')
                    ->with(['shop.currentBill'])
                    ->latest()
                    ->take(6)
                    ->get();

        // Pemasukan per bulan (chart)
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = ShopBill::where('status', 'paid')
                ->whereMonth('paid_at', $m)
                ->whereYear('paid_at', now()->year)
                ->sum('amount');
        }

        // Ringkasan bulan ini
        $targetSewa      = ShopBill::whereMonth('due_date', now()->month)
                            ->whereYear('due_date', now()->year)
                            ->sum('amount');
        $menungguTagihan = ShopBill::where('status', 'unpaid')
                            ->whereMonth('due_date', now()->month)
                            ->whereYear('due_date', now()->year)
                            ->sum('amount');

        // Notifikasi
        $overdueVendors = User::where('role', 'vendor')
                            ->whereHas('shop.bills', function($q) {
                                $q->where('status', 'unpaid')->where('due_date', '<', now());
                            })
                            ->with('shop')
                            ->take(3)
                            ->get();

        $recentPaid = ShopBill::where('status', 'paid')
                        ->where('paid_at', '>=', now()->subDays(7))
                        ->with('shop')
                        ->latest('paid_at')
                        ->take(3)
                        ->get();

        $notifCount = $overdueVendors->count() + $recentPaid->count();

        return view('admin.dashboard', compact(
            'totalKategori', 'totalPengguna', 'totalPenjual', 'totalTagihan',
            'paidCount', 'unpaidCount', 'overdueCount',
            'vendors', 'monthlyRevenue',
            'targetSewa', 'menungguTagihan',
            'overdueVendors', 'recentPaid', 'notifCount'
        ));
    }
}