<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\facades\SistemaFactura;
use App\TipoComprobante;
use App\Notificacion;
use App\LineaProducto;
use App\Cliente;
use App\Comprobante;
use App\Factura;
use App\Producto;
use App\Recibo;
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
			$comprobantes = Comprobante::where('fecha_emision', '>=', $fechaInicio)
					->where('fecha_emision', '<=', $fechaFin)
					->orderby('fecha_emision', 'desc')
					->paginate(20);            
		}else{
			$comprobantes = Comprobante::orderby('fecha_emision', 'desc')->paginate(20);
		}
		return view('comprobantes.index')->with(compact('comprobantes', 'monedas', 'tipos_comprobante'));            
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
		// 3- Factura de venta a créditos

		//TODO: Asociar tipo de comprobante
		if($tipo_comprobante == 1 || $tipo_comprobante == 2 || $tipo_comprobante == 3){
			$articulos = json_decode($request->listadoArticulos);
			$moneda = Moneda::find($request->moneda);
			$cliente = Cliente::find($request->cliente_id);			
			$comprobante = new Comprobante();

			$comprobante->serie = $request->serie;
			$comprobante->numero = $request->numero;        
			$comprobante->fecha_emision = $request->fecha_emision;
			
			$comprobante->descripcion_1 = $request->descripcion_1;
			$comprobante->descripcion_2 = $request->descripcion_2;
			$comprobante->descripcion_3 = $request->descripcion_3;

			if(is_numeric($request->cotizacion)){
				$comprobante->cotizacion = $request->cotizacion;
			}
			
			$comprobante->moneda()->associate($moneda);

			if($cliente != null){
				$comprobante->cliente()->associate($cliente);
				$comprobante->nombre_cliente = $cliente->nombre . " " . $cliente->apellido;
				$comprobante->rut = $cliente->rut;            
			}else{
				if($tipo_comprobante == 3){
					$alerta = "Debe ingresar un cliente registrado para emitir una factura de venta a crédito.";
					return Redirect::back()->with(compact('alerta'));
				}
				$comprobante->nombre_cliente = $request->cliente;
				$comprobante->rut = $request->rut;
			}
			$comprobante->direccion = $request->direccion;
			$comprobante->tipo()->associate($request->tipo_comprobante);
			$comprobante->save();
			$ok = true;

			for ($i=0; $i < count($articulos); $i++) {
				$producto = Producto::BuscarPorCodigo($articulos[$i]->codigo)->first();
				$linea = $articulos[$i];
				//dd($linea, $producto);
				if($producto->stock >= $linea->cantidad){
					$lineaProducto = new LineaProducto();
					$lineaProducto->comprobante()->associate($comprobante);
					$lineaProducto->producto()->associate($producto);
					$lineaProducto->usuario()->associate(Auth::user());

					// Checkea si es devolución
					if($comprobante->tipo->id == 2){
						$linea->cantidad *= -1;						
					}

					$producto->stock -= $linea->cantidad;
					$lineaProducto->stock = $producto->stock;
					
					$lineaProducto->precioUnitario = $linea->precio;
					$lineaProducto->cantidad = $linea->cantidad;

					//$lineaProducto->subTotal = $producto->precio * $linea->cantidad;
					$lineaProducto->subTotal = $articulos[$i]->precio * $linea->cantidad;
					// Para los iva accede al tipo de iva que tenga el producto.
					// Próxima versión debería poer modificarse si se quiere.
					$lineaProducto->iva = $lineaProducto->subTotal * ($producto->iva->tasa / 100);
					
					$lineaProducto->total = $lineaProducto->subTotal + $lineaProducto->iva;

					$lineaProducto->fecha = date("Y-m-d H:i:s");

					$comprobante->iva += $lineaProducto->iva;
					$comprobante->subTotal += $lineaProducto->subTotal;
					$moneda_simbolo = $comprobante->moneda->simbolo;

					$lineaProducto->descripcion = "x $lineaProducto->cantidad  $producto->nombre  -  TOTAL $moneda_simbolo $lineaProducto->total";                
					
					$lineaProducto->save();
					$producto->save();
				}
				$comprobante->total = $comprobante->iva + $comprobante->subTotal;				
				$comprobante->save();								

				// Verificamos stock restante de producto para ver si notificar				
				if($producto->stock_minimo_notificar && $producto->stock <= $producto->stock_minimo_valor){
					$titulo = "Stock mínimo alcanzado";
					$texto = "Quedan " . $producto->stock . " unidad/es de " . $producto->nombre; 
					$link_texto = "Ir al producto";
					$link = "/productos/detalle/" . $producto->codigo;
					Notificacion::crearNotificacion($titulo, $texto, $link, $link_texto);
				}
			}


			// Verificamos si es una factura
			if($comprobante->tipo->id == 3){
				$fecha_vencimiento = $request->fecha_vencimiento;
				$deuda_original = $comprobante->total;

				if($request->pago_inicial)
					$deuda_actual = $comprobante->total - $request->pago_inicial;
				else
					$deuda_actual = $comprobante->total;

				$plazo = $request->plazo;

				$factura = SistemaFactura::getInstancia()->ingresarFactura($comprobante, $fecha_vencimiento, $deuda_original, $deuda_actual, $plazo);				
			}

			$mensaje = "El comprobante fue cargado correctamente.";        
			return Redirect::to('comprobantes/detalle/' . $comprobante->id)->with(compact('mensaje'));            
		}
	}

	public function detalle(Request $request, $comprobante_id)
	{
		$comprobante = Comprobante::find($comprobante_id);
		
		return view('comprobantes.detalle')->with(compact('comprobante'));
	}

	public function imprimir(Request $request, $comprobante_id)
	{
		$comprobante = Comprobante::find($comprobante_id);        
		
		return view('comprobantes.imprimir')->with(compact('comprobante'));
	}

	public function vencimientos(Request $request){
		$fecha = $request->fecha;
		$fecha_fin = $request->fecha_fin;	
		$cliente_id = $request->cliente_id;

		$vencimientos = Factura::where('facturas.id','>','0');
		
		if($cliente_id != null){
			$vencimientos->filtrarPorCliente($cliente_id, 'and');
		}
		if($fecha){
			$vencimientos->filtrarPorFecha($request->fecha, 'and');			
		}
		if(!$request->mostrar_facturas_pagas){
			$vencimientos = $vencimientos->where('deuda_actual', '>', 0, 'and');
		}
		if($request->ocultar_facturas_vencidas){
			$vencimientos = $vencimientos->where('fecha_vencimiento', '>', date('Y-m-d'), 'and');
		}
		
		$vencimientos = $vencimientos->orderby('fecha_vencimiento')
						->paginate(50);
				
		return view('facturas.vencimientos')->with(compact('vencimientos'));
	}

	public function nuevoRecibo($cliente_id){
		$cliente = Cliente::where('id', $cliente_id)->first();
		$monedas = Moneda::all();		
		if($cliente){
			$facturas = Factura::buscarPorCliente($cliente->id)
					->where('deuda_actual', '>', 0)
					->orderby('fecha_vencimiento')
					->get();					
			$total_adeudado = 0;
			$total_atrasado = 0;
			for ($i=0; $i < sizeof($facturas) ; $i++) {
				$total_adeudado += $facturas[$i]->deuda_actual;

				$hoy = time();
				$fecha_vencimiento = strtotime($facturas[$i]->fecha_vencimiento);
				$date_diff = $fecha_vencimiento - $hoy;
				$dias_restantes = round($date_diff / (60 * 60 * 24));

				if($dias_restantes < 0)
					$total_atrasado += $facturas[$i]->deuda_actual;
			}
			return view('facturas.nuevo_recibo')->with(compact('cliente', 'facturas', 'monedas', 'total_atrasado', 'total_adeudado'));
		}else{
			$error = "No se encontró ningún cliente para el ID especificado.";
			return Redirect::to('/comprobantes/vencimientos')->with(compact('error'));
		}
	}

	public function guardarRecibo(Request $request){		
		$facturas = json_decode($request->facturas_seleccionadas);		

		$usuario = Auth::user();
		$moneda = Moneda::find($request->moneda);
		$cliente = Cliente::find($request->cliente);
		
		$fecha = $request->fecha;
		$cotizacion = $request->cotizacion;
		$monto = $request->monto;		

		try{
			$recibo = new Recibo();
			// Entidades asociadas
			$recibo->moneda()->associate($moneda);		
			$recibo->usuario()->associate($usuario);		
			$recibo->cliente()->associate($cliente);
			
			$recibo->fecha = date("Y-m-d H:i:s");
			$recibo->monto = $monto;
			
			if($cotizacion)
				$recibo->cotizacion = $request->cotizacion;
			
			// Auxiliar para ir cancelando las facturas
			$saldo_aux = $recibo->monto;			
			// factura_id, deuda_actual, a_pagar, saldo_final
			for ($i=0; $i < count($facturas); $i++) {				
				if($saldo_aux > 0){
					$factura = Factura::find($facturas[$i]->factura_id);
					if($factura){
						if($factura->deuda_actual > 0){
							// PAGO PARCIAL O JUSTO
							if($factura->deuda_actual >= $saldo_aux){
								// variables temporales
								$deuda_inicial = $factura->deuda_actual;
								$deuda_final = round($factura->deuda_actual - $saldo_aux);
								
								// Asociamos recibo con todos sus datos a la factura.
								$factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

								// Una vez hecho esto, actualizamos deuda de la factura
								$factura->deuda_actual = $deuda_final;
								
								$factura->save();
								$saldo_aux = 0;
							// ESTOY PAGANDO DE MAS
							}else{
								// variables temporales
								$deuda_inicial = $factura->deuda_actual;
								$deuda_final = 0;								

								// Asociamos recibo con todos sus datos a la factura.
								$factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

								// Restamos al saldo actual lo que pagamos
								$saldo_aux -= $deuda_inicial;
								$factura->deuda_actual = 0;
								$factura->save();
							}							
						}
					}
				}				
			}
			$mensaje = "El recibo fue ingresado correctamente.";
			return Redirect::to('/comprobantes/recibos/nuevo/'.$cliente->id)->with(compact('mensaje'));
		} catch ( \Illuminate\Database\QueryException $e) {
			dd($e);
			return Redirect::back();
		}
	}
}
