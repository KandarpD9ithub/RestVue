<?php
/**
 * @package App
 *
 * @class SubCategories
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubCategories extends Model
{
  use SoftDeletes;
   protected $fillable = [
   		'name','categories_id','available','is_active','created_by','updated_by',
   ];

   public function product()
   {
   		return $this->hasMany(Products::class);
   }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    protected $dats =['deleted_at'];
}
