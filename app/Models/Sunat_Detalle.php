<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat_Detalle extends Model
{
    use HasFactory;

    public function Sunat(){
        return $this->belongsTo(Sunat::class);
    }
}
