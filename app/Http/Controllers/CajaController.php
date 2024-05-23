<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajas = Caja::get();
        return $cajas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        $caja->load('CajaMovimiento','CajaVenta', 'CajaCompra');
        $ingresos = $caja->ingresos;
        $egresos = $caja->egresos;
        $total = $caja->total;
        $total_ventas = $caja->total_ventas;
        $total_compras = $caja->total_compras;
        $caja->ingresos = $ingresos;
        $caja->egresos = $egresos;
        $caja->total = $total;
        $caja->total_ventas = $total_ventas;
        $caja->total_compras = $total_compras;

        return $caja;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
