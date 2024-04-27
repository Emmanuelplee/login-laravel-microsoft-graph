<?php

namespace App\Listeners;

use App\Models\Puesto;
use App\Models\User;
use Dcblogdev\MsGraph\MsGraph;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class NewMicrosoft365SignInListener
{
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function handle(object $event): void
    {
        error_log('NewMicrosoft365SignInListener handle');
        // dd($event->token['info']);
        // Buscar el user por email si no existe se crea
        $user = User::firstOrCreate([
            'email' => $event->token['info']['mail'],
        ], [
            'alias' => $event->token['info']['displayName'] ?? $event->token['info']['userPrincipalName'],
            'name' => $event->token['info']['givenName'],
            'surname' => $event->token['info']['surname'],
            'email' => $event->token['info']['mail'] ?? $event->token['info']['userPrincipalName'],
            'inicio_sesion' => Carbon::now()->format('H:i:s'),
            'password' => '',
        ]);
        //Actualizar ip_equipo si es diferente de la bd
        $ip = $this->request->ip();
        if ($user->ip_equipo != $ip) {
            $user->update(['ip_equipo' => $ip,]);
        }
        // Actualizame el incio_sesion
        $user->update([
            'inicio_sesion' => Carbon::now()->format('H:i:s')
        ]);

        // Asigar rol y puesto por defecto (Nuevo)
        if (is_null($user->id_role) || is_null($user->id_puesto)) {
            $role = Role::where('name', '=', 'Nuevo')->first();
            $puesto = Puesto::where('nombre', '=', 'PUESTO NUEVO')->first();
            $user->update([
                'id_role' => $role->id, // role -> Nuevo id 21
                'id_puesto' => $puesto->id, // puesto -> Nuevo id 1
            ]);
        }
        // Obtener token de MsGraph
        (new MsGraph())->storeToken(
            $event->token['accessToken'],
            $event->token['refreshToken'],
            $event->token['expires'],
            $user->id,
            $user->email
        );

        // Guardar foto de perfil ========================================

        $path = public_path('/storage/' . $user->path_foto_perfil);
        if (!file_exists($path)) {
            $this->guardar_foto_perfil($event->token['accessToken'], $user);
        }
        // ===============================================================

        // Token de acceso laravel
        Auth::login($user);
    }
    private function guardar_foto_perfil($accessToken,$user)
    {
        // Obtener la foto del perfil del usuario desde Microsoft Graph
        $photoUrl = 'https://graph.microsoft.com/v1.0/me/photo/$value';
        $response = Http::withToken($accessToken)->get($photoUrl);

        if ($response->successful()) {
            $photoData = $response->body();
            $mkdir = 'users';
            $extension = $extension = explode('/', $response->header('Content-Type'))[1];
            // Guardar la foto del perfil en el sistema de almacenamiento
            $path = $user->id . '_' . uniqid() . '.' . $extension;
            Storage::put("public/$mkdir/" . $path, $photoData);
            // Asociar la ruta de la foto del perfil con el usuario en la base de datos
            $user->path_foto_perfil = "$mkdir/" . $path;
            $user->save();
        } else {
            // Manejar el error o proporcionar un valor predeterminado para la foto del perfil
        }
    }
}
