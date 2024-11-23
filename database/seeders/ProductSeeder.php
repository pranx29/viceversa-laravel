<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products =
            [
                [
                    'name' => 'Cable Knit',
                    'description' => 'Jumper with classic crew neckline. 100% A-grade two-ply cashmere. Cable knitted texture. Ribbed neckline, cuffs and hem. Circa 300 grams. Gauge 12 knit. Knitted in Northern Italy.',
                    'price' => 3450.00,
                    'is_active' => true,
                    'category_id' => 1,
                ],
            ];


        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
