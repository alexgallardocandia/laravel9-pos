<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Ticket Venta #{{$venta->id}}</title>
    <style>
        /* Contenedor ticket estrecho para rollo 80mm */
        .ticket {
            width: 80mm;
            margin: 0 auto;
            padding: 5px;
            font-family: monospace, monospace;
            font-size: 12px;
            background: #fff;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        td, th {
            padding: 2px 0;
            text-align: left;
        }

        th {
            font-weight: bold;
            border-bottom: 1px solid #000;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        /* Estilos para impresión */
        @media print {
            body {
                margin: 0;
                background: none;
                color: #000;
            }

            .ticket {
                width: 80mm;
                padding: 0;
                margin: 0;
                box-shadow: none;
            }

            table, th, td {
                border: none !important;
                background: none !important;
            }

            hr {
                border-top: 1px dashed #000;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <table>
            <tr>
                <td class="center bold" colspan="2" style="font-size:16px;">
                    V E N T A
                </td>
            </tr>
            <tr>
                <td class="center" colspan="2">N° {{$venta->id}}</td>
            </tr>
            <tr>
                <td class="center" colspan="2" style="font-size:10px;">
                    Fecha: {{$venta->fecha}}
                </td>
            </tr>
        </table>

        <hr>

        <table>
            <tr>
                <td class="bold" colspan="2">{{$venta->sucursal->nombre}}</td>
            </tr>
            <tr>
                <td><span class="bold">Cliente:</span> {{$venta->cliente}}</td>
            </tr>
            @if($venta->motivo)
            <tr>
                <td><span class="bold">Observación:</span> {{$venta->motivo}}</td>
            </tr>
            @endif
        </table>

        <hr>

        <table>
            <thead>
                <tr>
                    <th style="width:5%;">N°</th>
                    <th style="width:40%;">ARTÍCULO</th>
                    <th style="width:20%;">CATEGORÍA</th>
                    <th style="width:10%;">CANT</th>
                    <th style="width:15%;">PRECIO</th>
                    <th style="width:20%;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php $n = 1; @endphp
                @foreach($venta->ventaInventario as $d)
                <tr>
                    <td>{{$n}}</td>
                    <td>{{$d->inventario->articulo->nombre}}</td>
                    <td>{{$d->inventario->articulo->categoria->nombre}}</td>
                    <td>{{$d->cantidad}}</td>
                    <td>{{number_format($d->precio, 0, ',', '.')}}</td>
                    <td>{{number_format($d->precio * $d->cantidad, 0, ',', '.')}}</td>
                </tr>
                @php $n++; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="bold">TOTAL</td>
                    <td class="bold">{{number_format($venta->total, 0, ',', '.')}}</td>
                </tr>
            </tfoot>
        </table>

        <hr>

        <table>
            <tr>
                <td class="bold">TOTAL DE VENTA:</td>
                <td>{{number_format($venta->total, 0, ',', '.')}}</td>
            </tr>
            {{-- Puedes habilitar estas líneas si tienes pago y cambio --}}
            {{--
            <tr>
                <td class="bold">RECIBIDO:</td>
                <td>{{number_format($venta->pago, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td class="bold">CAMBIO:</td>
                <td>{{number_format($venta->cambio, 0, ',', '.')}}</td>
            </tr>
            --}}
        </table>

        <hr>

        <div class="center" style="font-size:10px;">
            ¡Gracias por su compra!
        </div>
    </div>
</body>

</html>
