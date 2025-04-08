<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    public function index(Request $request)
    {
        $title = "Reporte de ventas";

        $countries = Country::all();

        $query = Sale::join('users', 'sales.user_id', '=', 'users.id')
            ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id') 
            ->join('products', 'sale_details.product_id', '=', 'products.id') 
            ->join('cities', 'sales.city_id', '=', 'cities.id') 
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->join('customers','customers.id','=','sales.customer_id')
            ->select('sales.*', 'users.name as user_name', 'customers.name as customer_name', 'sale_details.*', 'products.name as product_name', 
                     'cities.name as city', 'states.name as state', 'countries.name as country');

        if ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('sales.created_at', [$request->desde, $request->hasta]);
        }

        if ($request->filled('producto')) {
            $query->where('products.name', 'like', '%' . $request->producto . '%');
        }

        if ($request->filled('pais')) {
            $query->where('countries.id', $request->pais);
        }

        if ($request->filled('estado')) {
            $query->where('states.id', $request->estado);
        }

        if ($request->filled('ciudad')) {
            $query->where('cities.id', $request->ciudad);
        }

        $ventas = $query->orderBy('sales.created_at', 'desc')->get();

        return view('modules.sales_reports.index', compact('title', 'ventas', 'countries'));
    }

    // AJAX para obtener estados según el país
    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    // AJAX para obtener ciudades según el estado
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
