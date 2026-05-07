<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            'Makanan',
            'Minuman',
            'Snack',
        ];
        
        $slug = [
            'makanan',
            'minuman',
            'snack',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
                'slug' => $slug[array_search($category, $categories)],
            ]);
        }
    }
}
