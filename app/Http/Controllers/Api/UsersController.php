<?php
/**
 * @package App/Http/Controller/Api
 *
 * @class UsersController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::get();
            return response()->json([
                'users'    => $users,
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:100|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|max:150|email|unique:users,email',
            'mobile'=> 'required|max:10|min:10',
            'country'   => 'required',
            'role_name' => 'required',

        ]);

        try {
            DB::beginTransaction();
            $request['password'] = Hash::make('123456');
            $user = User::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'users'    => User::where('id',$user->id)->first(),
            'message' => 'Success',
            'success'   => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $req = $request->validate([
            'name'        => 'required|max:100|regex:/^[a-zA-Z\s]*$/',
            'email' => 'max:150|email|unique:users,email,'.$id,
            'mobile'=> 'required|max:10|min:10',
            'role_name' => 'required',

        ]);
        try {
            DB::beginTransaction();
            User::where('id',$id)->update($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'users'    => User::all(),
            'message' => 'Success',
            'success'   => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();       
                User::where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'User deleted successfully!',
            'success'   => true,
        ], 200);
    }

    /**
     * get roles
     *
     * @param  
     * @return \Illuminate\Http\Response
     */

    public function getRles()
    {
        try {
            $roles = [['key'=>1,'value'=>'Admin'],['key'=>2,'value'=>'Accountant'],['key'=>3,'value'=>'Cashier'],['key'=>4,'value'=>'Store Manager'],['key'=>5,'value'=>'Chef']];
            return response()->json([
                'roles'    => $roles,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
    }

    /**
     * get countries from database
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function getCountry()
    {
       try {
            $country = DB::table('country')->get();
            return response()->json([
                'sucess'    => true,
                'country'    => $country,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
    }
}
