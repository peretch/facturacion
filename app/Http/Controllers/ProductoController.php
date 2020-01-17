<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\FamiliaProducto;
use App\Notificacion;
use App\LineaProducto;
use App\Producto;
use App\Moneda;
use App\TasaIva;
use App\User;
use DB;

class ProductoController extends Controller
{    
	public function index(Request $request)
	{
		$busqueda = $request->get('busqueda');
		$producto = Producto::BuscarPorCodigo($busqueda)->first();
		if ($producto !=null) {
			return Redirect::to('productos/' . $producto->busqueda);
		}else{
			$producto = Producto::BuscarPorCodigoDeBarras($busqueda)->first();
			if ($producto !=null) {
				return Redirect::to('productos/' . $producto->busqueda);
			}else{
				$productos = Producto::Filtrar($busqueda)->orderBy('nombre')->sortable()->paginate(20);
				return view('productos.index')->with(compact('productos'));
			}
		}
	}

	public function buscar(Request $request){
		$texto = $request->texto;
		$productos = Producto::BuscarPorCodigo($texto)->with('iva')->get();
		if(count($productos) == 0){	        
			$productos = Producto::FiltrarPorCodigo($texto)
							->FiltrarPorNombre($texto)
							->with('iva')
							->get();
		}
		return Response()->json([
			'productos' => $productos
		]);
	}

	public function nuevo()
	{
		$productos = Producto::all();
		$moneda = Moneda::find(config('app.monedaPreferida'));
		$familias_producto = FamiliaProducto::orderBy('nombre')->get();
		return view('productos.nuevo')->with(compact('productos', 'familias_producto', 'moneda'));
	}

	public function guardar(Request $request){        
		// validaciones
		$this->validate($request, [                 
			'codigo' => 'required',
			'nombre' => 'required',
		]);
		$producto = Producto::BuscarPorCodigo($request->codigo)->get();
		try{
			$iva = TasaIva::find(1);
			//Acá se hace el alta
			$producto = new Producto();
			$producto->codigo  = $request->codigo;
			$producto->codigo_de_barras  = $request->codigo_de_barras;
			$producto->nombre  = $request->nombre;
			$producto->descripcion  = nl2br($request->descripcion);
			$producto->familiaProducto_id  = $request->familia_producto;

			if($request->precio!='' || $request->precio>0){
				$producto->precio  = floatval(str_replace(',', '.', str_replace('.', '', $request->precio)));
			}else{
				$producto->precio  = 0;
			}

			if($request->stock!='' || $request->stock>0){
				$producto->stock  = $request->stock;
			}else{
				$producto->stock  = 0;
			}
			
			$producto->save();
			$producto->registrarCambioPrecio();
			$mensaje = "El producto fue ingresado correctamente.";
			return Redirect::to('productos/nuevo/')->with(compact('mensaje'));			
		} catch ( \Illuminate\Database\QueryException $e) {
			if($e->errorInfo[0] == "23000"){
				$error = "Ya existe un producto con el código '" . $producto->codigo . "'.
				";
				return Redirect::back()->with(compact('error'));
			}            
		}
	}

	public function detalle($producto_codigo){
		$producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
		$familias_producto = FamiliaProducto::orderBy('nombre')->get();
		$movimientos = $producto->LineasProducto()->orderBy('fecha', 'desc')->paginate(6);
		$precios_historico = $producto->preciosHistorico();
		$tasas_iva = TasaIva::all();

		return view('productos.detalle')->with(compact('producto', 'movimientos', 'familias_producto', 'precios_historico', 'tasas_iva'));
	}

	public function editar(Request $request){
		$producto_id = $request->producto_id;
		$producto = Producto::BuscarPorId($producto_id)->first();        

		if(is_null($producto)){
			$alerta = "El producto no existe.";
			return Redirect::back()->with(compact('alerta'));
		}else{
			if($producto->codigo != $request->codigo){
				$producto->codigo  = $request->codigo;
			}
			if($producto->nombre != $request->nombre){
				$producto->nombre  = $request->nombre;
			}
			$producto->codigo_de_barras  	= $request->codigo_de_barras;
			$producto->descripcion  		= nl2br($request->descripcion);
			$producto->familiaProducto_id  	= $request->familia_producto;
			$producto->tasa_iva_id  		= $request->tasa_iva;

			if($request->precio!='' || $request->precio>0){
				if($request->precio != $producto->precio){
					$producto->precio  = floatval(str_replace(',', '.', str_replace('.', '', $request->precio)));
					$producto->registrarCambioPrecio();
				}
			}else{
				$producto->precio  = 0;
			}			
			
			$producto->save();            
			$mensaje = "El producto fue modificado correctamente.";
			return Redirect::to('productos/detalle/'.$producto->codigo)->with(compact('mensaje'));
		}
	}

