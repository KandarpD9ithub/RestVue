<?php
/**
 * @package App
 *
 * @class Categories
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategories;

class Categories extends Model
{
    protected $fillable = [
    	'name','category','is_active','available','created_by','updated_by',
    ];

    public function sub_category()
    {
    	return $this->hasMany(SubCategories::class);
    }
}
