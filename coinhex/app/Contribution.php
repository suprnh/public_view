<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $table = 'contribution';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
