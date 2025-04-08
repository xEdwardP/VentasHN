<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $paises = [
            'Guatemala' => [
                'Guatemala' => ['Ciudad de Guatemala', 'Mixco'],
                'Petén' => ['Flores', 'Santa Elena']
            ],
            'Belice' => [
                'Belice' => ['Ciudad de Belice', 'Ladyville'],
                'Cayo' => ['San Ignacio', 'Benque Viejo del Carmen']
            ],
            'Honduras' => [
                'Copán' => ['Santa Rosa de Copán', 'Copán Ruinas'],
                'Francisco Morazán' => ['Tegucigalpa', 'Valle de Ángeles']
            ],
            'El Salvador' => [
                'San Salvador' => ['San Salvador', 'Soyapango'],
                'Santa Ana' => ['Santa Ana', 'Chalchuapa']
            ],
            'Nicaragua' => [
                'Managua' => ['Managua', 'Ciudad Sandino'],
                'León' => ['León', 'La Paz Centro']
            ],
            'Costa Rica' => [
                'San José' => ['San José', 'Escazú'],
                'Heredia' => ['Heredia', 'Barva']
            ],
            'Panamá' => [
                'Panamá' => ['Ciudad de Panamá', 'San Miguelito'],
                'Colón' => ['Colón', 'Puerto Pilón']
            ]
        ];

        foreach ($paises as $nombrePais => $departamentos) {
            $pais = Country::where('name', $nombrePais)->first();

            foreach ($departamentos as $nombreDepto => $ciudades) {
                $departamento = State::where('name', $nombreDepto)
                    ->where('country_id', $pais->id)
                    ->first();

                foreach ($ciudades as $ciudad) {
                    City::create([
                        'name' => $ciudad,
                        'state_id' => $departamento->id
                    ]);
                }
            }
        }
    }
}
