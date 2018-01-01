<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Categories;
use App\SubCategories;
use DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        return response()->json([
                'products'   => $products,
                'success'           => true,
            ]);
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
            
            'name'              => 'required|max:100',
            'price'             => 'required|max:10000|numeric',
            'categories_id'       => 'required',
            'sub_categories_id'   => 'required',
            'tax_id'            => 'required',
            'available'         => 'required',
            'image'             => 'required',
            'description'       => 'required|max:200',
            'is_active'         => 'required',
            'time_duration'     => 'required',
        ]);

        try {
            DB::beginTransaction();
            $product = Products::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'products'    => Products::where('id',$product->id)->first(),
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
        $prod = $request->validate([
            
            'name'              => 'required|max:100',
            'price'             => 'required|max:10000|numeric',
            'categories_id'       => 'required',
            'sub_categories_id'   => 'required',
            'tax_id'            => 'required',
            'available'         => 'required',
            'image'             => 'required',
            'description'       => 'required|max:200',
            'is_active'         => 'required',
            'time_duration'     => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            $product = Products::where('id',$id)->update($prod);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'product'    => Products::where('id',$id)->first(),
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
                Products::where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'Product deleted successfully!',
            'success' => true,
        ], 200);
    }

    public function productList()
    {
        $productAll = [];
        $porduct = [];
        $category = [];
        $subcategory = [];
        $aq = Categories::all();
        foreach ($aq as $key => $value) {
            foreach ($value->sub_category as $keys => $values) {
                $sub_category[] = $values;
                foreach ($values->product as $productKey => $productValue) {
                    $product[] = $productValue;
                    //$product['sub_category']['products'][] = $productValue;
                }
            }
            $productAll['category'][] = $value;
            //$productAll['category']['sub_category']['product'] = $product;
        }
        /*foreach ($productAll as $Pkey => $Pvalue) {
            foreach ($Pvalue as $key => $value) {
                $value->available = $value->available==1 ? 'yes' : 'no';
                $value->is_active = $value->is_active==1 ? 'Active' : 'Inactive';
                foreach ($value['sub_category'] as $keya => $valuea) {
                    $valuea->available = $value->available==1 ? 'yes' : 'no';
                    $valuea->is_active = $value->is_active==1 ? 'Active' : 'Inactive';
                    dd($valuea);
                }
            }
        }*/
            return response()->json([
                'success'   => true,
                'productList'  => $productAll,
            ], 200);
    }
}
