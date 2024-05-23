<?php

namespace App\Http\Controllers;

use App\Models\CajaVenta;
use App\Models\Venta;
use App\Models\VentaInventario;
use App\Models\Inventario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venta = Venta::where('estado', 1)->get();
        $list = [];
        foreach ($venta as $m) {
            $list[] = $this->show($m);
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->total = $request->total;
        $venta->tipo = $request->tipo;
        $venta->pago = $request->pago;
        $venta->cambio = $request->cambio;
        $venta->cliente = $request->cliente;
        $venta->motivo = $request->motivo;
        $venta->estado = 1;
        $venta->save();
        $numero = Venta::all()->count()+1;
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach ($request->carrito as $m) {
                    $articulo = $m['articulo'];
                    $inventario = Inventario::create([
                        'articulo_id'   => $articulo['id'],
                        'tipo'   => 2,
                        'compra'   => $articulo['compra'],
                        'venta'   => $articulo['venta'],
                        'cantidad'   => $m['cantidad'],
                        'motivo'   => "Venta #$numero",
                    ]);

                    $ventaInventario = new VentaInventario();
                    $ventaInventario->inventario_id = $inventario->id;
                    $ventaInventario->venta_id = $venta->id;
                    $ventaInventario->cantidad = $m['cantidad'];
                    $ventaInventario->precio = $m['precio'];
                    $ventaInventario->save();

                }
            }
        }
        if(isset($request->caja_id)){
            CajaVenta::create([
                'monto'     => $request->total,
                'estado'    => 1,
                'caja_id'   => $request->caja_id,
                'venta_id'  => $venta->id,
            ]);
        }
        return $this->show($venta);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->venta_inventario = $venta->venta_inventario()->with(['Inventario'=>function($i){
            $i->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria', 'Medida']);
            }]);
        }])->get();
        $venta->fecha = $venta->created_at->format('Y-m-d');
        return $venta;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->estado = 0;
        $venta->save();
    }
}
