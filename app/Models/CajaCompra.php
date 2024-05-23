<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'estado',
        'caja_id',
        'compra_id',
    ];
    public function Cajas(){
        return $this->belongsTo(Caja::class);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class);
    }
}
