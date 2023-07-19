<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat extends Model
{
    use HasFactory;

    public function Sunat_Detalle(){
        return $this->hasMany(Sunat_Detalle::class);
    }
    public function Serie(){
        return $this->belongsTo(Serie::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
}
