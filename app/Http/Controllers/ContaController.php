<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Conta;
use Response;
use Exception;
use DB;

class ContaController extends Controller
{
    public static function criarConta(Request $request)
    {
    	$retorno = array();

    	try {
    		DB::beginTransaction();

    		$conta        = new Conta;
    		if (isset($request->conta_id)) {
    			$conta->conta_id = $request->conta_id;
    		}
    		$conta->saldo = number_format($request->saldo, 2, '.', '');
    		$conta->save();

    		DB::commit();

    		$retorno = array(
    			'conta_id' => $conta->conta_id,
    			'saldo'    => $conta->saldo
    		);
    	} catch(\PDOException $e ) {
    		return Response::json([$e->getMessage()]);
    	}

    	return Response::json($retorno);

    }

    public static function consultarConta($id)
    {
    	$retorno = array();

    	try {
    		$conta = Conta::where('conta_id', '=', $id)->first();

    		if (empty($conta)) {
    			throw new Exception('Essa conta não existe');
    		} else {
    			$retorno = array(
    				'conta_id' => $conta->conta_id,
    				'saldo'    => $conta->saldo
    			);
    		}

    	} catch(\Exception $e) {
    		return Response::json([
    			'message' => $e->getMessage()], 400);
    	} catch(\PDOException $e) {
    		return Response::json($e->getMessage());
    	}

    	return Response::json($retorno);

    }
}