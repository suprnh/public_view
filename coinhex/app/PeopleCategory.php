<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleCategory extends Model
{
    protected $table = 'people_category';
	protected $primarykey = 'ID';
	
	
	public $timestamps = false;
}
