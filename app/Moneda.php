<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comprobante;

class Moneda extends Model
{	
	protected $table = 'monedas';

	protected $fillable = [
		'nombre','simbolo', 'redondeo'
	];


	public function comprobantes(){
		return $this->hasMany(Comprobante::class)->withTrashed();
	}
}
