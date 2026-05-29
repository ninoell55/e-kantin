<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Administrator Utama',
            'email' => 'admin@ekantin.test',
            'password' => 'password',
            'status' => 'active',
        ]);

        User::factory()->vendor()->create([
            'name' => 'Vendor Warung Lestari',
            'email' => 'vendor1@ekantin.test',
            'password' => 'password',
            'status' => 'active',
        ]);

        User::factory()->vendor()->create([
            'name' => 'Vendor Dapur SMK',
            'email' => 'vendor2@ekantin.test',
            'password' => 'password',
            'status' => 'active',
        ]);

        User::factory()->customer()->create([
            'name' => 'Siswa Roni',
            'email' => 'customer1@ekantin.test',
            'password' => Hash::make('password'),
            'status' => 'active',
]);
        User::factory()->customer()->create([
            'name' => 'Siswa Indah',
            'email' => 'customer2@ekantin.test',
            'password' => 'password',
            'status' => 'active',
        ]);
        
    }
}
