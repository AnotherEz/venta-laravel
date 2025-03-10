<?php
// app/Models/CarritoProducto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    use HasFactory;

    protected $table = 'carrito_producto';

    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'precio_unitario'
    ];

    public function carrito(){
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }
}
