<?php
/**
 * @package App/Http/Controller/Api
 *
 * @class FetchDataController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\User;
use App\Products;
use App\Customers;
use Auth;

class FetchDataController extends Controller
{
	/**
     * Display a listing of the All Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryList()
    {
    	try {
	    		$getCategoryList = Categories::where('is_active',1)->where('available',1)->get();

	    	return response()->json([
	    		'categoryList'	=> $getCategoryList,
	    		'success'			=> true,
	    	]);
    	} catch (\Exception $e) {
    		return response()->json(['error'=>'Internal server error.','success'=>false]);
    	}
    }
    /**
     * Display a listing of the All Sub-Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsubCategoryList()
    {
    	try {
	    	$subCategoryList = SubCategories::where('is_active',1)->where('available',1)->get();

	    	return response()->json([
	    		'subCategoryList'	=> $subCategoryList,
	    		'success'			=> true,
	    	]);
    	} catch (\Exception $e) {
    		return response()->json(['error'=>'Internal server error.','success'=>false]);
    	}
    }

    public function getTaxes()
    {
    	try {
	    	$subCategoryList = SubCategories::where('is_active',1)->where('available',1)->get();

	    	return response()->json([
	    		'taxes'	=> $subCategoryList,
	    		'success'			=> true,
	    	]);
    	} catch (\Exception $e) {
    		return response()->json(['error'=>'Internal server error.','success'=>false]);
    	}
    }
}
