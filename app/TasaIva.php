<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;

class TasaIva extends Model
{
    protected $table = 'tasas_iva';

    protected $fillable = [
    	'nombre', 'tasa'
    ];

    public function productos(){
    	return $this->hasMany(Producto::class);
    }
}
