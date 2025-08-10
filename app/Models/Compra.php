<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function cajaCompra(){
        return $this->hasMany(CajaCompra::class);
    }
    public function compraInventario(){
        return $this->hasMany(CompraInventario::class);
    }
}
