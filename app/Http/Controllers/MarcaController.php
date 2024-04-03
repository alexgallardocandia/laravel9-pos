<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marca::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $marca = new Marca();
        // $marca->nombre = $request->nombre;
        // $marca->save();
        $marca = Marca::create([
            'nombre' => $request->nombre
        ]);
        return $marca;

    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return $marca;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $marca->nombre = $request->nombre;
        $marca->save();
        return $marca;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->estado = 0;
        $marca->save();

        return $marca;
    }
}
