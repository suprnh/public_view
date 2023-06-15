<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $table = 'roadmap';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
