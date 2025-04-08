<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Guatemala'],
            ['name' => 'Belice'],
            ['name' => 'Honduras'],
            ['name' => 'El Salvador'],
            ['name' => 'Nicaragua'],
            ['name' => 'Costa Rica'],
            ['name' => 'Panamá']
        ];

        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name']
            ]);
        }
    }
}
