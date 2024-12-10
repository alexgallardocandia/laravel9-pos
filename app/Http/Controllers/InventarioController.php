<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Articulo::where('estado',1)->get();
        $list = [];
        
        foreach ($model as $m) {
            $list[] = $this->kardex($m);
        }
        return $list;
    }
    public function kardex(Articulo $articulo)
    {
        // dd($articulo);
        $articulo->marca = $articulo->Marca;
        $articulo->medida = $articulo->Medida;
        $articulo->categoria = $articulo->Categoria;
        $articulo->inventario = $articulo->inventario()->where('estado',1)->get();
        $articulo->image = $articulo->articuloImage()->where('estado',1)->orderBy('created_at', 'desc')->first();
        if ($articulo->image) {
            $articulo->image->url = $articulo->image->image?->urlImage();
        }
        $articulo->ingresos = $articulo->inventario->where('tipo',1)->sum('cantidad');
        $articulo->egresos = $articulo->inventario->where('tipo',2)->sum('cantidad');
        $articulo->stock = $articulo->ingresos - $articulo->egresos;
        $articulo->valorizado = $articulo->stock * $articulo->venta;
        $articulo->inversion = $articulo->stock * $articulo->compra;
        $articulo->ganancia = $articulo->valorizado - $articulo->inversion;
        
        return $articulo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventario = Inventario::create([
            'articulo_id'   => $request->articulo_id,
            'tipo'   => $request->tipo,
            'compra'   => $request->compra,
            'venta'   => $request->venta,
            'cantidad'   => $request->cantidad,
            'motivo'   => $request->motivo,
        ]);

        return $inventario;
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->estado = 0;
        $inventario->save();
    }
}
