<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use id;
use Illuminate\Http\Request;
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
    public function destroy($id)
    {
        // 1. Cari data berdasarkan ID
        $category = Category::findOrFail($id);

        // 2. Hapus data
        $category->delete();

        // 3. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus!');
    }
    
    public function edit($id)
    {
        // Ambil data kategori yang mau diedit
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        // 2. Cari data
        $category = Category::findOrFail($id);

        // 3. Update data
        $category->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ]);

        // 4. Redirect ke index
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui!');
    }
}
