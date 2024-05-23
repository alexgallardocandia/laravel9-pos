<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'estado',
        'caja_id',
        'venta_id',
    ];
    public function Caja()
    {
        return $this->belongsTo(Caja::class);
    }
    public function Venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
