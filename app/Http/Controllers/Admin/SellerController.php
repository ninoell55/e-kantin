<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Tambahkan ini jika User merah
use App\Models\Shop; // Tambahkan ini jika Shop merah
use App\Models\ShopBill; // Tambahkan ini jika ShopBill merah
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan ini jika DB merah

class SellerController extends Controller
{
    public function index()
    {
        // Mengambil user vendor, warungnya, dan tagihan terbarunya
        $sellers = User::where('role', 'vendor')
            ->with(['shop.currentBill'])
            ->latest()
            ->get();

        return view('admin.seller.index', compact('sellers'));
    }

    public function create()
    {
        return view('admin.seller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|unique:users,name',
            'shop_name'      => 'required|unique:shops,name',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8',
            'nominal_sewa'   => 'required|numeric',
            'payment_method' => 'required',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'shop_logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.unique'      => 'Nama pemilik sudah terdaftar.',
            'shop_name.unique' => 'Nama warung sudah digunakan.',
            'email.unique'     => 'Email sudah terdaftar.',
            'email.email'      => 'Format email tidak valid.',
            'password.min'     => 'Password minimal 8 karakter.',
            'nominal_sewa.numeric' => 'Biaya sewa harus berupa angka.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan User
            $user = \App\Models\User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'vendor',
                'status'   => 'active',
                'phone'    => $request->phone,
            ]);

            // 2. Handle Logo Warung → public/logo/
            $logoPath = null;
            if ($request->hasFile('shop_logo')) {
                $logo     = $request->file('shop_logo');
                $logoName = 'logo_' . $user->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('logo'), $logoName);
                $logoPath = 'logo/' . $logoName;
            }

            // 3. Simpan Shop
            $shop = \App\Models\Shop::create([
                'user_id'     => $user->id,
                'name'        => $request->shop_name,
                'banner_path' => $logoPath,
            ]);

            // 4. Handle Bukti Transfer → public/bukti_tf_vendor/
            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                $file      = $request->file('payment_proof');
                $fileName  = 'bukti_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('bukti_tf_vendor'), $fileName);
                $proofPath = 'bukti_tf_vendor/' . $fileName;
            }

            // 5. Simpan Tagihan — status langsung PAID, payment_method tersimpan benar
            \App\Models\ShopBill::create([
                'shop_id'        => $shop->id,
                'amount'         => $request->nominal_sewa,
                'month'          => now()->translatedFormat('F'),
                'year'           => now()->year,
                'due_date'       => now()->addMonth(),
                'status'         => 'paid',
                'paid_at'        => now(),
                'payment_method' => $request->payment_method,
                'payment_proof'  => $proofPath,
            ]);

            DB::commit();
            return redirect()->route('admin.seller.index')->with('success', 'Penjual berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $seller = User::findOrFail($id);
        return view('admin.seller.edit', compact('seller'));
    }

    public function update(Request $request, $id)
    {
        $seller = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $seller->update($data);

        return redirect()->route('admin.seller.index')->with('success', 'Data penjual diperbarui!');
    }

    public function destroy($id)
    {
        $seller = User::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.seller.index')->with('success', 'Penjual telah dihapus!');
    }
    public function activate($id)
    {
        $user = \App\Models\User::with('shop.currentBill')->findOrFail($id);

        // 1. Update status tagihan menjadi 'paid'
        if ($user->shop && $user->shop->currentBill) {
            $user->shop->currentBill->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);
        }

        // 2. Aktifkan akun penjual
        $user->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Pembayaran diterima! Akun penjual sekarang aktif.');
    }
}
