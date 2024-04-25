<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // MARK:GLOBAL
    function welcome()
    {
        // Obtener informacion del usuario autentificado
        $user = auth()->user();
        // dd($user->id_puesto);
        $user = User::with('puesto')->get();
        // dd($user[0]->puesto->nombre);
        return view('welcome', compact('user'));
    }
}
