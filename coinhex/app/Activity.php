<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity_plan';
	protected $primarykey = 'ID';
	

	public $timestamps = false;
}
