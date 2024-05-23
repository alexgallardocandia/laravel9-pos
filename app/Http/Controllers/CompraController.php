<?php

namespace App\Http\Controllers;

use App\Models\CajaCompra;
use App\Models\Compra;
use App\Models\CompraInventario;
use App\Models\Inventario;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compra = Compra::where('estado', 1)->get();
        $list = [];
        foreach ($compra as $m) {
            $list[] = $this->show($m);
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $compra = new Compra();
        $compra->total = $request->total;
        $compra->tipo = $request->tipo;
        $compra->proveedor = $request->proveedor;
        $compra->motivo = $request->motivo;
        $compra->save();
        $numero = Compra::all()->count()+1;
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach ($request->carrito as $m) {
                    $articulo = $m['articulo'];
                    $inventario = Inventario::create([
                        'articulo_id'   => $articulo['id'],
                        'tipo'   => 1,
                        'compra'   => $articulo['compra'],
                        'venta'   => $articulo['venta'],
                        'cantidad'   => $m['cantidad'],
                        'motivo'   => "Compra #$numero",
                    ]);

                    $compraInventario = new CompraInventario();
                    $compraInventario->inventario_id = $inventario->id;
                    $compraInventario->compra_id = $compra->id;
                    $compraInventario->cantidad = $m['cantidad'];
                    $compraInventario->precio = $m['precio'];
                    $compraInventario->save();

                }
            }
        }
        if (isset($request->caja_id)) {
            CajaCompra::create([
                'monto'     => $request->total,
                'estado'    => 1,
                'caja_id'   => $request->caja_id,
                'compra_id' => $compra->id,
            ]);
        }
        return $compra;
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        $compra->compra_inventario = $compra->compra_inventario()->with(['Inventario'=>function($i){
            $i->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria', 'Medida']);
            }]);
        }])->get();
        $compra->fecha = $compra->created_at->format('Y-m-d');
        return $compra;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        $compra->estado = 0;
        $compra->save();
    }
}
