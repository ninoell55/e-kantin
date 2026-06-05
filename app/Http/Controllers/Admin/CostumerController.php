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
            'id_number' => 'required|string|max:50|unique:users,id_number',
            'name'      => 'required|string|max:255|unique:users,name',
            'email'     => 'nullable|email|unique:users,email', // Ubah ke nullable
            'password'  => 'required|min:8',
            'phone'     => 'nullable|numeric|digits_between:10,15', // Ubah ke nullable
        ], [
            'id_number.unique' => 'ID Number sudah digunakan.',
            'name.unique'      => 'Nama sudah terdaftar.',
            'password.min'     => 'Password minimal 8 karakter.',
        ]);

        User::create([
            'id_number' => $request->id_number,
            'name'      => $request->name,
            'email'     => $request->email, // Bisa bernilai null
            'password'  => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone'     => $request->phone, // Bisa bernilai null
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
