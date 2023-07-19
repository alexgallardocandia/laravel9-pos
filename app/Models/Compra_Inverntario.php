<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_Inverntario extends Model
{
    use HasFactory;

    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class);
    }
}
