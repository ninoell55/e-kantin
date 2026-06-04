<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ShopBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopBillController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;

        if (!$shop) {
            abort(403, 'Anda belum memiliki lapak terdaftar.');
        }

        // Ambil semua tagihan berdasarkan struktur tabel asli kamu
        $bills = ShopBill::where('shop_id', $shop->id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('vendor.bills.index', compact('shop', 'bills'));
    }

    public function pay(Request $request, $id)
    {
        $shop = Auth::user()->shop;

        $bill = ShopBill::where('id', $id)
            ->where('shop_id', $shop->id)
            ->firstOrFail();

        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'payment_proof' => 'required_if:payment_method,transfer|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->payment_method === 'transfer') {
            // Hapus bukti lama jika ada revisi re-upload
            if ($bill->payment_proof) {
                Storage::disk('public')->delete($bill->payment_proof);
            }

            // Simpan bukti transfer baru
            $path = $request->file('payment_proof')->store('bills/proofs', 'public');

            $bill->update([
                'payment_method' => 'transfer',
                'payment_proof' => $path,
                'status' => 'verifying',
            ]);

            return redirect()->back()->with('success', 'Bukti transfer berhasil dikirim! Menunggu verifikasi admin.');
        } else {
            // ========================================================
            // SKENARIO PINDAH KE CASH / TUNAI (OPTIMIZED)
            // ========================================================

            // JIKA SEBELUMNYA PERNAH UPLOAD BUKTI, HAPUS DARI STORAGE
            if ($bill->payment_proof) {
                Storage::disk('public')->delete($bill->payment_proof);
            }

            // Update database: hapus path payment_proof (set null) dan set status ke unpaid
            $bill->update([
                'payment_method' => 'cash',
                'payment_proof' => null, // Struk lama dihapus dari database
                'status' => 'unpaid',     // Status kembali ke unpaid karena belum setor cash
            ]);

            return redirect()->back()->with('success', 'Metode diubah ke Cash. Bukti transfer sebelumnya telah dihapus. Silakan bayar tunai ke Bendahara.');
        }
    }
}
