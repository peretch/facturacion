<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use SoftDeletes;
    use Sortable;

    protected $table = 'insumos';

    protected $fillable = [
        'codigo','stock', 'nombre','descripcion', 'tasa_iva_id'
    ];

    public $sortable = [
        'codigo','stock', 'nombre','descripcion', 'tasa_iva_id'
    ];

    protected $dates = ['deleted_at'];

    public function iva(){
        return $this->belongsTo(TasaIva::class, 'tasa_iva_id');
    }
}
