<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    protected $primarykey = 'id';
    protected $fillable = ['id','question', 'answer' ,'status', 'order', 'created_at', 'updated_at'];
}
