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
use Hash;
use DB;

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
    public function getsubCategoryList($cid)
    {
    	try {
	    	$subCategoryList = SubCategories::where('is_active',1)->where('available',1)->where('categories_id',$cid)->get();

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
    public function Login(Request $request)
    {
        $data=$request->validate([
            'email' => 'required',
            'password'  => 'required'
        ]);
        $user = DB::table('users')->where('email',$request->get('email'))->where('is_active','1')->first();
        if($user != null){
                if(!Hash::check($request->get('password'),$user->password)){
                    return response()->json([
                        'success'=> false,
                        'message'=> 'Password is wrong!.',
                        'data'   => [],
                    ]);        
                }
        }else{
            return response()->json([
                        'success'=> false,
                        'message'=> 'Username not found!.',
                        'data'   => [],
                    ]);        
        }
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            return response()->json([
                        'success'=> true,
                        'message'=> 'Login sucessfully!.',
                        'data'   => $user,
                        'auth_id'=> Auth::user()->id,
                    ]);        
        }else{
            return response()->json([
                        'success'=> false,
                        'message'=> 'something wrong!.',
                        'data'   => [],
                    ]);     
        }

    }
}
