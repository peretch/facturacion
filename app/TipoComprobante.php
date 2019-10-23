<?php

namespace App;
use App\Comprobante;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{    
    public function comprobantes(){
    	return $this->hasMany(Comprobante::class);
    }
}
