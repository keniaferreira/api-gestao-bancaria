<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('conta')->group(function () {

	Route::post('/', [\App\Http\Controllers\ContaController::class, 'criarConta']);
	Route::get('{id}', [\App\Http\Controllers\ContaController::class, 'consultarConta']);

	Route::post('/criarcontainicial', function() {
		$contaCriar = new \Illuminate\Http\Request();
		$contaCriar->replace([
    		'saldo'    => 500
    	]);
		$contaCriar = \App\Http\Controllers\ContaController::criarConta($contaCriar);

		return Response::json($contaCriar);
	});	
});

Route::prefix('transacao')->group(function () {
	Route::post('/', [\App\Http\Controllers\TransacaoController::class, 'efetuarTransacao']);
});