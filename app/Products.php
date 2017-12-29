<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategories;
use App\Categories;

class Products extends Model
{
    protected $fillable = [
    	'name','price','categories_id','sub_categories_id','tax_id','available','image','description','is_active','time_duration','created_by','updated_by'
    ];

    public function sub_category()
    {
    	return $this->belongsTo(SubCategories::class,'id','sub_categories_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
