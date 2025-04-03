<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "Clientes";
        $items = Customer::select(
            'customers.*'
        )
            ->get();

        return view('modules.customers.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = "Crear Cliente";
        return view('modules.customers.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $item = new Customer();
            $item->document = $request->document;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->country = $request->country;
            $item->city = $request->city;
            $item->id = Auth::user()->id;
            $item->save();
            return to_route('customers')->with('success', 'Cliente creado exitosamente!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al crear un cliente!' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        $title = "Eliminar Cliente";
        $items = Customer::select(
            'customers.*'
        )
            ->where('customers.id', $id)
            ->first();
        return view('modules.customers.show', compact('title', 'items'));
    }

    public function edit(string $id)
    {
        $title = "Editar cliente";
        $item = Customer::find($id);
        return view('modules.customers.edit', compact('title', 'item'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $item = Customer::find($id);
            $item->document = $request->document;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->country = $request->country;
            $item->city = $request->city;
            $item->id = Auth::user()->id;
            $item->save();
            return to_route('customers')->with('success', 'Cliente actualizado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al actualizar el cliente!' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Customer::find($id);
            $item->delete();
            return to_route('customers')->with('success', 'Cliente eliminado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al eliminar el cliente!' . $th->getMessage());
        }
    }
}
