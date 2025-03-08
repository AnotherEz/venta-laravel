<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReniecController;
use App\Models\Venta;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ventas', function () {
    return response()->json(Venta::all());
});

Route::get('/reniec/{dni}', [ReniecController::class, 'buscarDni']);
