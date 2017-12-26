<?php
/**
 * @package App/Http/Controllers\BackEnd
 *
 * @class ShowController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 * @copyright 2018 D9ithub All rights reserved.
 */

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomer()
    {
    	if (view()->exists('restaurant.customers.index')) {
    			return view('restaurant.customers.index');
		}else{
			return redirect()->back()->withErrors('View not Exists');
		}
    	
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers($value='')
    {
    	if (view()->exists('restaurant.users.userIndex')) {
    			return view('restaurant.users.userIndex');
		}else{
			return redirect()->back()->withErrors('View not Exists');
		}
    }
    /**
     * Display a Category listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCategory()
    {
        return view('restaurant.category');
    }

    public function showSubCategories()
    {
        return view('restaurant.sub_category');
    }
}
