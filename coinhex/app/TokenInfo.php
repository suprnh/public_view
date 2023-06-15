<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenInfo extends Model
{
    protected $table = 'token_info';
	protected $primarykey = 'ID';
	
	
	public $timestamps = false;
}
