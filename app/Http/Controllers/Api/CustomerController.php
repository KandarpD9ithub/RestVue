<?php
/**
 * @package App/Http/Controller/Api
 *
 * @class CustomerController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customers;
use DB;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::get();
        return response()->json([
            'customers'    => $customers,
            'success'   => true,
        ], 200);
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
            //'email' => 'required|email|max:150',
            'mobile_number'=> 'required|max:10|min:10',
            //'country'   => 'required',
            //'gender'=> 'required',
            //'birth_date'=> 'required',
            'address'       => 'max:200',

        ]);
        try {
            DB::beginTransaction();
            /*if ($file = $request->hasFile('profile_picture')) {
                $file=$request->file('profile_picture');
                $file_name=$this->UploadProfilePicture($file);//call to function UploadProfilePicture to upload profile picture
                $request['profile_picture']=$file_name;
            }*/
            //$request['created_by'] = Auth::user()->id;
            $customer = Customers::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'customers'    => Customers::where('id',$customer->id)->first(),
            'message' => 'Success',
            'success' => true,
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
            //'email' => 'required|email|max:150',
            'mobile_number'=> 'required|max:10|min:10',
            //'country'   => 'required',
            //'gender'=> 'required',
            //'birth_date'=> 'required',
            'address'       => 'max:200',

        ]);

        try {
            DB::beginTransaction();
            //$request['updated_by'] = Auth::user()->id;
            $customer = Customers::where('id',$id)->update($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'customers'    => Customers::where('id',$id)->first(),
            'message' => 'Success',
            'success' => true,
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
                Customers::where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'Category deleted successfully!',
            'success' => true,
        ], 200);
    }
    /**
     * common function to upload profile image to upload folder
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UploadProfilePicture($file)
    {
        if($file != null){
            $destinationPath = public_path().'/upload'; // upload path
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $files=explode('.', $file->getClientOriginalName());
            $fileName = $files[0].time().'.'.$extension;
            $file->move($destinationPath,$fileName); // uploading file to given path
        return $fileName;
        }
    }
}
