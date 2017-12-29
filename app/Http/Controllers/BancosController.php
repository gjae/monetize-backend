<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Banco;

class BancosController extends Controller
{
    public function get(Request $req){
    	$bancos = new Banco;

    	if( $req->has('all') ){
    		$bancos = $bancos->get();
    	}

    	return response([
    		'error' => false,
    		'bancos' => $bancos->toJson()
    	], 200)->header('Content-Type', 'application/json');
    }
}
