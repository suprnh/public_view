<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_template';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
