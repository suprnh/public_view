<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $table = 'kyc';
	protected $primarykey = 'ID';
	
	//protected $fillable = ['first_name','last_name'];

	protected $guarded = ['first_name','last_name'];
	
	public $timestamps = false;
}
