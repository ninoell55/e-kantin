<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->latest()
            ->get();

        return view('admin.costumer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.costumer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone'    => 'required|numeric|digits_between:10,15',
        ], [
            'name.unique'   => 'Nama sudah terdaftar.',
            'email.unique'  => 'Email sudah terdaftar.',
            'password.min'  => 'Password minimal 8 karakter.',
            'phone.max'     => 'Nomor telepon maksimal 20 karakter.',
        ]);

        User::create([
            'id_number' => \Illuminate\Support\Str::random(10),
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone'     => $request->phone,
            'role'      => 'customer',
            'status'    => 'active',
        ]);

        return redirect()->route('admin.costumer.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function show($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('admin.costumer.detail', compact('customer'));
    }
    public function ban($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->update(['status' => 'banned']);

        return redirect()->route('admin.costumer.index')->with('success', 'Customer berhasil di-banned.');
    }

    public function activate($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->update(['status' => 'active']);

        return redirect()->route('admin.costumer.index')->with('success', 'Customer berhasil diaktifkan.');
    }
}
