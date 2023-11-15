<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'conta';
	protected $primaryKey = 'conta_id';

	protected $fillable = array('conta_id', 'saldo');
}
