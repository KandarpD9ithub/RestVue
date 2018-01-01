<?php
/**
 * @package App
 *
 * @class Discounts
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discounts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [ 'name','description','type','minimum_amount','value','start_date','end_date','is_active','created_by','updated_by' ];


    protected $dats =['deleted_at'];
}
