<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener usuario administrador
        $user = User::where('email', 'epineda@yopmail.com')->firstOrFail();

        $suppliers = [
            [
                'name' => 'Distribuidora La Colonia',
                'phone' => '504 22345678',
                'email' => 'ventas@lacolonia.hn',
                'website' => 'https://www.lacolonia.hn',
                'notes' => 'Proveedor principal de abarrotes y lácteos'
            ],
            [
                'name' => 'Carnicería Premium HN',
                'phone' => '504 22751234',
                'email' => 'pedidos@carniceriapremium.hn',
                'website' => 'https://www.carniceriahn.hn',
                'notes' => 'Especialistas en carnes y embutidos'
            ],
            [
                'name' => 'Lácteos Sula',
                'phone' => '504 22509898',
                'email' => 'contacto@lacteossula.com',
                'website' => 'https://www.lacteossula.hn',
                'notes' => 'Distribuidor oficial de productos lácteos'
            ],
            [
                'name' => 'Bebidas Tropicales',
                'phone' => '504 22314545',
                'email' => 'info@bebidastropicales.hn',
                'website' => 'https://www.bebidastropicales.hn',
                'notes' => 'Mayorista de bebidas y jugos'
            ],
            [
                'name' => 'Suministros Tegucigalpa',
                'phone' => '504 22221212',
                'email' => 'suministros@tegus.hn',
                'website' => 'https://www.suministrostegus.hn',
                'notes' => 'Artículos de limpieza y uso diario'
            ],
            [
                'name' => 'Dulcería Hondureña',
                'phone' => '504 22456767',
                'email' => 'dulces@honduras.hn',
                'website' => 'https://www.dulceriahn.hn',
                'notes' => 'Proveedor de snacks y dulces tradicionales'
            ],
            [
                'name' => 'Frutas del Valle',
                'phone' => '504 22808080',
                'email' => 'pedidos@frutasdelvalle.hn',
                'website' => 'https://www.frutasdelvalle.hn',
                'notes' => 'Frutas y verduras frescas diarias'
            ],
            [
                'name' => 'Panadería Moderna',
                'phone' => '504 22607070',
                'email' => 'administracion@panaderiamoderna.hn',
                'website' => 'https://www.panaderiamoderna.hn',
                'notes' => 'Proveedor de pan y tortillas'
            ],
            [
                'name' => 'Higiene Total',
                'phone' => '504 22334444',
                'email' => 'clientes@higienetotal.hn',
                'website' => 'https://www.higienetotal.hn',
                'notes' => 'Productos de higiene personal'
            ],
            [
                'name' => 'Super Suministros HN',
                'phone' => '504 22770000',
                'email' => 'super@suministros.hn',
                'website' => 'https://www.supersuministros.hn',
                'notes' => 'Proveedor múltiple de varias categorías'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                'name' => $supplier['name'],
                'phone' => $supplier['phone'],
                'email' => $supplier['email'],
                'website' => $supplier['website'],
                'notes' => $supplier['notes'],
                'user_id' => $user->id
            ]);
        }
    }
}
