<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Banco extends Model
{
    use SoftDeletes;
    protected $table = 'bancos';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nombre_banco',
        'rif', 
        'telefono', 
        'codigo', 
        'codigo_cuentas'
    ];

    public function cuentas(){
    	return $this->hasMany('App\Modelos\Cuenta');
    }
    
}
