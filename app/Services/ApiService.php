<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        // Define la URL base de la API
        $this->baseUrl = env('API_URL_MSPV');// 'https://127.0.0.0/mspv';
    }
    public function fetchDataByEmail($email)
    {
        try {
            // Realiza la llamada a la API externa usando el correo como parámetro
            $response = Http::asForm()->post($this->baseUrl . '/sdp.php', [
                'correo' => $email,
            ]);
            // Log de la respuesta cruda
            Log::info('Respuesta sin procesar de la API: ' . $response->body());
            // Verifica si la llamada fue exitosa
            if ($response->successful()) {
                $jsonData = $response->json();
                Log::info('Respuesta JSON de API: ', (array)$jsonData);
                return $jsonData;
            } else {
                Log::error('Solicitud de API fallida', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return ['error' => 'No se pueden obtener los datos'];
            }
        } catch (\Throwable $e) {
            //throw $th;
            return ['error' => 'Ocurrió una excepción: ' . $e->getMessage()];
        }
    }
    public function fetchDataByFolio($folio)
    {
        try {
            // Realiza la llamada a la API externa usando el correo como parámetro
            $response = Http::asForm()->post($this->baseUrl . '/sdp.php', [
                'folio' => $folio,
            ]);
            // Log de la respuesta cruda
            Log::info('Respuesta sin procesar de la API: ' . $response->body());
            // Verifica si la llamada fue exitosa
            if ($response->successful()) {
                $jsonData = $response->json();
                Log::info('Respuesta JSON de API: ', (array)$jsonData);
                return $jsonData;
            } else {
                Log::error('Solicitud de API fallida', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return ['error' => 'No se pueden obtener los datos'];
            }
        } catch (\Throwable $e) {
            //throw $th;
            return ['error' => 'Ocurrió una excepción: ' . $e->getMessage()];
        }
    }
}
