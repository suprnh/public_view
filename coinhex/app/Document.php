<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $primarykey = 'Id';
    protected $fillable = ['Id','name', 'upload_master_id' ,'status', 'order', 'created_at', 'is_show_front', 'updated_at'];
}
