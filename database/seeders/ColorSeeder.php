<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors =
            [
                ['name' => 'Ivory', 'code' => '#EAE8E0'],
                ['name' => 'Atlantic Blue', 'code' => '#37445E'],
            ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
