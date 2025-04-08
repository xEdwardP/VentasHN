<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener relaciones
        $admin = User::where('email', 'epineda@yopmail.com')->firstOrFail();
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Mapeo lógico de categorías a proveedores
        $categorySuppliers = [
            'Abarrotes' => ['Distribuidora La Colonia', 'Super Suministros HN'],
            'Lácteos y Huevos' => ['Lácteos Sula', 'Distribuidora La Colonia'],
            'Bebidas' => ['Bebidas Tropicales', 'Super Suministros HN'],
            'Snacks y Dulces' => ['Dulcería Hondureña'],
            'Higiene Personal' => ['Higiene Total'],
            'Limpieza del Hogar' => ['Suministros Tegucigalpa'],
            'Panadería y Tortillas' => ['Panadería Moderna'],
            'Frutas y Verduras' => ['Frutas del Valle'],
            'Carnes y Embutidos' => ['Carnicería Premium HN'],
            'Artículos de Uso Diario' => ['Suministros Tegucigalpa', 'Super Suministros HN']
        ];

        $products = [
            // Abarrotes (5 productos)
            [
                'Arroz Buen Precio',
                'Saco de 25 libras',
                450.00,
                'Abarrotes',
                'Distribuidora La Colonia'
            ],
            [
                'Frijoles Rojos Selectos',
                'Libra empacada al vacío',
                28.00,
                'Abarrotes',
                'Super Suministros HN'
            ],
            [
                'Azúcar Morena',
                'Paquete de 5 libras',
                42.50,
                'Abarrotes',
                'Distribuidora La Colonia'
            ],
            [
                'Aceite Vegetal',
                'Botella de 1 litro',
                65.00,
                'Abarrotes',
                'Super Suministros HN'
            ],
            [
                'Sal Refinada',
                'Bolsa de 1 libra',
                12.00,
                'Abarrotes',
                'Distribuidora La Colonia'
            ],

            // Lácteos y Huevos (5 productos)
            [
                'Leche Entera en Bolsa',
                '1 litro',
                27.50,
                'Lácteos y Huevos',
                'Lácteos Sula'
            ],
            [
                'Queso Fresco',
                'Libra cortada al momento',
                58.00,
                'Lácteos y Huevos',
                'Lácteos Sula'
            ],
            [
                'Huevos Blancos',
                'Cartón de 30 unidades',
                95.00,
                'Lácteos y Huevos',
                'Distribuidora La Colonia'
            ],
            [
                'Yogurt Natural',
                'Presentación de 1 litro',
                45.00,
                'Lácteos y Huevos',
                'Lácteos Sula'
            ],
            [
                'Mantequilla sin Sal',
                'Barra de 200g',
                34.00,
                'Lácteos y Huevos',
                'Lácteos Sula'
            ],

            // Bebidas (5 productos)
            [
                'Agua Purificada',
                'Botella 500ml',
                12.00,
                'Bebidas',
                'Bebidas Tropicales'
            ],
            [
                'Refresco de Cola',
                'Botella 2 litros',
                38.00,
                'Bebidas',
                'Bebidas Tropicales'
            ],
            [
                'Jugo de Naranja',
                'Caja de 1 litro',
                32.00,
                'Bebidas',
                'Bebidas Tropicales'
            ],
            [
                'Café Instantáneo',
                'Frasco de 100g',
                85.00,
                'Bebidas',
                'Super Suministros HN'
            ],
            [
                'Té en Sobres',
                'Caja de 25 unidades',
                28.00,
                'Bebidas',
                'Super Suministros HN'
            ],

            // Snacks y Dulces (5 productos)
            [
                'Churros Mexicanos',
                'Bolsa de 200g',
                25.00,
                'Snacks y Dulces',
                'Dulcería Hondureña'
            ],
            [
                'Tortrix Original',
                'Bolsa familiar',
                18.00,
                'Snacks y Dulces',
                'Dulcería Hondureña'
            ],
            [
                'Chocolate Artesanal',
                'Tableta de 100g',
                35.00,
                'Snacks y Dulces',
                'Dulcería Hondureña'
            ],
            [
                'Mango Chile',
                'Bolsa de 150g',
                15.00,
                'Snacks y Dulces',
                'Dulcería Hondureña'
            ],
            [
                'Galletas de Mantequilla',
                'Paquete de 400g',
                42.00,
                'Snacks y Dulces',
                'Dulcería Hondureña'
            ],

            // Higiene Personal (5 productos)
            [
                'Jabón de Baño',
                'Barra de 120g',
                22.00,
                'Higiene Personal',
                'Higiene Total'
            ],
            [
                'Shampoo Anticaspa',
                'Botella 400ml',
                78.00,
                'Higiene Personal',
                'Higiene Total'
            ],
            [
                'Pasta Dental',
                'Tubo 150ml',
                35.00,
                'Higiene Personal',
                'Higiene Total'
            ],
            [
                'Toallas Femeninas',
                'Paquete de 10 unidades',
                45.00,
                'Higiene Personal',
                'Higiene Total'
            ],
            [
                'Desodorante Roll-On',
                'Presentación 50ml',
                55.00,
                'Higiene Personal',
                'Higiene Total'
            ],

            // Limpieza del Hogar (5 productos)
            [
                'Cloro Doméstico',
                'Botella 1 galón',
                40.00,
                'Limpieza del Hogar',
                'Suministros Tegucigalpa'
            ],
            [
                'Jabón en Polvo',
                'Paquete 2kg',
                95.00,
                'Limpieza del Hogar',
                'Suministros Tegucigalpa'
            ],
            [
                'Esponjas Multiusos',
                'Paquete de 3 unidades',
                25.00,
                'Limpieza del Hogar',
                'Suministros Tegucigalpa'
            ],
            [
                'Desinfectante Aromático',
                'Botella 750ml',
                65.00,
                'Limpieza del Hogar',
                'Suministros Tegucigalpa'
            ],
            [
                'Guantes de Limpieza',
                'Par de guantes',
                18.00,
                'Limpieza del Hogar',
                'Suministros Tegucigalpa'
            ],

            // Panadería y Tortillas (5 productos)
            [
                'Pan Francés',
                'Unidad fresca',
                8.00,
                'Panadería y Tortillas',
                'Panadería Moderna'
            ],
            [
                'Tortillas de Maíz',
                'Paquete de 1 libra',
                12.00,
                'Panadería y Tortillas',
                'Panadería Moderna'
            ],
            [
                'Rosquillas Horneadas',
                'Bolsa de 6 unidades',
                25.00,
                'Panadería y Tortillas',
                'Panadería Moderna'
            ],
            [
                'Pan Dulce Variado',
                'Selección surtida',
                10.00,
                'Panadería y Tortillas',
                'Panadería Moderna'
            ],
            [
                'Tortillas de Harina',
                'Paquete de 10 unidades',
                28.00,
                'Panadería y Tortillas',
                'Panadería Moderna'
            ],

            // Frutas y Verduras (5 productos)
            [
                'Banano Maduro',
                'Libra seleccionada',
                10.00,
                'Frutas y Verduras',
                'Frutas del Valle'
            ],
            [
                'Tomate Rojo',
                'Libra fresca',
                15.00,
                'Frutas y Verduras',
                'Frutas del Valle'
            ],
            [
                'Cebolla Blanca',
                'Libra limpia',
                12.00,
                'Frutas y Verduras',
                'Frutas del Valle'
            ],
            [
                'Naranjas Dulces',
                'Bolsa de 5 libras',
                45.00,
                'Frutas y Verduras',
                'Frutas del Valle'
            ],
            [
                'Lechuga Fresca',
                'Unidad seleccionada',
                8.00,
                'Frutas y Verduras',
                'Frutas del Valle'
            ],

            // Carnes y Embutidos (5 productos)
            [
                'Pechuga de Pollo',
                'Libra fresca',
                45.00,
                'Carnes y Embutidos',
                'Carnicería Premium HN'
            ],
            [
                'Carne Molida',
                'Libra 80/20',
                65.00,
                'Carnes y Embutidos',
                'Carnicería Premium HN'
            ],
            [
                'Chorizo Casero',
                'Libra ahumado',
                75.00,
                'Carnes y Embutidos',
                'Carnicería Premium HN'
            ],
            [
                'Salchichón Ahumado',
                'Unidad de 500g',
                85.00,
                'Carnes y Embutidos',
                'Carnicería Premium HN'
            ],
            [
                'Costilla de Cerdo',
                'Libra marinada',
                55.00,
                'Carnes y Embutidos',
                'Carnicería Premium HN'
            ],

            // Artículos de Uso Diario (5 productos)
            [
                'Pilas AA',
                'Paquete de 4 unidades',
                35.00,
                'Artículos de Uso Diario',
                'Suministros Tegucigalpa'
            ],
            [
                'Focos LED',
                'Unidad 9W',
                25.00,
                'Artículos de Uso Diario',
                'Super Suministros HN'
            ],
            [
                'Cepillos Dentales',
                'Paquete de 3',
                45.00,
                'Artículos de Uso Diario',
                'Higiene Total'
            ],
            [
                'Velas de Emergencia',
                'Paquete de 6',
                30.00,
                'Artículos de Uso Diario',
                'Super Suministros HN'
            ],
            [
                'Bolsas Plásticas',
                'Rollo de 50 unidades',
                40.00,
                'Artículos de Uso Diario',
                'Suministros Tegucigalpa'
            ]
        ];

        $counter = 1;
        foreach ($products as $product) {
            $category = $categories->firstWhere('name', $product[3]);
            $supplier = $suppliers->firstWhere('name', $product[4]);

            Product::create([
                'code' => 'PROD-' . str_pad($counter++, 5, '0', STR_PAD_LEFT),
                'name' => $product[0],
                'description' => $product[1],
                'quantity' => rand(50, 500),
                'purchase_price' => $product[2],
                'selling_price' => $product[2] * 1.3, // 30% de margen
                'category_id' => $category->id,
                'user_id' => $admin->id,
                'supplier_id' => $supplier->id
            ]);
        }
    }
}
