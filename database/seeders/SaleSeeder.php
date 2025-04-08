<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Sale_Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            $sale = Sale::create([
                'user_id' => $faker->numberBetween(1,7),
                'city_id' => $faker->numberBetween(1, 25),
                'customer_id' => $faker->numberBetween(1, 30),
                'total' => $faker->randomFloat(2, 1, 999),

               
            ]);
            $quantity = $faker->numberBetween(1, 10);
            $unit_price = $faker->randomFloat(2, 1, 100);
            $subtotal = $quantity * $unit_price;

            Sale_Detail::create([
                'sale_id' => $sale->id,
                'product_id' => $faker->numberBetween(1, 50),
                'quantity' => $quantity,
                'unit_price' => $unit_price,
                'subtotal' => $subtotal,
            ]);
        }
    
    }
}
