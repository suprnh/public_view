<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentors';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
