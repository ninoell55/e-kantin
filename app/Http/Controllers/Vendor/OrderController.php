<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    // 1. HALAMAN DAFTAR PESANAN MASUK
    public function index()
    {
        $shop = Auth::user()->shop;

        if (!$shop) {
            Alert::error('Gagal', 'Anda tidak memiliki akses lapak resmi.');
            return redirect()->route('dashboard');
        }

        // Ambil filter status dari parameter URL (?status=processing)
        $statusFilter = request('status');

        // Ambil data pesanan yang masuk khusus ke lapak ini beserta data customernya (user)
        $orders = Order::with('user')
            ->where('shop_id', $shop->id)
            ->when($statusFilter, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('vendor.order.index', compact('orders', 'shop'));
    }

    // 2. HALAMAN DETAIL PESANAN & RINCIAN MENU (ORDER ITEMS)
    public function show(Order $order)
    {
        // Proteksi Keamanan: Pastikan pesanan ini emang ditujukan ke lapak vendor yang sedang login
        if ($order->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Anda tidak diizinkan melihat pesanan ini.');
            return redirect()->route('vendor.order.index');
        }

        // Load relasi order_items dan data customer (user) biar gak N+1 query
        $order->load(['orderItems', 'user']);

        return view('vendor.order.show', compact('order'));
    }

    // 3. UPDATE STATUS PROSES PESANAN (pending -> processing -> ready -> completed / cancelled)
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Aksi tidak diizinkan.');
            return redirect()->route('vendor.order.index');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled'
        ]);

        $newStatus = $request->status;

        // PROTEKSI TRANSFER: Mencegah dapur memasak pesanan transfer yang belum lunas
        if (in_array($newStatus, ['processing', 'ready']) && $order->payment_method === 'transfer' && $order->payment_status !== 'paid') {
            Alert::error('Belum Bayar', 'Pesanan transfer wajib diverifikasi lunas terlebih dahulu sebelum diproses dapur.');
            return redirect()->back();
        }

        // LOGIKA BISNIS E-KANTIN (OTOMATIS PAID JIKA CASH/COD)
        // Diset 'paid' ketika statusnya sudah 'ready' (siap diambil) atau 'completed' (selesai)
        if (in_array($newStatus, ['ready', 'completed']) && ($order->payment_method === 'cash' || $order->payment_method === 'cod')) {
            $order->payment_status = 'paid';
        }

        $order->status = $newStatus;
        $order->save();

        Alert::success('Status Diperbarui', 'Pesanan kini berstatus: ' . strtoupper($newStatus));

        return redirect()->back();
    }

    // 4. VERIFIKASI PEMBAYARAN TRANSFER (unpaid -> verifying -> paid / failed)
    public function verifyPayment(Request $request, Order $order)
    {
        if ($order->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Aksi tidak diizinkan.');
            return redirect()->route('vendor.order.index');
        }

        $request->validate([
            'payment_status' => 'required|in:paid,failed'
        ]);

        $order->payment_status = $request->payment_status;

        // Kalau pembayaran gagal/failed, set status orderan jadi cancelled otomatis biar ga usah dimasak
        if ($request->payment_status === 'failed') {
            $order->status = 'cancelled';
        }

        $order->save();

        if ($request->payment_status === 'paid') {
            Alert::success('Pembayaran Sah!', 'Bukti transfer berhasil diverifikasi.');
        } else {
            Alert::warning('Pembayaran Ditolak', 'Status pesanan otomatis dibatalkan.');
        }

        return redirect()->back();
    }
}
