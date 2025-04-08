<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function index(){
    //     $title = "Dashboard";
    //     $totalSales = Sale::sum('total');
    //     $quantitySales = Sale::count();
    //     $productsMinStock = Product::where('quantity', '<', 5)->get();
    //     $recentProducts = Sale::select(
    //         'sales.*',
    //         'users.name as user_name'
    //     )
    //     ->join('users', 'sales.user_id', '=', 'users.id')
    //     ->orderBy('sales.created_at', 'desc')
    //     ->take(5)
    //     ->get();
    //     return view("modules.dashboard.home", compact('title', 'totalSales', 'quantitySales', 'productsMinStock', 'recentProducts'));
    // }
    public function index()
    {
        $title = "Dashboard";
        $totalSales = Sale::sum('total');
        $quantitySales = Sale::count();

        $operatingCosts = Sale_Detail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->sum(DB::raw('sale_details.quantity * products.purchase_price'));
        $netProfit = $totalSales - $operatingCosts;
        $unitsSold = Sale_Detail::sum('quantity'); 

        $productsMinStock = Product::where('quantity', '<', 5)->get();
        $recentProducts = Sale::select('sales.*', 'users.name as user_name')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->orderBy('sales.created_at', 'desc')
            ->take(5)
            ->get();

        return view("modules.dashboard.home", compact(
            'title',
            'totalSales',
            'quantitySales',
            'productsMinStock',
            'recentProducts',
            'operatingCosts',
            'netProfit',
            'unitsSold'
        ));
    }
}
