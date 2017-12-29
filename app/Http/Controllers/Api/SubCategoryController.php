<?php
/**
 * @package App/Http/Controller/Api
 *
 * @class SubCategoryController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\SubCategories;
use App\Categories;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategories::all();
        return response()->json([
            'subCategories'=>$subCategories,
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
            'name'        => 'required|max:100',
            'categories_id' => 'required',
        ]);
        //$request['created_by'] = Auth::user()->id;
        try {
            DB::beginTransaction();
            //$request['created_by'] = Auth::user()->id;
            $category = SubCategories::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'categories'    => SubCategories::where('id',$category->id)->first(),
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
            'name'        => 'required|max:100',
            'categories_id' => 'required',
            'is_active' => '',
            'available' =>'',
        ]);
        try {
            DB::beginTransaction();
        //$request['created_by'] = Auth::user()->id;
            $category = SubCategories::where('id',$id)->update($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'categories'    => SubCategories::where('id',$id)->first(),
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
                SubCategories::where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'Sub-Category deleted successfully!',
            'success' => true,
        ], 200);
    }

    /**
     * Display a listing of the resource from category controller.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory()
    {
        $Categories = Categories::where('is_active',1)->get();
        return response()->json([
            'categories'=>$Categories,
            'success'   => true,
        ], 200);
    }
}
