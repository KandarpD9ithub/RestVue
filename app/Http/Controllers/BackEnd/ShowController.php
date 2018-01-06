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
use DB;
use Auth;
use Hash;
use App\User;

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
    /**
     * Display a Category listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubCategories()
    {
        return view('restaurant.sub_category');
    }

    /**
     * store data to the user table.
     *
     * @return \Illuminate\Http\Response
     */

    function Register(Request $request)
    {
        
        $request->validate([
                'name'      => 'required',
                'email'     => 'required:email|unique:users,email',
                'country'   => 'required',
                'password'  => 'required',
                'confirm_password'  => 'required|same:password',
                'tnc'       => 'required',
        ]);
        try {
            DB::beginTransaction();
            $request['password'] = Hash::make($request->get(''));
            $user = User::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
    }

    /**
     * check the user and login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Login(Request $request)
    {
        $data=$request->validate([
            'email' => 'required',
            'password'  => 'required'
        ]);
        $user = DB::table('users')->where('email',$request->get('email'))->where('is_active','1')->first();
        if($user != null){
                if(!Hash::check($request->get('password'),$user->password)){
                    return redirect()->back()->withErrors('Password is wrong!.');        
                }
        }else{
            return redirect()->back()->withErrors('Username not found!.');
        }
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            return redirect()->to('home');
        }else{
            return redirect()->back()->withErrors('something wrong');
        }
    }
    /**
     * show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $country = [1=>'india'];
        return view('users.login',compact('country'));
    }

    /**
     * get product form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProducts()
    {
        return view('restaurant.product');
    }

    /**
     * get product form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTaxRules()
    {
        return view('restaurant.tax_rule');
    }

    /**
     * get discount form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDiscounts()
    {
        return view('restaurant.discount');
    }

    /**
     * get tables form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTables()
    {
        return view('restaurant.tables');
    }

    /**
     * get role management form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoleManagement()
    {
        return view('restaurant.role_management');
    }

    /**
     * get Order form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOrder()
    {
        return view('restaurant.order');
    }

}
