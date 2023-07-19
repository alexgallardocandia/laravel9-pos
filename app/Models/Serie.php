<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function Sunats(){
        return $this->hasMany(Sunats::class);
    }
    public function Comprobante(){
        return $this->belongsTo(Comprobante::class);
    }
}
