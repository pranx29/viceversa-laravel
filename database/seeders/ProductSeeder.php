<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductImage;
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

        $product_size = [
            [
                'product_id' => 1,
                'size_id' => 1,
                'quantity_in_stock' => 10,
            ],
            [
                'product_id' => 1,
                'size_id' => 2,
                'quantity_in_stock' => 10,
            ],
            [
                'product_id' => 1,
                'size_id' => 3,
                'quantity_in_stock' => 10,
            ],
            [
                'product_id' => 1,
                'size_id' => 4,
                'quantity_in_stock' => 10,
            ],
            [
                'product_id' => 1,
                'size_id' => 5,
                'quantity_in_stock' => 10,
            ],
        ];

        foreach ($product_size as $size) {
            ProductSize::create($size);
        }

        $product_images = [
            [
                'product_id' => 1,
                'path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_0cd44837a8-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1084-full.jpg&w=2048&q=90',
                'order' => 1,
            ],
            [
                'product_id' => 1,
                'path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_8c24a3ffe8-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1089-full.jpg&w=2048&q=90',
                'order' => 2,
            ],
            [
                'product_id' => 1,
                'path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_e9c51bb946-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1088-full.jpg&w=2048&q=90',
                'order' => 3,
            ],
            [
                'product_id' => 1,
                'path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_357da9f6f3-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1085-full.jpg&w=2048&q=90',
                'order' => 4,
            ],
        ];

        foreach ($product_images as $image) {
            ProductImage::create($image);
        }
    }
}
