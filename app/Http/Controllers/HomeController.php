<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct() {
    }

    // MARK:WELCOME
    function welcome()
    {
        $user_auth = auth()->user();
        $user = User::find($user_auth->id);
        $data = $user_auth->only('alias','name','surname','email','path_foto_perfil',
                            'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto');
        return view('welcome_old', compact('data'));
    }
}
