<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori dari database
        $categories = Category::all();

        // Mengirim data ke view index
        return view('admin.category.index', compact('categories'));
    }
    /**
     * Menampilkan halaman form tambah kategori
     */
    public function create()
    {
        // Pastikan folder resources/views/admin/category/create.blade.php ada
        return view('admin.category.create');
    }

    /**
     * Memproses data dari form (Logika Backend)
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|unique:categories,slug|max:255'
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique'   => 'Nama kategori ini sudah ada.',
            'slug.unique'   => 'Slug ini sudah dipakai, gunakan yang lain.'
        ]);

        // 2. Logika pembuatan Slug
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // 3. Simpan ke database
        Category::create([
            'name' => $request->name,
                'slug' => $slug
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.category.create')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
