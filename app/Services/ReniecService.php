<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ReniecService
{
    private $apiUrlDni;
    private $apiUrlRuc;
    private $apiTokens;

    public function __construct()
    {
        $this->apiUrlDni = "https://apiperu.dev/api/dni";
        $this->apiUrlRuc = "https://apiperu.dev/api/ruc";
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
        $token = $this->getToken();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$token}"
        ])->post($this->apiUrlDni, ['dni' => $dni]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['data'] ?? null; // Devuelve los datos o null si no existen
        }

        return null;
    }

    public function getRucData($ruc)
    {
        $token = $this->getToken();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$token}"
        ])->post($this->apiUrlRuc, ['ruc' => $ruc]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['data'] ?? null; // Devuelve los datos o null si no existen
        }

        return null;
    }
}
