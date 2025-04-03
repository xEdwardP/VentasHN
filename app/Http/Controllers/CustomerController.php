<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "Clientes";
        $items = Customer::all( );

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
        $items = Customer::where('document', $document)->first(); 
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
        return view('modules.customers.edit', compact('title', 'item'));
    }

    public function update(Request $request, string $document)
    {
        try {
            $item = Customer::where('document', $document)->firstOrFail();
            $item->document = $request->document;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->country = $request->country;
            $item->city = $request->city;
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
            $item = Customer::find($id);
            $item->delete();
            return to_route('customers')->with('success', 'Cliente eliminado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('customers')->with('error', 'Fallo al eliminar el cliente!' . $th->getMessage());
        }
    }
}
