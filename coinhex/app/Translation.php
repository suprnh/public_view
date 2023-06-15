<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translation';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
