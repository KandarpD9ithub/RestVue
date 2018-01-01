<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SubCategories;
use App\Categories;

class Products extends Model
{
    use SoftDeletes;
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

    protected $dats =['deleted_at'];
}
