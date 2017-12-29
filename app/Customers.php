<?php
/**
 * @package App
 *
 * @class Customers
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
    	'name','email','mobile_number','gender','birth_date','is_active','country','created_by','updated_by','country','address'
    ];
}
