<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $title = "Proveedores";
        $items = Supplier::all();
        return view('modules.suppliers.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = "Agregar proveedor";
        return view('modules.suppliers.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $item = new Supplier();
            $item->name = $request->name;
            $item->phone = $request->phone;
            $item->email = $request->email;
            $item->website = $request->website;
            $item->notes = $request->notes;
            $item->user_id = Auth::id();
            $item->save();
            return to_route('suppliers')->with("success", "Proveedor agregado con exito");
        } catch (\Throwable $th) {
            return to_route('suppliers')->with("error", "Fallo al agregar proveedor!!!" . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        $title = "Eliminar Proveedor";
        $item = Supplier::find($id);
        return view("modules.suppliers.show", compact('item', 'title'));
    }

    public function edit(string $id)
    {
        $item = Supplier::find($id);
        $title = "Editar Proveedor";

        return view('modules.suppliers.edit', compact('item', 'title'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $item = Supplier::find($id);
            $item->name = $request->name;
            $item->phone = $request->phone;
            $item->email = $request->email;
            $item->website = $request->website;
            $item->notes = $request->notes;
            $item->save();
            return to_route('suppliers')->with('success', 'Actualizado con exito');
        } catch (\Throwable $th) {
            return to_route('suppliers')->with('error', 'No se pudo actualizar' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Supplier::find($id);
            $item->delete();
            return to_route('suppliers')->with('success', 'Proveedor Eliminado con exito!');
        } catch (\Throwable $th) {
            return to_route('suppliers')->with('error', 'Fallo al eliminar!!', $th->getMessage());
        }
    }
}
