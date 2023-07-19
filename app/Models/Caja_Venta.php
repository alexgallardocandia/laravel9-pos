<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja_Venta extends Model
{
    use HasFactory;

    public function Caja(){
        return $this->belongsTo(Caja::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
}
