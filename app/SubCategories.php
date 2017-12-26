<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
   protected $fillable = [
   		'name','parant_category','available','is_active','created_by','updated_by',
   ];
}
