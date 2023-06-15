<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'people';
	protected $primarykey = 'ID';

	
	public $timestamps = false;
}
