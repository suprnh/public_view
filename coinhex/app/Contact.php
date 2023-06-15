<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
