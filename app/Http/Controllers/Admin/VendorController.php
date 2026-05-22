<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Tambahkan ini jika User merah
use App\Models\Shop; // Tambahkan ini jika Shop merah
use App\Models\ShopBill; // Tambahkan ini jika ShopBill merah
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan ini jika DB merah

class VendorController extends Controller
{
    public function index()
    {
        // Mengambil user vendor, warungnya, dan tagihan terbarunya
        $sellers = User::where('role', 'vendor')
            ->with(['shop.currentBill'])
            ->latest()
            ->get();

        return view('admin.vendor.index', compact('sellers'));
    }

    public function create()
    {
        return view('admin.vendor.create');
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
            return redirect()->route('admin.vendor.index')->with('success', 'Penjual berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $vendor = User::findOrFail($id);
        return view('admin.vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $seller = User::with('shop.currentBill')->findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255|unique:users,name,' . $id,
            'shop_name'      => 'required|string|max:255|unique:shops,name,' . ($seller->shop->id ?? 0) . ',id',
            'email'          => 'required|email|unique:users,email,' . $id,
            'password'       => 'nullable|min:8',
            'nominal_sewa'   => 'required|numeric',
            'payment_method' => 'required',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'shop_logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|in:active,banned',
        ], [
            'name.unique'      => 'Nama pemilik sudah digunakan.',
            'shop_name.unique' => 'Nama warung sudah digunakan.',
            'email.unique'     => 'Email sudah terdaftar.',
            'password.min'     => 'Password minimal 8 karakter.',
            'nominal_sewa.numeric' => 'Biaya sewa harus berupa angka.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Update User
            $data = [
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status ?? $seller->status,
            ];
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            $seller->update($data);

            // 2. Update Logo Warung
            if ($seller->shop) {
                $logoPath = $seller->shop->banner_path;
                if ($request->hasFile('shop_logo')) {
                    // Hapus logo lama
                    if ($logoPath && file_exists(public_path($logoPath))) {
                        unlink(public_path($logoPath));
                    }
                    $logo     = $request->file('shop_logo');
                    $logoName = 'logo_' . $seller->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
                    $logo->move(public_path('logo'), $logoName);
                    $logoPath = 'logo/' . $logoName;
                }

                $seller->shop->update([
                    'name'        => $request->shop_name,
                    'banner_path' => $logoPath,
                ]);

                // 3. Update Tagihan Aktif
                if ($seller->shop->currentBill) {
                    $proofPath = $seller->shop->currentBill->payment_proof;
                    if ($request->hasFile('payment_proof')) {
                        // Hapus bukti lama
                        if ($proofPath && file_exists(public_path($proofPath))) {
                            unlink(public_path($proofPath));
                        }
                        $file      = $request->file('payment_proof');
                        $fileName  = 'bukti_' . $seller->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('bukti_tf_vendor'), $fileName);
                        $proofPath = 'bukti_tf_vendor/' . $fileName;
                    }

                    $seller->shop->currentBill->update([
                        'amount'         => $request->nominal_sewa,
                        'payment_method' => $request->payment_method,
                        'payment_proof'  => $proofPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.vendor.index')->with('success', 'Data penjual berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->delete();

        return redirect()->route('admin.vendor.index')->with('success', 'Penjual telah dihapus!');
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
    public function suspend($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);
        $vendor->update(['status' => 'banned']);

        return redirect()->back()->with('success', 'Akun vendor berhasil dinonaktifkan.');
    }

    public function unsuspend($id)
    {
        $vendor = User::where('role', 'vendor')->findOrFail($id);
        $vendor->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Akun vendor berhasil diaktifkan kembali.');
    }
}
