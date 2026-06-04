<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $shopId = Auth::user()->shop->id;

        // 1. Logika Filter Waktu
        $filter = $request->get('filter', 'today'); // default hari ini
        $startDate = Carbon::today();
        $endDate = Carbon::now();

        if ($filter == 'this_month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($filter == 'custom' && $request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
        }

        // 2. Query Utama: Ambil orderan yang sukses & lunas saja
        $baseQuery = Order::where('shop_id', $shopId)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Hitung Ringkasan (Statistik)
        $totalRevenue = $baseQuery->sum('total_price');
        $totalOrders = $baseQuery->count();

        // 3. Ambil Rincian Transaksi untuk Tabel Laporan
        $orders = $baseQuery->with('user')->orderBy('created_at', 'desc')->get();

        // 4. Query Produk Terlaris (Top Selling Products)
        $topProducts = OrderItem::whereHas('order', function ($query) use ($shopId, $startDate, $endDate) {
            $query->where('shop_id', $shopId)
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->select('product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(quantity * price) as total_sales'))
            ->groupBy('product_name')
            ->orderBy('total_qty', 'desc')
            ->take(5) // Ambil top 5 terlaris
            ->get();

        return view('vendor.report.index', compact(
            'orders',
            'totalRevenue',
            'totalOrders',
            'topProducts',
            'filter',
            'startDate',
            'endDate'
        ));
    }

    public function exportPdf(Request $request)
    {
        $shop = Auth::user()->shop;
        $shopId = $shop->id;

        // Logika Filter Waktu (Sama dengan Index)
        $filter = $request->get('filter', 'today');
        $startDate = Carbon::today();
        $endDate = Carbon::now();

        if ($filter == 'this_month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($filter == 'custom' && $request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
        }

        // Ambil Data Pendapatan & Pesanan Sukses
        $baseQuery = Order::where('shop_id', $shopId)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate]);

        $totalRevenue = $baseQuery->sum('total_price');
        $totalOrders = $baseQuery->count();
        $orders = $baseQuery->with('user')->orderBy('created_at', 'desc')->get();

        // Ambil Data Produk Terlaris
        $topProducts = OrderItem::whereHas('order', function ($query) use ($shopId, $startDate, $endDate) {
            $query->where('shop_id', $shopId)
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->select('product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(quantity * price) as total_sales'))
            ->groupBy('product_name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        // Load View khusus PDF
        $pdf = Pdf::loadView('vendor.report.pdf', compact(
            'shop',
            'orders',
            'totalRevenue',
            'totalOrders',
            'topProducts',
            'filter',
            'startDate',
            'endDate'
        ));

        // Generate nama file sesuai dengan nama toko & tanggal rekap
        $filename = 'Laporan_Penjualan_' . str_replace(' ', '_', $shop->name) . '_' . $startDate->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}
