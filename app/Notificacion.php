<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notificacion;
use App\User;
use Auth;
use DB;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'titulo', 'texto', 'link', 'fecha'
    ];    

    public function usuarios(){
        return $this->belongsToMany(User::class, 'notificacion_usuarios', 'notificacion_id', 'usuario_id');
    }

    public static function crearNotificacion($titulo, $texto, $link, $link_texto){
        $usuario = Auth::user();

        $notificacion = new Notificacion();
        $notificacion->titulo = $titulo;
        $notificacion->texto = $texto;
        $notificacion->link = $link;
        $notificacion->link_texto = $link_texto;
        $notificacion->fecha = date("Y-m-d H:i:s");
        $notificacion->save();
       
        $usuario->notificaciones()->attach($notificacion);
        $usuario->save();
        
        Notificacion::cargarNotificaciones();
    }

    public static function cargarNotificaciones(){
        $usuario = Auth::user();
        $notificaciones = $usuario->notificaciones()->get();        
        session(['notificaciones' => null]);
        session(['notificaciones' => $notificaciones]);        
    }
}