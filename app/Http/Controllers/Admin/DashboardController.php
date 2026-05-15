<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\ShopBill;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Category::count();

        $totalPengguna = User::where('role', 'customer')->count();

        $totalPenjual = User::where('role', 'vendor')->count();

        $totalTagihan = ShopBill::where('status', 'paid')->sum('amount');

        return view('admin.dashboard', compact(
            'totalKategori',
            'totalPengguna',
            'totalPenjual',
            'totalTagihan'
        ));
    }
}