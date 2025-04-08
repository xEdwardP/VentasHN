<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            'Guatemala' => ['Guatemala', 'Petén'],
            'Belice' => ['Belice', 'Cayo'],
            'Honduras' => ['Copán ', 'Francisco Morazán'],
            'El Salvador' => ['San Salvador', 'Santa Ana'],
            'Nicaragua' => ['Managua', 'León'],
            'Costa Rica' => ['San José', 'Heredia'],
            'Panamá' => ['Panamá', 'Colón']
        ];

        foreach ($states as $countryName => $stateNames) {
            $country = Country::where('name', $countryName)->first();
            
            foreach ($stateNames as $stateName) {
                State::create([
                    'name' => $stateName,
                    'country_id' => $country->id
                ]);
            }
        }
    }
}
