<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Cuenta;
use DB;

class CuentasController extends Controller
{
	public function index(Request $req){
		return response([
				'error' => false, 
				'mensaje' => 
				'RECIBIDO', 
				'cuentas' => Cuenta::where('user_id', 1)->get()->toJson()
			], 200)
			->header('Content-Type', 'application/json');
	}

	public function addMovimiento(Request $req){
		return response(['error' => false, 'mensaje' => 'DATOS RECIBIDOS', 'datos' => $req], 200)
				->header('Content-Type', 'application/json');
	}

	public function nueva(Request $req){

		$cuenta = new Cuenta($req->all());
		DB::beginTransaction();
		try {
			$cuenta->user_id = 1;
			if($cuenta->save()){
				DB::commit();
				return response([
					'error' => false,
					'mensaje' => 'Cuenta agregada exitosamente'
				], 200)->header('Content-Type', 'application/json');
			}

		} catch (\Exception $e) {
			DB::rollback();
			return response([
					'error' 	=> false,
					'mensaje' 	=> 'Cuenta recibida',
					'request' 	=> $e->getMessage()
				], 200)->header('Content-Type', 'application/json');
		}

		return response([
			'error' 	=> false,
			'mensaje' 	=> 'Cuenta recibida',
			'request' 	=> $req->descripcion
		], 200)->header('Content-Type', 'application/json');
	}

	public function get(Request $req){
		$cuenta = Cuenta::find($req->id);
		$data = [
			'movimientos' 		=> $cuenta->movimientos->toJson(),
			'saldo' => number_format($cuenta->movimientos->sum('monto'), 2),
			'ultimo_movimiento' => $cuenta->movimientos()->orderBy('fecha_movimiento','DESC')->first(),
			'total_movimientos' => $cuenta->movimientos->count(),
			'promedio' 			=> number_format($cuenta->movimientos->avg('monto'), 2)

		];

		return response($data, 200)->header('Content-Type', 'application/json');
	}
}
