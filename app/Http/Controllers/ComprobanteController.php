<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\TipoComprobante;
use App\LineaProducto;
use App\Cliente;
use App\Comprobante;
use App\Producto;
use App\Moneda;
use Auth;

class ComprobanteController extends Controller
{
	public function index(Request $request)
	{
		$monedas = Moneda::all();

		$fechaInicio = $request->fechaInicio;
		$fechaFin = $request->fechaFin;
		$tipos_comprobante = TipoComprobante::all();
		if($fechaFin && $fechaInicio){
			$facturas = Comprobante::where('fechaEmision', '>=', $fechaInicio)
					->where('fechaEmision', '<=', $fechaFin)
					->orderby('id', 'desc')
					->paginate(20);            
		}else{
			$facturas = Comprobante::orderby('id', 'desc')->paginate(20);
		}
		return view('comprobantes.index')->with(compact('facturas', 'monedas', 'tipos_comprobante'));            
	}

	public function consultas(Request $request)
	{
		$facturas = Comprobante::all();
		$monedas = Moneda::all();
		return view('comprobantes.consultas')->with(compact('facturas', 'monedas'));
	}

	public function nuevo()
	{
		$productos = Producto::all();
		$monedas = Moneda::all();
		$tipos_comprobante = TipoComprobante::all();
		return view('comprobantes.nuevo')->with(compact('productos', 'monedas', 'tipos_comprobante'));
	}

	public function guardar(Request $request)
	{
		$tipo_comprobante = $request->tipo_comprobante;		
		// 1- Venta al contado
		// 2- Devolución al contado

		//TODO: Asociar tipo de comprobante.
		if($tipo_comprobante == 1 || $tipo_comprobante == 2){
			$articulos = json_decode($request->listadoArticulos);
			$moneda = Moneda::find($request->moneda);
			$cliente = Cliente::find($request->cliente_id);        
			$factura = new Comprobante();        

			$factura->serie = $request->serie;
			$factura->numero = $request->numero;        
			$factura->fechaEmision = $request->fechaEmision;
			
			$factura->descripcion_1 = $request->descripcion_1;
			$factura->descripcion_2 = $request->descripcion_2;
			$factura->descripcion_3 = $request->descripcion_3;

			if(is_numeric($request->cotizacion)){
				$factura->cotizacion = $request->cotizacion;
			}
			
			$factura->moneda()->associate($moneda);

			if($cliente != null){
				$factura->cliente()->associate($cliente);
				$factura->nombreCliente = $cliente->nombre . " " . $cliente->apellido;
				$factura->rut = $cliente->rut;            
			}else{
				$factura->nombreCliente = $request->cliente;
				$factura->rut = $request->rut;
			}
			$factura->direccion = $request->direccion;

			$factura->save();
			$ok = true;

			for ($i=0; $i < count($articulos); $i++) {
				$producto = Producto::BuscarPorCodigo($articulos[$i]->codigo)->first();
				$linea = $articulos[$i];
				//dd($linea, $producto);
				if($producto->stock >= $linea->cantidad){
					$lineaProducto = new LineaProducto();
					$lineaProducto->factura()->associate($factura);
					$lineaProducto->producto()->associate($producto);
					$lineaProducto->usuario()->associate(Auth::user());

					$producto->stock -= $linea->cantidad;
					$lineaProducto->stock = $producto->stock;
					
					$lineaProducto->precioUnitario = $linea->precio;
					$lineaProducto->cantidad = $linea->cantidad;

					//$lineaProducto->subTotal = $producto->precio * $linea->cantidad;
					$lineaProducto->subTotal = $articulos[$i]->precio * $linea->cantidad;
					// Para los impuestos accede al tipo de iva que tenga el producto.
					// Próxima versión debería poer modificarse si se quiere.
					$lineaProducto->impuestos = $lineaProducto->subTotal * ($producto->iva->tasa / 100);
					
					$lineaProducto->total = $lineaProducto->subTotal + $lineaProducto->impuestos;

					$lineaProducto->fecha = date("Y-m-d H:i:s");

					$factura->impuestos += $lineaProducto->impuestos;
					$factura->subTotal += $lineaProducto->subTotal;
					$moneda_simbolo = $factura->moneda->simbolo;

					$lineaProducto->descripcion = "x$lineaProducto->cantidad $producto->nombre - TOTAL $moneda_simbolo $lineaProducto->total";                
					
					$lineaProducto->save();
					$producto->save();
				}
				$factura->total = $factura->impuestos + $factura->subTotal;
				$factura->save();
			}
			$mensaje = "La factura fue cargada correctamente.";        
			return Redirect::to('facturas/detalle/' . $factura->id)->with(compact('mensaje'));            
		}
	}

	public function detalle(Request $request, $factura_id)
	{
		$factura = Comprobante::find($factura_id);
		
		return view('comprobantes.detalle')->with(compact('factura'));
	}

	public function imprimir(Request $request, $factura_id)
	{
		$factura = Comprobante::find($factura_id);        
		
		return view('comprobantes.imprimir')->with(compact('factura'));
	}
}
