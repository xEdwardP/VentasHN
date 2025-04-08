<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\City;
use App\Models\User;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customer = new Customer();
        $customer->document = '00000000000000';
        $customer->name = 'Consumidor Final';
        $customer->type = 'minorista';
        $customer->city_id = 1;
        $customer->save();

        $faker = Faker::create();

        for ($i = 2; $i <= 30; $i++) {
            Customer::create([
               'document' => (int) $faker->unique()->numerify('##############'),
                'name' => $faker->name,
                'type' => $faker->randomElement(['mayorista', 'minorista']),
                'city_id' => $faker->numberBetween(1, 25),
            ]);
        }
    }
}
