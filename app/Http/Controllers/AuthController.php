<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        $title = "Iniciar Sesión";
        return view("modules.auth.login", compact("title"));
    }

    public function logear(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        }

        if(!$user->active){
            return back()->withErrors(['email' => 'Tu cuenta esta inactiva']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('home');
    }

    public function createAdmin(){
        User::create([
            'name' => 'Edward J. Pineda',
            'email' => 'epineda@yopmail.com',
            'password' => Hash::make('123'),
            'active' => true,
            'rol' => 'admin'
        ]);

        return "Admin creado con exito";
    }

    public function logout(){
        Auth::logout();
        return to_route('login');
    }
}
