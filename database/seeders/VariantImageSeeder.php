<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\VariantImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VariantImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $variantImages = [
            [
                'product_variant_id' => 1,
                'image_path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_0cd44837a8-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1084-full.jpg&w=2048&q=90',
                'order' => 1,
            ],
            [
                'product_variant_id' => 1,
                'image_path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_8c24a3ffe8-luca-faloni_cashmere-cableknit_made-in-italy_ivory_1089-full.jpg&w=2048&q=90',
                'order' => 2,
            ],
            [
                'product_variant_id' => 2,
                'image_path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_e6ee42148c-luca_faloni_atlantic-blue_crewneck_cashmere_made_in_italy_6948-r-full.jpg&w=2048&q=90',
                'order' => 1,
            ],
            [
                'product_variant_id' => 2,
                'image_path' => 'https://lucafaloni.com/_next/image?url=https%3A%2F%2Flucafaloni.centracdn.net%2Fclient%2Fdynamic%2Fimages%2F331_25c26d4b80-luca_faloni_atlantic-blue_crewneck_cashmere_made_in_italy_6951-r-full.jpg&w=2048&q=90',
                'order' => 2,
            ]
        ];

        foreach ($variantImages as $variantImage) {
            VariantImage::create($variantImage);
        }
    }
}
