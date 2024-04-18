<?php

namespace App\Listeners;

use App\Models\User;
use Dcblogdev\MsGraph\MsGraph;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NewMicrosoft365SignInListener
{
    public function handle(object $event): void
    {
        error_log('NewMicrosoft365SignInListener handle');
        $user = User::firstOrCreate([
            'email' => $event->token['info']['mail'],
        ], [
            'name' => $event->token['info']['displayName'],
            'email' => $event->token['info']['mail'] ?? $event->token['info']['userPrincipalName'],
            'password' => '',
        ]);

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
            $user->profile_photo_path = 'profile-photos/' . $path;
            $user->save();
        } else {
            // Manejar el error o proporcionar un valor predeterminado para la foto del perfil
        }
    }
}
