<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    protected $fillable = [
    	'name','percentage','created_by','updated_by'
    ];
}
