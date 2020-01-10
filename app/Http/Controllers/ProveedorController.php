<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Proveedor;

class ProveedorController extends Controller
{
    public function index(Request $request)
	{		
		$busqueda = $request->get('busqueda');
		$proveedores = Proveedor::FiltrarPorNombre($busqueda)
					->FiltrarPorRazonSocial($busqueda)
					->FiltrarPorRut($busqueda)
					->FiltrarPorMail($busqueda)
					->orderBy('nombre')
					->paginate(20);		
		return view('proveedores.index')->with(compact('proveedores'));
	}

	public function nuevo(){
		$proveedores = Proveedor::all();
		return view('proveedores.nuevo')->with(compact('proveedores'));
	}

	public function guardar(Request $request){
		$proveedor_id = $request->proveedor_id;
		// Modificar proveedor
		if($proveedor_id){
			$p = Proveedor::find($proveedor_id);
			$mensaje = 'El proveedor ha sido modificado correctamente.';
			$url = '/proveedores/detalle/'.$proveedor_id;

		// Nuevo proveedor
		}else{
			if($request->rut){
				if(Proveedor::buscarPorRut($request->rut)->first()){
					$error = 'No se ha registrado el nuevo proveedor. El RUT especificado ya existe en el sistema.';
					$url = '/proveedores/nuevo';
					return Redirect::to($url)->with(compact('error'));
				}else{
					$p = new Proveedor();
					$mensaje = 'El proveedor ha sido ingresado correctmente.';
					$url = '/proveedores/nuevo';
				}
			}else{
				$p = new Proveedor();
				$mensaje = 'El proveedor ha sido ingresado correctmente.';
				$url = '/proveedores/nuevo';
			}			
		}		
		if($request->rut)
			$p->rut = $request->rut;		
		if($request->razon_social)
			$p->razon_social = $request->razon_social;

		$p->nombre = $request->nombre;
		$p->telefono = $request->telefono;
		$p->mail = $request->mail;
		$p->direccion = $request->direccion;
		$p->web = $request->web;
		$p->save();

		return Redirect::to($url)->with(compact('mensaje'));
	}

	public function detalle($proveedor_id){		
		$proveedor = Proveedor::find($proveedor_id);		
		if($proveedor){
			return view('proveedores.detalle')->with(compact('proveedor'));
		}else{
			$mensaje = "No se encontró el proveedor al cual se intentó acceder.";
			return Redirect::to('/proveedores')->with(compact('mensaje'));
		}
	}
}
