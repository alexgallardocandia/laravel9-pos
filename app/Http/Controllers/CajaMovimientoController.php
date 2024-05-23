<?php

namespace App\Http\Controllers;

use App\Models\CajaMovimiento;
use Illuminate\Http\Request;

class CajaMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movimientos = CajaMovimiento::all();
        return $movimientos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cajaMovimiento = CajaMovimiento::create([
            'motivo'    => $request->motivo,
            'monto'    => $request->monto,
            'tipo'    => $request->tipo,
            'caja_id'    => $request->caja_id,
        ]);

        return $cajaMovimiento;
    }

    /**
     * Display the specified resource.
     */
    public function show(CajaMovimiento $cajaMovimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CajaMovimiento $cajaMovimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CajaMovimiento $cajaMovimiento)
    {
        //
    }
}
