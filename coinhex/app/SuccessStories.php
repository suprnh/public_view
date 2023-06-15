<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuccessStories extends Model
{
    protected $table = 'success_stories';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
