<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'path',
        'estado',
    ];

    public function MonedaImage(){
        return $this->hasMany(MonedaImage::class);
    }

    public function articuloImage()
    {
        return $this->hasMany(ArticuloImage::class);
    }

    public function urlImage()
    {
        return url($this->path);
    }
}
