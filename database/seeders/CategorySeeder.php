<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'T-Shirt', 'image' => 'https://img.icons8.com/sf-regular-filled/48/t-shirt.png'],
            ['name' => 'Jacket', 'image' => 'https://img.icons8.com/sf-regular-filled/48/jacket.png'],
            ['name' => 'Pant', 'image' => 'https://img.icons8.com/sf-ultralight-filled/50/trousers.png'],
            ['name' => 'Shirt', 'image' => 'https://img.icons8.com/sf-regular-filled/48/shirt.png']
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
