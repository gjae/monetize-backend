<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Cuenta;

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
}
