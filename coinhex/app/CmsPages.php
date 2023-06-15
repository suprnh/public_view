<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPages extends Model
{
    protected $table = 'cms_pages';
	protected $primarykey = 'ID';

	public $timestamps = false;
}
