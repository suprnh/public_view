<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpCat extends Model
{
    protected $table = 'expertise_category';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
