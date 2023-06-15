<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonus_master';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
