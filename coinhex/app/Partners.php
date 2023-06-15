<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $table = 'partners';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