	public function borrar(Request $request){
		$producto = Producto::BuscarPorId($request->producto_id);
		if($producto != null){
			$producto->delete();
			
			return Redirect::to('/productos')->with(compact('mensaje', 'precios_historico'));
		}
	}

	public function configuracion(Request $request, $producto_codigo){
		$producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
		if($producto != null){
			$stock_minimo = $request->stockMinimo;
			if($stock_minimo != null){
				if($stock_minimo >= 0){
					$producto->stock_minimo_valor = $stock_minimo;                    
				}else{
					$error = "ERROR: El valor ingresado como stock mínimo debe ser mayor o igual a 0.";
					return Redirect::back()->with(compact('error'));
				}
			}
			$producto->save();
			$mensaje = "Configuración del producto actualizada.";
			return Redirect::back()->with(compact('mensaje'));
		}
	}

	public function movimientoModificarStock(Request $request, $producto_codigo){        
		$producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
		if($producto != null){

			$cantidad = $request->cantidad;

			if($request->accion == "sumar"){
				$producto->stock += $cantidad;
				$descripcion = "Ingreso de stock: " . $request->descripcion;
			}else if($request->accion == "restar"){
				$producto->stock -= $cantidad;
				$descripcion = "Retiro de stock: " . $request->descripcion;
			}else{
				$producto->stock = $cantidad;
				$descripcion = "Sustitución de stock: " . $request->descripcion;
			}
			// Si el stock final es válido, guardamos el producto e informamos del cambio.
			// TODO: Crear un trigger que lo haga automáticamente después del save.
			if($producto->stock >= 0){
				$producto->save();
				$producto->registrarCambioStock($cantidad, $descripcion);
				// Si el stock restante es menor al mínimo. Se envía una notificación de que quedan pocos.				
				if($producto->stock_minimo_notificar && $producto->stock <= $producto->stock_minimo_valor){
					$titulo = "Stock mínimo alcanzado";
					$texto = "Quedan " . $producto->stock . " unidad/es de " . $producto->nombre; 
					$link_texto = "Ir al producto";
					$link = "/productos/detalle/" . $producto->codigo;
					Notificacion::crearNotificacion($titulo, $texto, $link, $link_texto);
				}

				$mensaje = "Stock modificado correctamente.";
				return Redirect::back()->with(compact('mensaje'));
			}else{
				$error = "ERROR: El stock final debe ser mayor o igual a 0.";
				return Redirect::back()->with(compact('error'));
			}
		}
	}

	public function NotifStockMin(Request $request, $producto_codigo){
		$producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
		if($producto != null){
			if($producto->stock_minimo_notificar == false){
				$producto->stock_minimo_notificar = true;
				$producto->save();
				$mensaje = "Notificación activada correctamente.";
				return Redirect::back()->with(compact('mensaje'));
			}else{
				$producto->stock_minimo_notificar = false;
				$producto->save();
				$mensaje = "Notificación desactivada correctamente.";
				return Redirect::back()->with(compact('mensaje'));
			}
		}        
	}

	public function nuevaFamiliaProducto(Request $request){		
		$familiaProducto = new FamiliaProducto();
		try {
			$familiaProducto->nombre = $request->nombreFamiliaProducto;
			$familiaProducto->save();
			return $familiaProducto->id;
			//$mensaje = "Familia de producto agregada correctamente.";
			//return Redirect::back()->with(compact('mensaje'));
		} catch ( \Illuminate\Database\QueryException $e) {
			if($e->errorInfo[0] == "23000"){
				$error = "Ya existe una familia de producto llamada '" . $request->nombreFamiliaProducto . "'.
				";
				return Redirect::back()->with(compact('error'));                
			}
			dd($error);
		}
	}

	public function movimientos(Request $request){
		$usuarios = User::where('id','>',1)->get();
		$fechaInicio = $request->fechaInicio;
		$fechaFin = $request->fechaFin;        

		if($fechaFin && $fechaInicio){            
			$fechaInicio = "$fechaInicio 00:00:00";
			$fechaFin = "$fechaFin 23:59:59";
			$movimientos = LineaProducto::where('fecha', '>=', $fechaInicio)
							->where('fecha', '<=', $fechaFin)
							->paginate(25);            
		}else{
			$movimientos = LineaProducto::orderBy('fecha', 'desc')->paginate(25);
		}
		
		return view('productos.movimientos')->with(compact('movimientos', 'usuarios'));
	}
}
