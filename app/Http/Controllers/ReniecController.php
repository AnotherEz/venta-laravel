<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReniecService;

class ReniecController extends Controller
{
    protected $reniecService;

    public function __construct(ReniecService $reniecService)
    {
        $this->reniecService = $reniecService;
    }

    public function buscarDni($dni)
    {
        $data = $this->reniecService->getDniData($dni);

        if ($data) {
            return response()->json($data);
        }

        return response()->json(['error' => 'DNI no encontrado'], 404);
    }
}
