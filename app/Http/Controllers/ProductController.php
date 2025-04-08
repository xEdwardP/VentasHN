<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Productos";
        $items = Product::select(
            'products.*',
            'categories.name as category_name',
            'suppliers.name as supplier_name'
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->get();

        return view('modules.products.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = "Crear Producto";
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('modules.products.create', compact('title', 'categories', 'suppliers'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $item = new Product();
            $item->code = $request->code;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->quantity = $request->quantity;
            $item->purchase_price = $request->purchase_price;
            $item->selling_price = $request->selling_price;
            $item->category_id = $request->category_id;
            $item->user_id = Auth::user()->id;
            $item->supplier_id = $request->supplier_id;
            $item->save();
            return to_route('products')->with('success', 'Producto creado exitosamente!');
        } catch (\Throwable $th) {
            return to_route('products')->with('error', 'Fallo al crear producto!' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        $title = "Eliminar producto";
        $items = Product::select(
            'products.*',
            'categories.name as category_name',
            'suppliers.name as supplier_name'
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->where('products.id', $id)
            ->first();
        return view('modules.products.show', compact('title', 'items'));
    }

    public function edit(string $id)
    {
        $title = "Editar producto";
        $categories = Category::all();
        $suppliers = Supplier::all();
        $item = Product::find($id);
        return view('modules.products.edit', compact('title', 'item', 'categories', 'suppliers'));
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            $item = Product::find($id);
            $item->code = $request->code;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->quantity = $request->quantity;
            $item->purchase_price = $request->purchase_price;
            $item->selling_price = $request->selling_price;
            $item->category_id = $request->category_id;
            $item->user_id = Auth::user()->id;
            $item->supplier_id = $request->supplier_id;
            $item->save();
            return to_route('products')->with('success', 'Producto actualizado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('products')->with('error', 'Fallo al actualizar producto!' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Product::find($id);
            $item->delete();
            return to_route('products')->with('success', 'Producto eliminado exitosamente!!');
        } catch (\Throwable $th) {
            return to_route('products')->with('error', 'Fallo al eliminar producto!' . $th->getMessage());
        }
    }
}
