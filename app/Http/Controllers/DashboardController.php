<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function headers()
    {
        $list = new \stdClass();
        $list->totalIngresos = number_format(Venta::where('estado', 1)->where('created_at','>',now()->format('Y-m-d'))->get()->sum('total'),0,',','.');
        $list->totalFacturas = number_format(Venta::where('estado', 1)->where('created_at','>',now()->format('Y-m-d'))->count(),0,',','.');
        $list->compras = number_format(Compra::where('estado', 1)->where('created_at','>',now()->format('Y-m-d'))->sum('total'),0,',','.');
        $list->ventas = number_format(Venta::where('estado', 1)->where('created_at','>',now()->format('Y-m-d'))->count(),0,',','.');
        $list->salesForMonths = $this->salesForMonths();
        $list->purchasesForMonths = $this->purchasesForMonths();
        return response()->json($list);
    }

    public function salesForMonths()
    {
        $ventas = Venta::select(
            DB::raw('sum(total) as total'),
            DB::raw("DATE_FORMAT(created_at , '%M %Y') as mes")
        )->where('estado', 1)
        ->groupBy('mes')
        ->get();

        return $ventas;
    }

    public function purchasesForMonths()
    {
        $compras = Compra::select(
            DB::raw('sum(total) as total'),
            DB::raw("DATE_FORMAT(created_at , '%M %Y') as mes")
        )->where('estado', 1)
        ->groupBy('mes')
        ->get();

        return $compras;
    }
}
