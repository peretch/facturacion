<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notificacion;
use App\Preferencias;
use App\Recibo;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function LineasProducto(){
        return $this->hasMany(LineaProducto::class);
    }

    public function recibosEmitidos(){
        return $this->hasMany(Recibo::class);
    }

    public function notificaciones(){
        return $this->belongsToMany(Notificacion::class, 'notificacion_usuarios', 'usuario_id', 'notificacion_id');
    }

    public function preferencias(){
        return $this->hasOne(Preferencias::class, 'usuario_id');
    }

}
