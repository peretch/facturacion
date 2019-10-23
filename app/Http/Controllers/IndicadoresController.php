<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\LineaProducto;
use App\Producto;
use App\Factura;


class IndicadoresController extends Controller
{
    public function masVendidos(Request $request, $mes){
		$masVendidos = DB::table('linea_productos')
			->join('productos', 'productos.id', '=', 'linea_productos.producto_id')
			->selectRaw(
				'productos.nombre AS producto, count(*) AS cantidad'
			)
			->whereMonth('linea_productos.fecha', '=', $mes)
			->groupBy('productos.nombre')
			->orderBy('cantidad', 'desc')
			->get();
    	return response()->json($masVendidos);
    }
}
