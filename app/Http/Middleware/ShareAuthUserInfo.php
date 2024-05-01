<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Activities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareAuthUserInfo
{
    private $activities;

    public function __construct(Activities $act) {
        $this->activities = $act;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $name = explode(" ",($user->name != null ? $user->name : ''));
            $surname = explode(" ",$user->surname != null ? $user->surname : '');
            $full_name = $name[0]. " ". $surname[0];
            strlen($full_name) <= 1 ? $full_name = $user->alias : $full_name;

            $data = $user->only('alias','name','surname','email','path_foto_perfil',
                                'inicio_sesion','ip_equipo','activo','tipo','id_role','id_puesto');
            $data['full_name'] = $full_name;

            $position = User::find($user->id)->position;
            $role = User::find($user->id)->role;

            $data['position'] = $position->nombre;
            $data['role'] = $role->name;
            $data['image'] = $this->activities->getImageRoute($data['path_foto_perfil']);

            View::share('authUserInfo', $data);
        }
        return $next($request);
    }
}
