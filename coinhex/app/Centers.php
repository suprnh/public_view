<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centers extends Model
{
    protected $table = 'centers';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
