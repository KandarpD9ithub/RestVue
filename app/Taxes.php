<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxes extends Model
{
	use SoftDeletes;
    protected $fillable = [
    	'name','percentage','created_by','updated_by'
    ];

    protected $dats =['deleted_at'];
}
