<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'pago',
        'cambio',
        'tipo',
        'motivo',
        'cliente',
        'estado',
    ];
    
    public function cajaVenta(){
        return $this->hasMany(CajaVenta::class);
    }
    public function ventaInventario(){
        return $this->hasMany(VentaInventario::class);
    }
    public function Sunat(){
        return $this->hasMany(Sunat::class);
    }
}
