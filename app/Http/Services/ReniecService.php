<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ReniecService
{
    private $apiUrl;
    private $apiTokens;

    public function __construct()
    {
        $this->apiUrl = "https://apiperu.dev/api/dni"; 
        $this->apiTokens = explode(',', env('RENIEC_API_TOKENS')); // Convierte la cadena en un array
    }

    private function getToken()
    {
        // Método 1: Selección aleatoria (más simple)
        //return $this->apiTokens[array_rand($this->apiTokens)];

        // Método 2: Rotación cíclica (opcional)
         session(['token_index' => (session('token_index', 0) + 1) % count($this->apiTokens)]);
        return $this->apiTokens[session('token_index')];
    }

    public function getDniData($dni)
    {
        $token = $this->getToken(); // Obtener un token disponible

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$token}"
        ])->post($this->apiUrl, ['dni' => $dni]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
