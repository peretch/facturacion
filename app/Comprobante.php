<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TipoComprobante;
use App\LineaProducto;
use App\Moneda;
use App\User;

class Comprobante extends Model
{
    use SoftDeletes;
    
    protected $table = 'comprobantes';

    protected $fillable = [
        'serie', 'numero', 'nombre_cliente', 'direccion', 'rut', 'subTotal', 'iva', 'total', 'cliente_id', 'moneda_id', 'cotizacion', 'fecha_emision', 'tipo_comprobante_id'
    ];

    protected $dates = ['deleted_at'];

    public function tipo(){
        return $this->belongsTo(TipoComprobante::class, 'tipo_comprobante_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function lineasProducto(){
        return $this->hasMany(LineaProducto::class);
    }

    public function factura(){
        return $this->hasOne(Factura::class);
    }


    // FILTROS
    
}
