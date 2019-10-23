<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use App\Notificacion;
use App\Preferencias;
use Auth;

class HomeController extends Controller
{    
    public function index()
    {        
    	Notificacion::cargarNotificaciones();
        return view('Home.index');
    }

    public function ajustes(){
        return view('Home.ajustes');
    }

    public function ajustesDatosPersonales(Request $request){
        $usuario = Auth::user();
        try{
            $usuario->name  = $request->nombre;
            $hasher = app('hash');
            if( $request->passwordActual != null && $request->passwordActual != ''){
                if ($hasher->check($request->passwordActual, $usuario->password)) {
                    if($request->passwordNueva1 == $request->passwordNueva2){
                        $usuario->password = bcrypt($request->passwordNueva1);                        
                    }else{
                        $alerta = "Las contraseñas ingresadas no son iguales.";
                        return Redirect::back()->with(compact('alerta'));    
                    }
                }else{
                    $alerta = "La contraseña actual ingresada no es la correcta.";
                    return Redirect::back()->with(compact('alerta'));
                }
            }
            // Preferencias de estilo
            if($request->estilo != null){
                $preferencias = Preferencias::where('usuario_id', $usuario->id)->first();
                
                $preferencias->estilo = $request->estilo;
                $preferencias->save();
            }
            $usuario->save();
            $mensaje = "Datos personales actualizados";
            return Redirect::back()->with(compact('mensaje'));
        } catch ( \Illuminate\Database\QueryException $e) {
            dd($e);
            if($e->errorInfo[0] == "23000"){
                $error = "Error al intentar actualizar tus datos.";
                return Redirect::back()->with(compact('error'));
            }            
        }
        dd("error");
    }

    public function borrarNotificacion(Request $request, $notificacion_id){
        if($request->ajax()){            
        	$notificacion = Notificacion::find($notificacion_id);
        	$usuario = Auth::user();
            if($notificacion != null && $usuario != null){
                $usuario->notificaciones()->detach($notificacion);
                $usuario->save();
                Notificacion::cargarNotificaciones();

                if($notificacion->usuarios()->count() == 0){
                    $notificacion->delete();
                }        		
        	}
            $notificaciones_total = $usuario->notificaciones()->count();

            return Response()->json([
                'total' => $notificaciones_total,
                'mensaje' => 'Notiicación borrada'
            ]);
        }	
    }
}
