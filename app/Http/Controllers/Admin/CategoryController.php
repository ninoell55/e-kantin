<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        // Tidak dipakai langsung — modal di-include dari index
        // Tapi tetap ada untuk jaga-jaga
        return redirect()->route('admin.category.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|unique:categories,slug|max:255'
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique'   => 'Nama kategori ini sudah ada.',
            'slug.unique'   => 'Slug ini sudah dipakai, gunakan yang lain.'
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // ✅ Redirect ke INDEX, bukan create
        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique'   => 'Nama kategori ini sudah ada.',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        // ✅ Redirect ke INDEX
        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}