<?php

namespace App\Listeners;

use App\Models\User;
use Dcblogdev\MsGraph\MsGraph;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NewMicrosoft365SignInListener
{
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
        // Actualizame el incio de sesion del usuario
        $user->update(['inicio_sesion' => Carbon::now()->format('H:i:s')]);
        // Asigar rol y puesto por defecto (Nuevo)
        if (is_null($user->id_role) || is_null($user->id_puesto)) {
            $user->update([
                'id_role' => 21, // 21 role -> Nuevo
                'id_puesto' => 90, // 90 puesto -> Nuevo
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
        $this->guardar_foto_perfil($event->token['accessToken'], $user);
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

            // Guardar la foto del perfil en el sistema de almacenamiento
            $path = $user->id . '_profile_photo.jpg';
            Storage::put('public/profile-photos/' . $path, $photoData);

            // Asociar la ruta de la foto del perfil con el usuario en la base de datos
            $user->path_foto_perfil = 'profile-photos/' . $path;
            $user->save();
        } else {
            // Manejar el error o proporcionar un valor predeterminado para la foto del perfil
        }
    }
}
