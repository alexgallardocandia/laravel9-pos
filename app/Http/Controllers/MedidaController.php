<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Medida::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $medida = new Medida();
        $medida->codigo = $request->codigo;
        $medida->nombre = $request->nombre;
        $medida->save();
        return $medida;
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        return $medida;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medida $medida)
    {
        $medida->codigo = $request->codigo;
        $medida->nombre = $request->nombre;
        $medida->save();
        return $medida;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medida $medida)
    {
        $medida->estado = 0;
        $medida->save();

        return $medida;
    }
}
