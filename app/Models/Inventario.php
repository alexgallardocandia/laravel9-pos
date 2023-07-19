<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    public function Compra_Inverntario(){
        return $this->hasMany(Compra_Inverntario::class);
    }
    public function VentaInventario(){
        return $this->hasMany(VentaInventario::class);
    }
    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
