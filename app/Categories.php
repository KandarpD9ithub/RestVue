<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
    	'name','category','is_active','available','created_by','updated_by',
    ];
}
