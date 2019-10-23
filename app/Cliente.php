<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cliente extends Model
{
	protected $table = 'clientes';

	protected $fillable = [
		'nombre', 'apellido', 'empresa', 'rut', 'mail', 'direccion'
	];

	protected $dates = ['deleted_at'];

	public function comprobantes(){
		return $this->hasMany(Comprobante::class);
	}

	// FILTROS
	public function scopeFiltrarPorNombre($query, $texto, $boolean = 'or'){
		return $query->where('nombre','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorApellido($query, $texto, $boolean = 'or'){
		return $query->where('apellido','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorRut($query, $texto, $boolean = 'or'){
		return $query->where('rut','like', '%'.$texto.'%', $boolean);
	}
	public function scopeFiltrarPorMail($query, $texto, $boolean = 'or'){
		return $query->where('mail','like', '%'.$texto.'%', $boolean);
	}
}
