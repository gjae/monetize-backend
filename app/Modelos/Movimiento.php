<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    use SoftDeletes;
    protected $table = 'movimientos';
    protected $fillable = [
    	'cuenta_id',
    	'tipo_movimiento',
    	'fecha_movimiento',
    	'nro_ref',
    	'nota',
    	'monto',
    	'descripcion'
    ];

    public function cuenta(){
    	return $this->belongsTo('App\Modelos\Cuenta');
    }

    public function getNotaAttribute($old){
    	switch ($old) {
    		case 'C':
    			return 'ACREDITACION';
    			break;
    		
    		case 'DEBITO':
    			return 'DEBITO';
    			break;
    	}
    }

    public function getMontoAttribute($old){
    	if( $this->attributes['nota'] == 'D' && $old > 0 )
    		return $old * -1;

    	return $old;
    }

    public function getTipoMovimientoAttribute($old){
    	switch ($old) {
    		case 'T':
    			return 'TRANSFERENCIA';
    			break;
    		
    		case 'D':
    			return 'DEPOSITO';
    			break;
    		case 'OT':
    			return 'OTROS';
    			break;
    	}
    }
}
