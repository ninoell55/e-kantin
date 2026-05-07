<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
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
