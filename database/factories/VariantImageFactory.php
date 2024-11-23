<?php

namespace Database\Factories;

use App\Models\VariantImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VariantImage>
 */
class VariantImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = VariantImage::class;
    public function definition(): array
    {
        return [
            'product_variant_id' => \App\Models\ProductVariant::factory(),
            'image_path' => $this->faker->imageUrl(),
            'order' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
