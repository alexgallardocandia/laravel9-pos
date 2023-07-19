<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja_Compra extends Model
{
    use HasFactory;

    public function Cajas(){
        return $this->belongsTo(Caja::class);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class);
    }
}
