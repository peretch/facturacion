<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comprobante;
use App\Recibo;

class Factura extends Model
{
	protected $table = 'facturas';

	protected $fillable = [
		'comprobante_id', 'fecha_vencimiento', 'plazo', 'deuda_original', 'deuda_actual'
	];

	public function comprobante(){
		return $this->belongsTo(Comprobante::class, 'comprobante_id');
	}

	public function recibos(){
        return $this->belongsToMany(Recibo::class, 'recibo_facturas', 'factura_id', 'recibo_id')->withPivot('deuda_inicial', 'deuda_final');
    }


	// BUSQUEDA
	public function scopeBuscarPorCliente($query, $texto, $boolean = 'or'){		
		$query->join('comprobantes', 'comprobantes.id', '=', 'facturas.comprobante_id')
					->select('facturas.*')
					->where('comprobantes.cliente_id', '=', $texto, $boolean);
	}
	

	// FLITROS
	public function scopeFiltrarPorFecha($query, $texto, $boolean = 'or'){		
		return $query->where('facturas.fecha_vencimiento', '<=', $texto, $boolean);
	}	

	public function scopeFiltrarPorCliente($query, $texto, $boolean = 'or'){
		$query->join('comprobantes', 'comprobantes.id', '=', 'facturas.comprobante_id')
					->where('comprobantes.cliente_id', '=', $texto, $boolean);
	}
}
