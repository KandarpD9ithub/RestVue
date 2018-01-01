<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tables extends Model
{
     use SoftDeletes;
    
    protected $fillable = [ 'name','is_active' ];


    protected $dats =['deleted_at'];
}
