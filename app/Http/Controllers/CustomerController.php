<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    
    public function index()
    {
        $title = "Clientes";
        $items = Customer::with('city.state.country')->get();
        
        return view('modules.customers.index', compact('title', 'items'));
    }

    public function create()
    {
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $title = "Crear Cliente";
        return view('modules.customers.create', compact('title', 'countries', 'states', 'cities'));
    }

    public function store(CustomerRequest $request)
    {
        try {
            $item = new Customer();
            $item->document = $request->document;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->city_id = $request->city_id;
            //  $item->user_id = Auth::user()->id;
            $item->save();
            return to_route('customers')->with('success', 'Cliente creado exitosamente!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al crear un cliente!' . $th->getMessage());
        }
    }

    public function show(string $document)
    {
        $title = "Eliminar Cliente";
        $items = Customer::with('city.state.country')->where('document', $document)->first();

        if (!$items) {
            return redirect()->route('customers')->with('error', 'Cliente no encontrado.');
        }
        return view('modules.customers.show', compact('title', 'items'));
    }

    public function edit(string $document)
    {
        $title = "Editar cliente";
        $item = Customer::where('document', $document)->firstOrFail();
        if (!$item) {
            return redirect()->route('customers')->with('error', 'Cliente no encontrado.');
        }
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        return view('modules.customers.edit', compact('title', 'item', 'countries', 'states', 'cities'));
    }

    public function update(CustomerRequest $request, string $document)
    {
        try {
            $item = Customer::where('document', $document)->firstOrFail();
            $item->document = $request->document;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->city_id = $request->city_id;
            //  $item->user_id = Auth::user()->id;
            $item->save();
            return to_route('customers')->with('success', 'Cliente actualizado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al actualizar el cliente!' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Customer::findOrFail($id);
    
            // Verifica si hay ventas asociadas
            if ($item->sales()->count() > 0) {
                return to_route('customers')->with('error', 'No se puede eliminar el cliente porque tiene ventas registradas.');
            }
    
            $item->delete();
            return to_route('customers')->with('success', 'Cliente eliminado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al eliminar el cliente! ' . $th->getMessage());
        }
    }
    
    public function SearchCountry($countryid){
        echo $countryid;
    }
}
