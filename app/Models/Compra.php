<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function Caja_Compra(){
        return $this->hasMany(Caja_Compra::class);
    }
    public function Compra_Inventario(){
        return $this->hasMany(CompraInventario::class);
    }
}
