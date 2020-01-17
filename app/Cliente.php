<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cliente extends Model
{
	protected $table = 'clientes';

	protected $fillable = [
		'nombre', 'apellido', 'empresa', 'rut', 'mail', 'direccion', 'telefono', 'tipo_documento', 'genero'
	];

	protected $dates = ['deleted_at'];

	public function comprobantes(){
		return $this->hasMany(Comprobante::class);
	}

	public function tipoDocumento(){
		return $this->belongsTo(TipoDocumento::class, 'tipo_documento');
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

	public function getSaldo(){
		$facturas_inpagas = Factura::buscarPorCliente($this->id)->where('deuda_actual', '>', 0)->get();

		$saldo_negativo = $facturas_inpagas->reduce(function ($saldo, $item) {
			return $saldo + $item->deuda_actual;
		});

		$saldo_positivo = 0;

		$total = $saldo_negativo - $saldo_positivo;
		return $total;
	}
}
