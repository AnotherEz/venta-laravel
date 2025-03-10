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
        // Método de rotación cíclica para seleccionar token
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
            $data = $response->json();

            // 📌 Verifica si "data" existe en la respuesta y lo devuelve
            if (isset($data['data'])) {
                return $data['data']; // 🔹 Extrae solo los datos dentro de "data"
            }

            return null; // Si no existe "data", devuelve null
        }

        return null;
    }
}
