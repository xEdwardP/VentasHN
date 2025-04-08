<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $categories = [
            'Abarrotes',
            'Lácteos y Huevos',
            'Bebidas',
            'Snacks y Dulces',
            'Higiene Personal',
            'Limpieza del Hogar',
            'Panadería y Tortillas',
            'Frutas y Verduras',
            'Carnes y Embutidos',
            'Artículos de Uso Diario'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'user_id' => $users->random()->id
            ]);
        }
    }
}
