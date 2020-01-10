<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;
use App\Comprobante;
use App\User;

class LineaProducto extends Model
{
    protected $table = 'linea_productos';

    protected $fillable = [
        'producto_id', 'usuario_id', 'descripcion', 'cantidad', 'fecha', 'stock', 'comprobante_id', 'tasa_iva_id', 'iva'
    ];

    public $timestamps = false;

    public function producto(){
    	return $this->belongsTo(Producto::class, 'producto_id')->withTrashed();
    }

    public function usuario(){
    	return $this->belongsTo(User::class, 'usuario_id');
    }

    public function comprobante(){
        return $this->belongsTo(Comprobante::class, 'comprobante_id');
    }

    public function iva(){
        return $this->belongsTo(TasaIva::class, 'tasa_iva_id');
    }
}
