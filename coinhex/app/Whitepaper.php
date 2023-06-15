<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whitepaper extends Model
{
    protected $table = 'whitepaper';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
