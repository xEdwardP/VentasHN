<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $query = DB::table('sales')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M') as month"), DB::raw("SUM(total) as total"))
            ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"));

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $salesData = $query->orderBy(DB::raw("MONTH(created_at)"))->get();

        // Ventas por país
        $countryQuery = DB::table('sales')
            ->join('cities', 'sales.city_id', '=', 'cities.id')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('countries.name as country', DB::raw('COUNT(sales.id) as total'))
            ->groupBy('countries.name');

        if ($startDate && $endDate) {
            $countryQuery->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $countrySales = $countryQuery->get();

        $topProducts = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name as product', DB::raw('SUM(sale_details.quantity) as total'))
            ->groupBy('products.name')
            ->orderByDesc('total')
            ->limit(5);

        if ($startDate && $endDate) {
            $topProducts->whereBetween('sale_details.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $topProductsData = $topProducts->get();

        $topUsersByCount = DB::table('sales')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select('users.name as user', DB::raw('COUNT(sales.id) as total'))
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->limit(5);

        if ($startDate && $endDate) {
            $topUsersByCount->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $topUsersCountData = $topUsersByCount->get();

        $topSuppliers = DB::table('products')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select('suppliers.name as supplier', DB::raw('COUNT(products.id) as total'))
            ->groupBy('suppliers.name')
            ->orderByDesc('total')
            ->limit(5);

        $topSuppliersData = $topSuppliers->get();

        $topCustomers = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('customers.name as customer', DB::raw('COUNT(sales.id) as total'))
            ->groupBy('customers.name')
            ->orderByDesc('total')
            ->limit(5);

        if ($startDate && $endDate) {
            $topCustomers->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $topCustomers = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('customers.name as customer', DB::raw('COUNT(sales.id) as total'))
            ->where('customers.id', '!=', 1)
            ->groupBy('customers.name')
            ->orderByDesc('total')
            ->limit(5);

        if ($startDate && $endDate) {
            $topCustomers->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $topCustomersData = $topCustomers->get();

        $categories = DB::table('categories')->pluck('name');

        $ventasSinRTN = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->where('sales.customer_id', 1)
            ->select('products.category_id', DB::raw('SUM(sale_details.quantity) as total'))
            ->groupBy('products.category_id');

        $ventasConRTN = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->where('sales.customer_id', '!=', 1)
            ->select('products.category_id', DB::raw('SUM(sale_details.quantity) as total'))
            ->groupBy('products.category_id');

        if ($startDate && $endDate) {
            $ventasSinRTN->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
            $ventasConRTN->whereBetween('sales.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $sinRTN = $ventasSinRTN->pluck('total', 'products.category_id');
        $conRTN = $ventasConRTN->pluck('total', 'products.category_id');

        $labels = [];
        $dataSinRTN = [];
        $dataConRTN = [];

        foreach ($categories as $id => $name) {
            $labels[] = $name;
            $dataSinRTN[] = $sinRTN[$id] ?? 0;
            $dataConRTN[] = $conRTN[$id] ?? 0;
        }

        return view("modules.dashboard.home", compact(
            'title',
            'totalSales',
            'quantitySales',
            'productsMinStock',
            'recentProducts',
            'operatingCosts',
            'netProfit',
            'unitsSold',
            'salesData',
            'startDate',
            'endDate'
        ))->with([
            'countryLabels' => $countrySales->pluck('country'),
            'countryValues' => $countrySales->pluck('total'),
            'productLabels' => $topProductsData->pluck('product'),
            'productValues' => $topProductsData->pluck('total'),
            'userLabels' => $topUsersCountData->pluck('user'),
            'userValues' => $topUsersCountData->pluck('total'),
            'supplierLabels' => $topSuppliersData->pluck('supplier'),
            'supplierValues' => $topSuppliersData->pluck('total'),
            'customerLabels' => $topCustomersData->pluck('customer'),
            'customerValues' => $topCustomersData->pluck('total'),
            'radarLabels' => $labels,
            'radarSinRTN' => $dataSinRTN,
            'radarConRTN' => $dataConRTN,
        ]);
    }
}
