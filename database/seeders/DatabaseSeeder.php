<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Pranavan',
            'last_name' => 'Sivakumar',
            'email' => 'pranx@vv.com',
            'password' => bcrypt('password'),
            'type' => 'admin',
        ]);

        $this->call([
            CategorySeeder::class,
            SizeSeeder::class,
           // ProductSeeder::class,
            // ProductVariantSeeder::class,
            // VariantImageSeeder::class,
        ]);
    }
}
