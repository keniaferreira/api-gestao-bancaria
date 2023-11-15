<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacao';
	protected $primaryKey = 'transacao_id';

	protected $fillable = array('conta_id', 'forma_pagamento');
}
