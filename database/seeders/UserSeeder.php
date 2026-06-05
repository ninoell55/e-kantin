<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $defaultPassword = Hash::make('password');
        $verifiedAt = now(); // Untuk mengisi kolom email_verified_at
        $rememberToken = Str::random(10); // Untuk mengisi kolom remember_token

        // Tentukan folder tujuan banner di dalam Storage agar bisa diakses via storage:link
        $targetStoragePath = storage_path('app/public/shops/banners');
        if (!File::exists($targetStoragePath)) {
            File::makeDirectory($targetStoragePath, 0755, true, true);
        }

        // ========================================================
        // 1. SEEDER FOR ADMIN (2 Users)
        // ========================================================
        $admins = [
            ['name' => 'Administrator Utama', 'email' => 'admin@ekantin.test', 'phone' => '087740864657'],
            ['name' => 'Bendahara Sekolah (Admin 2)', 'email' => 'bendahara@ekantin.test', 'phone' => '081234567891'],
        ];

        foreach ($admins as $admin) {
            User::create([
                'id_number' => null,
                'name' => $admin['name'],
                'email' => $admin['email'],
                'phone' => $admin['phone'],
                'email_verified_at' => $verifiedAt, // Diisi agar langsung terverifikasi
                'password' => $defaultPassword,
                'status' => 'active',
                'role' => 'admin',
                'remember_token' => $rememberToken, // Diisi aman
            ]);
        }

        // ========================================================
        // 2. SEEDER FOR VENDORS + SHOPS DATA COMBINED (5 Users & Shops)
        // ========================================================
        $vendorData = [
            [
                'name' => 'Warung Lestari',
                'email' => 'lestari@ekantin.test',
                'phone' => '081234567892',
                'shop_name' => 'Warung Bu Lestari',
                'desc' => 'Menyediakan masakan rumahan hangat, ramesan, dan aneka jus buah segar.',
                'payment' => 'QRIS Dana: 085712345678 a.n Lestari',
                'is_open' => true,
            ],
            [
                'name' => 'Dapur SMK',
                'email' => 'dapursmk@ekantin.test',
                'phone' => '081234567893',
                'shop_name' => 'Dapur Kreatif SMK',
                'desc' => 'Pusat jajanan kreasi siswa, kue basah, roti, dan camilan ringan.',
                'payment' => 'QRIS Ovo: 085798765432 a.n Koperasi SMK',
                'is_open' => true,
            ],
            [
                'name' => 'Kedai Mirice',
                'email' => 'mirice@ekantin.test',
                'phone' => '081234567894',
                'shop_name' => 'Mirice (Mie Gulung Rice Paper)',
                'desc' => 'Pelopor Mie Gulung Rice Paper krispi bumbu tabur aesthetic nomor satu di sekolah!',
                'payment' => 'QRIS ShopeePay: 081234555666 a.n Nino Sub',
                'is_open' => true,
            ],
            [
                'name' => 'Gorengan Pak Opang',
                'email' => 'opang@ekantin.test',
                'phone' => '081234567895',
                'shop_name' => 'Gorengan Hot Pak Opang',
                'desc' => 'Bala-bala, gehu, pisang goreng super renyah disajikan selalu hangat.',
                'payment' => 'Tunai / Cash Langsung ke Kasir',
                'is_open' => true,
            ],
            [
                'name' => 'Soto Ayam Fathan',
                'email' => 'fathan@ekantin.test',
                'phone' => '081234567896',
                'shop_name' => 'Soto & Bakso Mang Fathan',
                'desc' => 'Soto ayam kuah kuning segar khas rumahan dan bakso urat mantap.',
                'payment' => 'QRIS LinkAja: 089988887777 a.n Fathan Soto',
                'is_open' => false,
            ],
        ];

        foreach ($vendorData as $index => $data) {
            $itemNumber = $index + 1;
            $bannerFilename = "vendor{$itemNumber}.jpg";

            // Path sumber gambar mentah buatanmu
            $sourceBannerPath = public_path("asset/banner/{$bannerFilename}");

            // Proses copy otomatis file fisik banner ke storage jika filenya ada
            if (File::exists($sourceBannerPath)) {
                File::copy($sourceBannerPath, $targetStoragePath . '/' . $bannerFilename);
            }

            // Create Akun Vendor
            $vendor = User::create([
                'id_number' => null,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'email_verified_at' => $verifiedAt, // Diisi agar langsung terverifikasi
                'password' => $defaultPassword,
                'status' => 'active',
                'role' => 'vendor',
                'remember_token' => $rememberToken, // Diisi aman
            ]);

            // Create Toko/Lapak dengan banner_path mengarah ke folder storage
            Shop::create([
                'user_id' => $vendor->id,
                'name' => $data['shop_name'],
                'description' => $data['desc'],
                'banner_path' => "shops/banners/{$bannerFilename}", // Disimpan sebagai path storage publik
                'payment_info' => $data['payment'],
                'is_open' => $data['is_open'],
            ]);
        }

        // ========================================================
        // 3. SEEDER FOR CUSTOMER - GURU (5 Users)
        // ========================================================
        $teachers = [
            ['id_number' => '19880412001', 'name' => 'Bu Afika, S.Pd.', 'phone' => '081234567897'],
            ['id_number' => '19850923002', 'name' => 'Pak Ahmad Joko, M.T.', 'phone' => '081234567898'],
            ['id_number' => '19921105003', 'name' => 'Bu Sindi Amalia, S.Kom.', 'phone' => '081234567899'],
            ['id_number' => '19800101004', 'name' => 'Pak Bambang Setiawan, M.Pd.', 'phone' => '081234567900'],
            ['id_number' => '19950718005', 'name' => 'Bu Jihan Nabila, S.T.', 'phone' => '081234567901'],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'id_number' => $teacher['id_number'],
                'name' => $teacher['name'],
                'phone' => $teacher['phone'],
                'email' => null,
                'email_verified_at' => null, // Karena login pakai id_number/NIS, dibuat null tidak masalah
                'password' => $defaultPassword,
                'status' => 'active',
                'role' => 'customer',
                'remember_token' => $rememberToken,
            ]);
        }

        // ========================================================
        // 4. SEEDER FOR CUSTOMER - SISWA (5 Users)
        // ========================================================
        $students = [
            ['id_number' => '222310123', 'name' => 'Muhammad Ridho (XI RPL 2)', 'phone' => '081234567902'],
            ['id_number' => '222310124', 'name' => 'Siswa Indah Lestari', 'phone' => '081234567903'],
            ['id_number' => '222310125', 'name' => 'Ferdy Arisandi (XI RPL 2)', 'phone' => '081234567904'],
            ['id_number' => '222310126', 'name' => 'Siti Syakila (XI RPL 2)', 'phone' => '081234567905'],
            ['id_number' => '222310127', 'name' => 'Bintang Ramadhan', 'phone' => '081234567906'],
        ];

        foreach ($students as $student) {
            User::create([
                'id_number' => $student['id_number'],
                'name' => $student['name'],
                'phone' => $student['phone'],
                'email' => null,
                'email_verified_at' => null,
                'password' => $defaultPassword,
                'status' => 'active',
                'role' => 'customer',
                'remember_token' => $rememberToken,
            ]);
        }
    }
}
