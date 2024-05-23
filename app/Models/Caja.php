<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'estado',
    ];
    protected $append = [
        'ingresos',
        'egresos',
        'total',
        'total_ventas',
        'total_compras',
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function CajaMovimiento()
    {
        return $this->hasMany(CajaMovimiento::class);
    }
    public function CajaVenta()
    {
        return $this->hasMany(CajaVenta::class);
    }
    public function CajaCompra()
    {
        return $this->hasMany(CajaCompra::class);
    }
    public function getIngresosAttribute()
    {
        return $this->CajaMovimiento()->where('tipo', 1)->sum('monto');
    }
    public function getEgresosAttribute()
    {
        return $this->CajaMovimiento()->where('tipo', 2)->sum('monto');
    }
    public function getTotalAttribute()
    {
        return floatval(($this->getIngresosAttribute() + $this->getTotalVentasAttribute()) - ($this->getEgresosAttribute() + $this->getTotalComprasAttribute()));
    }
    public function getTotalVentasAttribute()
    {
        return $this->CajaVenta()->where('estado', 1)->sum('monto');
    }
    public function getTotalComprasAttribute()
    {
        return $this->CajaCompra()->where('estado', 1)->sum('monto');
    }

}
