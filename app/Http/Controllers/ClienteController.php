<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Cliente;

class ClienteController extends Controller
{
	public function index(Request $request)
	{
		$busqueda = $request->get('busqueda');
		$clientes = CLiente::FiltrarPorNombre($busqueda)
			->FiltrarPorApellido($busqueda)
			->FiltrarPorRut($busqueda)
			->paginate(25);
		return view('clientes.index')->with(compact('clientes'));
	}

	public function nuevo()
	{
		$tipos_documento = TipoDocumento::all();
		$clientes = Cliente::all();
		return view('clientes.nuevo')->with(compact('tipos_documento', 'clientes'));
	}

	public function guardar(Request $request){
		$cliente = new Cliente();
		if($request->cliente_id){
			$cliente = Cliente::find($request->cliente_id);
			if($cliente->empresa){
				$cliente->nombre = $request->razonSocial;
				$cliente->rut = $request->rut;
			}else{
				$cliente->nombre = $request->nombre;
				$cliente->apellido = $request->apellido;
				$cliente->genero = $request->genero;
			}
			$cliente->mail = $request->mail;
			$cliente->direccion = $request->direccion;
			$cliente->telefono = $request->telefono;
			$cliente->save();
			$mensaje = "Los datos del cliente han sido modificados correctamente.";
			return Redirect::to('/clientes/detalle/' . $cliente->id)->with(compact('mensaje'));
		}else{
			if($request->tipo_cliente == "persona"){
				$cliente->nombre = $request->nombre;
				$cliente->apellido = $request->apellido;
				if($request->tipo_documento != null){
					$cliente->documento = $request->documento;
					$cliente->tipo_documento = $request->tipo_documento;
				}
			}else{
				$cliente->nombre = $request->razonSocial;
				$cliente->rut = $request->rut;
				$cliente->empresa = 1;
			}
			$cliente->mail = $request->mail;
			$cliente->direccion = $request->direccion;			
			$cliente->telefono = $request->telefono;
			$cliente->save();
			$mensaje = "El cliente fue ingresado correctamente.";
			return Redirect::to('/clientes/nuevo/')->with(compact('mensaje'));
		}
	}

	public function detalle($cliente_id){
		$cliente = Cliente::find($cliente_id);
		$comprobantes = $cliente->comprobantes()->paginate(6);
		return view('clientes.detalle')->with(compact('cliente', 'comprobantes'));
	}

	public function buscar(Request $request){
		$texto = $request->texto;
		$clientes = Cliente::FiltrarPorNombre($texto)
						->FiltrarPorApellido($texto)
						->FiltrarPorRut($texto)
						->FiltrarPorMail($texto)
						->get();
		return Response()->json([
			'clientes' => $clientes
		]);
	}
}
