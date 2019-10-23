<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Preferencias extends Model
{
    protected $table = 'preferencias';
    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'usuario_id', 'estilo'
    ];

    public function usuario(){
    	return $this->belongsTo(User::class, 'usuario_id');
    }
}
