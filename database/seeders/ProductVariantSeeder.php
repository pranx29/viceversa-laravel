<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productVariants = [
            [
                'product_id' => 1,
                'color_id' => 1,
                'size' => 'S',
                'stock' => rand(1, 100),
            ],
            [
                'product_id' => 1,
                'color_id' => 2,
                'size' => 'L',
                'stock' => rand(1, 100),
            ],
        ];

        foreach ($productVariants as $productVariant) {
            ProductVariant::create($productVariant);
        }

    }
}
