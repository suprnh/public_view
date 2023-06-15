<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
