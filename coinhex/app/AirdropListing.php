<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirdropListing extends Model
{
    protected $table = 'airdrop_listing';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
