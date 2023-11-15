<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacao', function (Blueprint $table) {
            $table->id('transacao_id');
            $table->bigInteger('conta_id')->unsigned();
            $table->enum('forma_pagamento', ['P', 'C', 'D']);
            $table->double('valor');
            $table->timestamps();

            $table->foreign('conta_id')->references('conta_id')->on('conta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['conta_id']);
        Schema::dropIfExists('transacao');
    }
}
