<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert; // Import Facade SweetAlert RealRashid

class ProductController extends Controller
{
    // 1. HALAMAN SEMUA PRODUK (Katalog Internal Lapak)
    public function index()
    {
        $shop = Auth::user()->shop;

        // Ambil input filter kategori dari URL query string (?category=makanan)
        $selectedCategory = request('category');

        // Ambil produk milik lapak ini beserta kategori terkait
        $products = Product::with('category')
            ->where('shop_id', $shop->id)

            // Logika Filter: Jika parameter category ada di URL, saring berdasarkan nama kategori
            ->when($selectedCategory, function ($query, $category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('name', 'like', '%' . $category . '%');
                });
            })

            ->latest()
            ->paginate(12)
            // Menjaga agar link pagination (?page=2) tidak menghilangkan filter kategori yang aktif
            ->withQueryString();

        return view('vendor.product.index', compact('products', 'shop'));
    }

    // 2. FORM TAMBAH MENU
    public function create()
    {
        // Ambil semua kategori dari database untuk drop-down select option
        $categories = Category::all();

        return view('vendor.product.form', [
            'title' => 'Tambah Menu Baru',
            'action' => route('vendor.product.store'),
            'method' => 'POST',
            'product' => new Product(),
            'categories' => $categories
        ]);
    }

    // 3. SIMPAN MENU BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id', // Validasi id kategori wajib ada di DB
            'price' => 'required|numeric|min:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_available' => 'nullable|boolean'
        ]);

        $shop = Auth::user()->shop;

        // Bikin slug unik otomatis dari nama menu
        $slug = Str::slug($request->name);
        // Jaga-jaga kalau ada nama menu yang sama persis di lapak lain agar slug tetap unik
        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $validated['shop_id'] = $shop->id;
        $validated['slug'] = $slug;
        $validated['is_available'] = $request->has('is_available');

        Product::create($validated);

        // Memicu Alert Sukses ala RealRashid
        Alert::success('Berhasil!', 'Menu baru berhasil ditambahkan ke etalase.');

        return redirect()->route('vendor.product.index');
    }

    // 4. DETAIL LIHAT PRODUK
    public function show(Product $product)
    {
        if ($product->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Aksi ini tidak diizinkan.');
            return redirect()->route('vendor.product.index');
        }

        return view('vendor.product.show', compact('product'));
    }

    // 5. FORM EDIT MENU
    public function edit(Product $product)
    {
        if ($product->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Aksi ini tidak diizinkan.');
            return redirect()->route('vendor.product.index');
        }

        $categories = Category::all();

        return view('vendor.product.form', [
            'title' => 'Edit Menu Kantin',
            'action' => route('vendor.product.update', $product->id),
            'method' => 'PUT',
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // 6. UPDATE DATA MENU
    public function update(Request $request, Product $product)
    {
        if ($product->shop_id !== Auth::user()->shop->id) {
            Alert::error('Akses Ditolak', 'Aksi ini tidak diizinkan.');
            return redirect()->route('vendor.product.index');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_available' => 'nullable|boolean'
        ]);

        // Update slug kalau namanya berubah
        if ($product->name !== $request->name) {
            $slug = Str::slug($request->name);
            if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $slug . '-' . time();
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_available'] = $request->has('is_available');

        $product->update($validated);

        // Memicu Alert Sukses Update
        Alert::success('Berhasil Diperbarui!', 'Informasi detail menu berhasil disimpan.');

        return redirect()->route('vendor.product.index');
    }

    // 7. HAPUS MENU
    public function destroy(string $id)
    {
        // 1. Pastikan user memiliki lapak aktif
        $shop = Auth::user()->shop;
        if (!$shop) {
            Alert::error('Gagal', 'Anda tidak memiliki akses lapak resmi.');
            return redirect()->back();
        }

        // 2. Cari produk yang ID-nya sesuai DAN pastikan milik lapak user ini
        $product = Product::where('id', $id)
            ->where('shop_id', $shop->id)
            ->firstOrFail();

        // 3. Hapus asset foto dari storage agar hemat ruang disk
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // 4. Eksekusi hapus data produk dari database
        $product->delete();

        // 5. Memicu Alert Sukses Hapus Permanen
        Alert::success('Terhapus!', 'Menu hidangan telah dihapus dari sistem Foody.');

        return redirect()->route('vendor.product.index');
    }

    // 8. TOGGLE STATUS KETERSEDIAAN MENU
    public function toggleStatus(string $id)
    {
        $shop = Auth::user()->shop;

        $product = Product::where('id', $id)
            ->where('shop_id', $shop->id)
            ->firstOrFail();

        // Balikkan nilai ketersediaan produk
        $product->is_available = !$product->is_available;
        $product->save();

        // Memicu Alert Sukses Toggle Status
        Alert::success('Status Diperbarui', 'Ketersediaan menu berhasil diubah.');

        return redirect()->back();
    }
}
