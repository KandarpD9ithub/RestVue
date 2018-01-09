<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Categories;
use App\SubCategories;
use App\Taxes;
use DB;
use Auth;
use Image;
use Input;

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
            'image'             => '',
            'description'       => 'required|max:200',
            'is_active'         => 'required',
            'time_duration'     => 'required',
        ]);

        try {
            DB::beginTransaction();
            $file = $request->get('image');
            $name_prefix="product_";
            $product_image=$this->UploadImagePath($file,$name_prefix);//upload image in folder
            $request['image'] = $product_image;
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
    public function UploadImagePath($file,$name_prefix)
    {
      /*
        desc    : upload image in the folder
        dev. name  : Pandya Kandarp
        date    : 26-02-2017
        update date  :
        update desc  :
      */
          $data = Image::make($file);//make image 
          $fileName = $name_prefix.time().".jpg"; // renameing image
          $path = public_path().'/upload/'. $fileName;//path
          $data->save($path);//save images
          return $fileName;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::where('id',$id)->first();
        
            $tax= Taxes::where('id',$products->tax_id)->first();
            if (count($tax) > 0) {
              $products->tax_id = $tax->percentage;
            }else{
              $products->tax_id = 0;
            }
        $products->quantity = 1;
        return response()->json([
                'products'   => $products,
                'success'           => true,
            ]);
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
            'image'             => '',
            'description'       => 'required|max:200',
            'is_active'         => 'required',
            'time_duration'     => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            $file = $request->get('image');
            if($file!=null){
              $name_prefix="product_";
              $product_image=$this->UploadImagePath($file,$name_prefix);//upload image in folder
              $prod['image'] = $product_image;
            }
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
    /**
     * get product list with category and subcategory.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
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

    /**
     * search product by name.
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {

        $query = $request->get('query');
        $product = Products::where('name','like','%'.$query.'%')->get();
        foreach ($product as $key => $value) {
            $tax= DB::table('taxes')->where('id',$value->tax_id)->first();
            if (count($tax) > 0) {
              $value->tax_id = $tax->percentage;
            }else{
              $value->tax_id = 0;
            }
        }
        return response()->json($product);
    }

    /**
     * Get product by subcategory .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subProductList($id)
    {
        $product = Products::where('sub_categories_id',$id)->where('is_active',1)->get();
        return response()->json([
            'success' => true,
            'subProductList' => $product,
        ]);
    }

    /**
     * Get product by category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function catProductList($id)
    {
        $product = Products::where('categories_id',$id)->where('is_active',1)->get();
        return response()->json([
            'success' => true,
            'catProductList' => $product,
        ]);
    }

    /**
     * check product is exist in array.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkProductExist(Request $request)
    { 
        return [count($request->get('products')),$request->get('products')];
    }
}
