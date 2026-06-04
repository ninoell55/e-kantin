<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Ambil semua ID lapak/warung yang tersedia
        $shopIds = Shop::pluck('id')->toArray();

        if (empty($shopIds)) {
            $this->command->error('Data Shop tidak ditemukan! Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // 2. Tentukan path folder sumber gambar mentah
        $sourcePath = public_path('asset/img');

        // Tentukan folder tujuan di dalam Storage
        $targetStoragePath = storage_path('app/public/products');

        // Pastikan folder target di storage sudah terbentuk
        if (!File::exists($targetStoragePath)) {
            File::makeDirectory($targetStoragePath, 0755, true, true);
        }

        // Validasi jika folder sumber buatanmu belum ada
        if (!File::exists($sourcePath)) {
            File::makeDirectory($sourcePath, 0755, true, true);
            $this->command->warn("Folder sumber dibuat di: {$sourcePath}. Silakan isi foto dengan format 'namaMenu-harga.jpg' terlebih dahulu.");
            return;
        }

        // 3. Ambil semua file gambar dari folder sumber
        $files = File::files($sourcePath);

        if (count($files) === 0) {
            $this->command->warn("Folder 'public/asset/img' kosong. Menggunakan data cadangan (fallback)...");

            // Menyesuaikan nama file contoh ke format camelCase sesuai struktur baru kamu
            $fallbackMenus = [
                'mieGulungRicePaperKrispi-12000.jpg',
                'mieGulungMozzarella-15000.jpg',
                'sotoAyamMadura-15000.jpg',
                'baksoUratMercon-18000.jpg',
                'nasiRamesLengko-10000.jpg',
                'ayamGeprekRpl-13000.jpg',
                'balaBalaHot-2000.jpg',
                'gehuPedasJedur-2000.jpg',
                'esTehManisJumbo-5000.jpg',
                'jusManggaCreamy-8000.jpg',
                'astorChocolateWafer-7000.jpg',
                'bubbleTeaGulaMerah-12000.jpg',
                'nasiGorengSpesial-15000.jpg'
            ];

            foreach ($fallbackMenus as $fakeFile) {
                $this->createProductFromFilename($fakeFile, $shopIds, null, $targetStoragePath);
            }

            $this->command->info("Seeder dijalankan menggunakan data cadangan (File fisik asli tidak dikopi).");
            return;
        }

        // 4. Jika ada file asli, kita kopi ke storage sekaligus daftarkan ke DB
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $this->createProductFromFilename($filename, $shopIds, $file->getRealPath(), $targetStoragePath);
        }

        $this->command->info("Sip! Berhasil merapikan nama menu, menyesuaikan kategori (Makanan/Minuman/Snack), dan menyalin produk ke storage.");
    }

    /**
     * Fungsi Helper untuk memilah nama file & menyalin file ke storage
     */
    private function createProductFromFilename(string $filename, array $shopIds, ?string $sourceRealPath, string $targetStoragePath): void
    {
        // Ambil nama file tanpa ekstensi
        $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

        // Coba pisahkan berdasarkan karakter '- ' untuk mencari harga
        $parts = explode('-', $nameWithoutExtension);
        $rawName = $parts[0]; // Contoh: astorChocolateWafer atau mie_gulung_rice_paper

        // --- 1. Logika Merapikan Nama (Mendukung CamelCase dan Underscore ke Judul Ber-spasi) ---
        // Jika nama file mengandung underscore, ubah dulu jadi spasi biasa
        $spacedName = str_replace('_', ' ', $rawName);

        // Regex untuk menyisipkan spasi sebelum huruf kapital (mengatasi camelCase seperti astorChocolateWafer)
        $splitCamelCase = preg_replace('/(?<!^)(?=[A-Z])/', ' ', $spacedName);

        // Ubah huruf pertama setiap kata menjadi Kapital (Title Case) dan buang spasi double jika ada
        $productName = ucwords(trim($splitCamelCase));


        // --- 2. Logika Variasi Harga Pintar ---
        $price = 10000; // Default awal
        $lowercaseName = strtolower($rawName);

        if (isset($parts[1]) && is_numeric($parts[1])) {
            $price = (int)$parts[1];
        } else {
            // Pengaman otomatis jika harga tidak ditulis di nama file
            if (Str::contains($lowercaseName, ['es', 'jus', 'teh', 'minum', 'drink', 'tea', 'bubble'])) {
                $price = rand(3, 8) * 1000;
            } elseif (Str::contains($lowercaseName, ['wafer', 'astor', 'bala', 'gehu', 'gorengan', 'krupuk', 'snack', 'krispi', 'kue'])) {
                $price = rand(2, 6) * 1000;
            } else {
                $price = rand(10, 18) * 1000;
            }
        }


        // --- 3. Logika Penyesuaian Kategori Pintar (Makanan, Minuman, Snack) ---
        if (Str::contains($lowercaseName, ['es', 'jus', 'teh', 'minum', 'drink', 'tea', 'bubble', 'boba', 'coffee', 'kopi'])) {
            $categoryId = 2;
            $categoryName = 'Minuman';
        } elseif (Str::contains($lowercaseName, ['wafer', 'astor', 'bala', 'gehu', 'gorengan', 'krupuk', 'snack', 'snack', 'kue', 'roti', 'camilan'])) {
            $categoryId = 3;
            $categoryName = 'Snack';
        } else {
            $categoryId = 1;
            $categoryName = 'Makanan';
        }

        // Pastikan record kategori dengan ID tersebut ada di database (mencegah error Foreign Key)
        $categoryExists = DB::table('categories')->where('id', $categoryId)->exists();
        if (!$categoryExists) {
            DB::table('categories')->insert([
                'id'         => $categoryId,
                'name'       => $categoryName,
                'slug'       => Str::slug($categoryName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Jika ada file fisik aslinya di folder public/asset/img, kita kopi ke storage
        if ($sourceRealPath) {
            File::copy($sourceRealPath, $targetStoragePath . '/' . $filename);
        }

        $assignedShopId = $shopIds[array_rand($shopIds)];
        $productSlug = Str::slug($productName) . '-' . Str::random(5);

        Product::create([
            'shop_id'      => $assignedShopId,
            'category_id'  => $categoryId,
            'name'         => $productName, // Hasil konversi: "Astor Chocolate Wafer", "Bubble Tea Gula Merah", dll.
            'slug'         => $productSlug,
            'description'  => "Menu pilihan {$productName} lezat dan higienis, disajikan langsung di kantin sekolah.",
            'price'        => $price,
            'image_path'   => "products/{$filename}",
            'is_available' => true,
        ]);
    }
}
