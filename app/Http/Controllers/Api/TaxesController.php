<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Taxes;
use DB;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tax = Taxes::all();

        return response()->json([
            'sucess'    => true,
            'tax'       => $tax,
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
            'name'                   => 'required|max:100',
            'percentage'             => 'required|max:100',
        ]);

        try {
            DB::beginTransaction();
            $tax = Taxes::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'tax'    => Taxes::where('id',$tax->id)->first(),
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
            'name'                   => 'required|max:100',
            'percentage'             => 'required|max:100',
            'is_ctive'              => '',
        ]);

        try {
            DB::beginTransaction();
            $tax = Taxes::where('id',$id)->update($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'tax'    => Taxes::where('id',$id)->first(),
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
                Taxes::where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'Internal server error.','success'=>false]);
        }
        return response()->json([
            'message' => 'Tax deleted successfully!',
            'success' => true,
        ], 200);
    }
}
