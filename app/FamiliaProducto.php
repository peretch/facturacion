<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;

class FamiliaProducto extends Model
{
    #Tabla asociada
    protected $table = 'familia_productos';

    protected $fillable = [
        'nombre'
    ];

    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
