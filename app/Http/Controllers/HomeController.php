<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // MARK:GLOBAL
    function welcome(Request $request)
    {
        // Obtener informacion del usuario autentificado
        $user = auth()->user();
        // dd($user->id_puesto);
        // $user = User::with(['puesto','role'])->get();
        $nombre = explode(" ",$user->name);
        $apellido = explode(" ",$user->surname);
        $nombreCompleto = $nombre[0]. " ". $apellido[0];
        strlen($nombreCompleto) <= 1 ? $nombreCompleto = $user->alias : $nombreCompleto;

        $puesto = User::find($user->id)->puesto;
        $role = User::find($user->id)->role;

        $ip = $request->ip();
        return view('welcome', compact('user','nombreCompleto','puesto','role','ip'));
    }
}
