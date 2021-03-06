<?php
/**
 * @package App/Http/Controller/Api
 *
 * @class CategoryController
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\Products;
use DB;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categories::all();
        return response()->json([
            'categories'    => $cat,
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
            'category' => 'required',
        ]);
        //$request['created_by'] = Auth::user()->id;
        try {
            DB::beginTransaction();
            //$request['created_by'] = Auth::user()->id;
            $category = Categories::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'categories'    => Categories::where('id',$category->id)->first(),
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
            'category' => 'required',
            'is_active' => '',
            'available' =>'',
        ]);
        try {
            DB::beginTransaction();
        //$request['created_by'] = Auth::user()->id;
            $category = Categories::where('id',$id)->update($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'categories'    => Categories::where('id',$id)->first(),
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
                Categories::where('id',$id)->delete();
                $subCategory = SubCategories::where('categories_id',$id)->get();
                foreach ($subCategory as $key => $value) {
                    $value->delete();
                }
                $product = Products::where('categories_id',$id)->get();
                foreach ($product as $keys => $values) {
                    $values->delete();
                }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'Task deleted successfully!',
            'success' => true,
        ], 200);
    }

    /**
     * get category list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryList()
    {
        $cat = [['id'=>'0','name'=>'Veg'],['id'=>'1','name'=>'NonVeg']];
       return response()->json([
            'categoryList' => $cat,
            'success' => true,
        ], 200);
    }
}
