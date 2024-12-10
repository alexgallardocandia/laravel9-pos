<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
