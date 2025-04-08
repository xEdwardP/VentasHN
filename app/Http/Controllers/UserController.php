<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = "Usuarios";
        $items = User::all();
        return view('modules.users.index', compact('items', 'title'));
    }

    public function create()
    {
        $title = "Nuevo Usuario";
        return view('modules.users.create', compact('title'));
    }

    public function store(UserRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => true,
                'rol' => $request->rol
            ]);
            return to_route('users')->with('success', 'Usuario guardado con exito!');
        } catch (Exception $e) {
            return to_route('usuarios')->with('error', 'Error al guardar usuario!' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $item = User::find($id);
        $title = "Editar Usuario";
        return view('modules.users.edit', compact('item', 'title'));
    }

    public function update(UserRequest $request, string $id)
    {
        try {
            $item = User::find($id);
            $item->name = $request->name;
            $item->email = $request->email;
            $item->rol = $request->rol;
            $item->save();
            return to_route('users')->with('success', 'Usuario actualizado con exito!');
        } catch (Exception $e) {
            return to_route('usuarios')->with('error', 'Error al actualizar usuario!' . $e->getMessage());
        }
    }

    public function tbody()
    {
        $items = User::all();
        return view('modules.users.tbody', compact('items'));
    }

    public function state($id, $state)
    {
        $item = User::find($id);
        $item->active = $state;
        return $item->save();
    }

    public function changePassword($id, $password)
    {
        $item = User::find($id);
        $item->password = Hash::make($password);
        return $item->save();
    }
}
