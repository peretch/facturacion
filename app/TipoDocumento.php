<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_documento';

    protected $fillable = [
        'tipo_documento'
    ];    
}
