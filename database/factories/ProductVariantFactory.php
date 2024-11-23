<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ProductVariant::class;

    public function definition(): array
    {
        do {
            $size = $this->faker->randomElement(['S', 'M', 'L', 'XL']);
            $productId = Product::inRandomOrder()->first()->id;
            $colorId = Color::inRandomOrder()->first()->id;

            // Check if the combination already exists
            $existingVariant = ProductVariant::where('product_id', $productId)
                ->where('color_id', $colorId)
                ->where('size', $size)
                ->exists();
        } while ($existingVariant);

        return [
            'size' => $size,
            'stock' => $this->faker->numberBetween(10, 100),
            'product_id' => $productId,
            'color_id' => $colorId,
        ];
    }
}
