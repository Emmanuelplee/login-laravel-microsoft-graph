<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // MARK:GLOBAL
    function welcome()
    {
        // Obtener informacion del usuario autentificado
        $user = auth()->user();
        return view('welcome', compact('user'));
    }
}
