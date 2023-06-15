<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
