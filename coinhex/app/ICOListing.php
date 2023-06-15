<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ICOListing extends Model
{
    protected $table = 'ico_listing';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
