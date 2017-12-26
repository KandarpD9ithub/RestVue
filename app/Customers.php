<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
    	'name','email','mobile_number','gender','birth_date','is_active','created_by','updated_by',
    ];
}
