<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modelos\Banco;

class Cuenta extends Model
{
	use SoftDeletes;
	protected $table = 'cuentas';
	protected $fillable = [
		'nro_cuenta',
		'tipo_cuenta',
		'descripcion',
		'fecha_apertura',
		'user_id',
		'banco_id',
		'nombre_titular',
		'apellido_titular',
		'email_titular',
		'cedula_titular'
	];


	public function banco(){
		return $this->belongsTo('App\Modelos\Banco');
	}

	public function titular(){
		return $this->belongsTo('App\User');
	}

	public function movimientos(){
		return $this->hasMany('App\Modelos\Movimiento');
	}

	public function setNombreTitularAttribute($old){
		$this->attributes['nombre_titular'] = strtoupper($old);
	}

	public function setApellidoTitularAttribute($old){
		$this->attributes['apellido_titular'] = strtoupper($old);
	}

	public function getBancoIdAttribute($old){
		return Banco::find($old);
	}

	public function getTipoCuentaAttribute($old){
		switch ($old) {
			case 'C':
				return 'CORRIENTE';
				break;
			case 'A':
				return 'AHORROS';
				break;

			case 'F':
				return 'FAL';
				break;
			case 'FC':
				return 'FIDEICOMISO';
				break;
			case 'OT':
				return 'OTROS';
				break;
		}
	}
}
