<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Articulo::with(['Marca'])->where('estado','1')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $articulo = new Articulo();
        $articulo->nombre = $request->nombre;
        $articulo->barra = $request->barra;
        $articulo->medida_id = $request->medida_id;
        $articulo->marca_id = $request->marca_id;
        $articulo->categoria_id = $request->categoria_id;
        $articulo->compra = $request->compra;
        $articulo->venta = $request->venta;
        $articulo->stock_minimo = $request->stock_minimo;
        $articulo->save();
        return $articulo;
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        // dd($articulo);
        $articulo->marca = $articulo->Marca;
        $articulo->medida = $articulo->Medida;
        $articulo->medida = $articulo->Categoria;
        
        return $articulo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articulo $articulo)
    {        
        $articulo->nombre = $request->nombre;
        $articulo->barra = $request->barra;
        $articulo->medida_id = $request->medida_id;
        $articulo->marca_id = $request->marca_id;
        $articulo->categoria_id = $request->categoria_id;
        $articulo->compra = $request->compra;
        $articulo->venta = $request->venta;
        $articulo->stock_minimo = $request->stock_minimo;
        $articulo->save();
        return $articulo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->estado = 0;
        $articulo->save();
    }
}
