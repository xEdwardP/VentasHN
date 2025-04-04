<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "Categorias";
        $items = Category::all();
        return view('modules.categories.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = "Nueva Categoría";
        return view('modules.categories.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $item = new Category();
            $item->user_id = Auth::user()->id;
            $item->name = $request->name;
            $item->save();
            return to_route('categories')->with('success', 'Categoria agregada!');
        } catch (Exception $e) {
            return to_route('categorias')->with('error', 'No se pudo guardar!' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $title = "Eliminar Categoría";
        $item = Category::find($id);
        return view('modules.categories.show', compact('item', 'title'));
    }

    public function edit(string $id)
    {
        $title = "Actualizar Categoría";
        $item = Category::find($id);
        return view('modules.categories.edit', compact('item', 'title'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $item = Category::find($id);
            $item->name = $request->name;
            $item->save();
            return to_route('categories')->with('success', 'Categoria actualizada!');
        } catch (Exception $e) {
            return to_route('categories')->with('error', 'No se pudo actualizar!' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Category::find($id);
            $item->delete();
            return to_route('categories')->with('success', 'Categoria Eliminada!');
        } catch (Exception $e) {
            return to_route('categories')->with('error', 'No se pudo eliminar!' . $e->getMessage());
        }
    }
}
