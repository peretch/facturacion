<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

	protected $fillable = [
		'nombre', 'razon_social', 'rut', 'mail', 'direccion', 'telefono', 'web'
	];

	protected $dates = ['deleted_at'];

	public function comprobantes(){
		return $this->hasMany(Comprobante::class);
	}

	// FILTROS
	public function scopeFiltrarPorNombre($query, $texto, $boolean = 'or'){
		return $query->where('nombre','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorRazonSocial($query, $texto, $boolean = 'or'){
		return $query->where('razon_social','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorRut($query, $texto, $boolean = 'or'){
		return $query->where('rut','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorMail($query, $texto, $boolean = 'or'){
		return $query->where('mail','like', '%'.$texto.'%', $boolean);
	}

	// BUSQUEDA
	public function scopeBuscarPorRut($query, $rut){
		return $query->where('rut','=',$rut);
	}
}
