<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    // Menampilkan halaman pengaturan toko
    public function index()
    {
        $shop = Auth::user()->shop;

        if (!$shop) {
            abort(403, 'Anda belum memiliki lapak terdaftar.');
        }

        return view('vendor.shop.index', compact('shop'));
    }

    // Menyimpan perubahan data toko
    public function update(Request $request)
    {
        $shop = Auth::user()->shop;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'payment_info' => 'nullable|string|max:255',
            'is_open' => 'nullable|boolean',
        ]);

        // Siapkan data untuk diupdate
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'payment_info' => $request->payment_info,
            'is_open' => $request->has('is_open') ? true : false,
        ];

        // Handle Upload Banner
        if ($request->hasFile('banner')) {
            // Hapus banner lama jika ada
            if ($shop->banner_path) {
                Storage::disk('public')->delete($shop->banner_path);
            }
            $data['banner_path'] = $request->file('banner')->store('shops/banners', 'public');
        }

        // Handle Upload QR Code Pembayaran
        if ($request->hasFile('qr_image')) {
            // Hapus QR lama jika ada
            if ($shop->qr_image_path) {
                Storage::disk('public')->delete($shop->qr_image_path);
            }
            $data['qr_image_path'] = $request->file('qr_image')->store('shops/qrcodes', 'public');
        }

        $shop->update($data);

        return redirect()->back()->with('success', 'Profil lapak kantin berhasil diperbarui!');
    }

    public function toggleStatus(Request $request)
    {
        $shop = Auth::user()->shop;

        if (!$shop) {
            return response()->json([
                'success' => false,
                'message' => 'Data lapak tidak ditemukan.'
            ], 404);
        }

        // Validasi input pastikan boolean
        $request->validate([
            'is_open' => 'required|boolean'
        ]);

        // Update database
        $shop->update([
            'is_open' => $request->is_open
        ]);

        // Kembalikan response JSON ke Javascript
        return response()->json([
            'success' => true,
            'is_open' => $shop->is_open,
            'message' => $shop->is_open ? 'Lapak berhasil dibuka' : 'Lapak ditutup'
        ]);
    }
}
