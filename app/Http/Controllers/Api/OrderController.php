<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
use App\OrderDetails;
use App\Customers;
use DB;
use Auth;
use App\Taxes;
use App\User;
use Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            DB::beginTransaction();
            $did = Auth::loginUsingId($request->get('auth_id'), true);
            $order = Orders::create([
                        'customer_id'   => $request->get('customer_id'),
                        'order_number'  => (new Orders())->getNewOrderNumber(),
                        'payment_method' => 1,
                        'order_taken_by' => Auth::user()->id,
                        'transaction_id' => '111',
                        'created_at'    => date('Y-m-d H:i:s'),
                        'cash_given' => 0,
                        'sub_total' => $request->get('sub_total'),
                        'discount' => $request->get('discount'),
                        'tax_collected' => $request->get('tax'),
                        'grand_total' => $request->get('grand_total'),
                        'ordered_at'  =>  date('Y-m-d H:i:s'),
                        'table_id'   =>   null,
                        'paytm_mobile' => Customers::find($request->get('customer_id'))->first()->mobile_number,
                        'card_number' => null,
                        'parcel'    => ($request->get('parcel') != null)?$request->get('parcel'):0,
                    ]);
                foreach ($request->get('products') as $key => $value) {
                    
                    $orderDetails[] = OrderDetails::create([
                        'product_id' => $value['id'],
                        'order_id'   => $order->id,
                        'quantity'   => $value['quantity'],
                        'sub_total'  => $value['price'] * $value['quantity'],
                        'discount' => 0,
                        'offer' => '',
                        'tax_collected' => $request->get('tax'),
                        'grand_total' => $request->get('grand_total'),
                    ]);
                }

            DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
                return response()->json(['error' => $e->getMessage(),'success' => false]);
        }

        return response()->json([
            'success' => true,
            'message'   => 'Order created successfully.!',
            'orderDetails'  => Orders::where('id',$order->id)->first(),
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
