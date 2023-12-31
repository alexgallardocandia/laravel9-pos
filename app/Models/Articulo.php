<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    public function Marca(){
        return $this->belongsTo(Marca::class);
    }
    public function Medida(){
        return $this->belongTo(Medida::class);
    }
    public function Categoria(){
        return $this->belongTo(Categoria::class);
    }
}
