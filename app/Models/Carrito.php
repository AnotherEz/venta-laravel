<?php
// app/Models/Carrito.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $fillable = [
        'cliente_id',
        'fecha_creacion',
        'estado'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    public function productos(){
        return $this->hasMany(CarritoProducto::class, 'carrito_id');
    }
}
