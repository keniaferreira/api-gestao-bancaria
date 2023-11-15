<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Conta;
use \App\Models\Transacao;
use Response;
use Exception;
use DB;

class TransacaoController extends Controller
{
    public static function efetuarTransacao(Request $request)
    {    	
    	$retorno = array();

    	try {    		

    		$conta = Conta::where('conta_id', $request->conta_id)->first();

    		if (empty($conta)) {
    			$contaCriar = new \Illuminate\Http\Request();
    			$contaCriar->replace([
    				'conta_id' => intval($request->conta_id),
    				'saldo'    => 100 //Saldo padrão novas contas.
    			]);
    			$contaCriar = \App\Http\Controllers\ContaController::criarConta($contaCriar);
    		}

    		DB::beginTransaction();

    		$transacao = new Transacao;
    		$conta = Conta::where('conta_id', $request->conta_id)->first();

    		$valorTotalComJurosOperacao = floatval($request->valor);

    		switch ($request->forma_pagamento) {
    			case 'D':
    				$valorTotalComJurosOperacao += (3 / 100) * $valorTotalComJurosOperacao;
    				break;

    			case 'C':
    				$valorTotalComJurosOperacao += (5 / 100) * $valorTotalComJurosOperacao;
    				break;
    			
    			default:
    				break;
    		}

    		$valorTotalComJurosOperacao = number_format($valorTotalComJurosOperacao, 2, '.', '');

    		if ($valorTotalComJurosOperacao > $conta->saldo) {
    			throw new Exception($conta->saldo);
    		}

    		$novoSaldoConta = $conta->saldo - $valorTotalComJurosOperacao;
    		$novoSaldoConta = number_format($novoSaldoConta, 2, '.', '');

    		$conta->saldo = $novoSaldoConta;
    		$conta->save();

    		$transacao->conta_id        = $conta->conta_id;
    		$transacao->forma_pagamento = $request->forma_pagamento;    		
    		$transacao->valor           = $valorTotalComJurosOperacao;
    		$transacao->save();    	

    		DB::commit();

    		$retorno = array(
    			'conta_id' => $conta->conta_id,
    			'saldo'    => $conta->saldo
    		);

    	} catch(\Exception $e) {
    		return Response::json([
    			'message' => 'saldo: ' . $e->getMessage()], 400);
    	} catch(\PDOException $e ) {
    		return Response::json([$e->getMessage()]);
    	}

    	return Response::json($retorno);

    }

}
