<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Sale_Detail;
use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Customer;

class GraphicController extends Controller
{
    public function index()
    {
        $title = "Panel de Datos";

        // Consulta de ventas agrupadas por producto
        $sales = Sale_Detail::join('products', 'products.id', '=', 'sale_details.product_id')
            ->join('sales', 'sales.id', '=', 'sale_details.sale_id')
            ->join('cities', 'cities.id', '=', 'sales.city_id')
            ->join('suppliers', 'suppliers.user_id', '=', 'sales.user_id')
            ->leftJoin('categories', 'categories.user_id', '=', 'sales.user_id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(sale_details.quantity) as total_quantity'),
                DB::raw('SUM(sale_details.subtotal) as total_sales')
            )
            ->groupBy('products.name')
            ->orderByDesc('total_sales')
            ->get();

        // Datos adicionales para la vista
        $products = Product::all();
        $customers = Customer::all();; // si tienes un campo `role`
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('modules.graphics.index', compact(
            'title',
            'sales',
            'products',
            'customers',
            'suppliers',
            'categories'
        ));
    }
}
