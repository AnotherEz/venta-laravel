<?php
// app/Models/DetalleVenta.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalles_venta';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario'
    ];

    public function venta(){
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }
}
