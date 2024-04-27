<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Activities;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $activities;

    public function __construct(Activities $act) {
        $this->activities = $act;
    }

    // MARK:WELCOME
    function welcome()
    {
        // Obtener informacion del usuario autentificado
        $user = auth()->user();
        // dd($user->id_puesto);
        $nombre = explode(" ",$user->name);
        $apellido = explode(" ",$user->surname);
        $nombreCompleto = $nombre[0]. " ". $apellido[0];
        strlen($nombreCompleto) <= 1 ? $nombreCompleto = $user->alias : $nombreCompleto;

        $data = $user->only('alias','name','surname','email','password','path_foto_perfil',
                            'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto');
        $data['nombre_completo'] = $nombreCompleto;

        $puesto = User::find($user->id)->puesto;
        $role = User::find($user->id)->role;

        $data['puesto'] = $puesto->nombre;
        $data['role'] = $role->name;
        $data['image'] = $this->activities->getImageRoute($data['path_foto_perfil']);
        return view('welcome', compact('user','data','nombreCompleto','puesto','role'));
    }
}
