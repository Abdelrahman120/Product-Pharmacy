<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Product::factory()->count(50000)->create();

        Pharmacy::factory()->count(20000)->create();

        Pharmacy::all()->each(function ($pharmacy) {
            $products = Product::inRandomOrder()->take(10)->pluck('id');
            foreach ($products as $productId) {
                $pharmacy->products()->attach($productId, [
                    'price' => rand(10, 100),
                ]);
            }
        });
    }
}
