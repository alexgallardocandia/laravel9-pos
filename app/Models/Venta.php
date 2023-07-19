<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public function Caja_Venta(){
        return $this->hasMany(Caja_Venta::class);
    }
    public function VentaInventario(){
        return $this->hasMany(VentaInventario::class);
    }
    public function Sunat(){
        return $this->hasMany(Sunat::class);
    }
}
