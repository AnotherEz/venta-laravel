<?php
// app/Models/Venta.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendedor_id',
        'cliente_id',
        'fecha',
        'hora',
        'tipo_comprobante',
        'serie',
        'correlativo',
        'importe_total'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    public function vendedor(){
        return $this->belongsTo(Vendedor::class, 'vendedor_id', 'id_vendedor');
    }

    public function detalles(){
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
