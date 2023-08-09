<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Order;
use App\Coupon;
use App\Customer;
use App\InfoOrder;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
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
        $carts = Cart::where('user_id',Auth::id())->where('cart_status',1)->join('product','product.product_id','cart.pro_id')->get();
        if(count($carts) > 0 && Auth::user()){
            if($request->status == 1){
                $info_check = InfoOrder::where('user_id',Auth::id())->first();
                if(!$info_check){
                    $info = new InfoOrder();
                    $info->info_order_name =  'firstname='.$request->firstname.'&lastname='.$request->lastname;
                    $info->info_order_email = $request->email;
                    $info->info_order_phone = $request->phone;
                    $info->info_order_address = $request->address;
                    $info->user_id = Auth::id();
                    $info->save();
                }else{
                    $info_check->info_order_name = 'firstname='.$request->firstname.'&lastname='.$request->lastname;
                    $info_check->info_order_email = $request->email;
                    $info_check->info_order_phone = $request->phone;
                    $info_check->info_order_address = $request->address;
                    $info_check->user_id = Auth::id();
                    $info_check->save();
                }
            }
            $checkout_code = mt_rand();
            $customer = new Customer();
            $customer->customer_name = $request->firstname.' '.$request->lastname;
            $customer->customer_email = $request->email;
            $customer->customer_address = $request->address;
            $customer->customer_phone = $request->phone;
            $customer->customer_note = $request->note;
            if($request->pay == 2){

                $customer->customer_pay = 'COD';

            }else{
                $customer->customer_pay = 'ATM';
            }
            $customer->save();

            $order = new Order();
            $order->cus_id = $customer->customer_id;
            $order->order_code = $checkout_code;
            $order->order_status = 1;
            $order->save();

            foreach($carts as $cart){
                $order_detail = new OrderDetail();
                $order_detail->order_code = $checkout_code;
                $order_detail->pro_id  = $cart->pro_id;
                $order_detail->order_de_qty  = $cart->cart_qty;
                if($cart->product_price_sale != 0){
                    $order_detail->order_de_price  = $cart->product_price_sale;
                }else{
                    $order_detail->order_de_price  = $cart->product_price;
                }
                if(Session::get('coupon')){
                    foreach(Session::get('coupon') as $coun){
                        $order_detail->order_de_coupon  = $coun['coupon_code'];
                        $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                        $coupon_qty->coupon_used = ','.Auth::id();
                        $coupon_qty->coupon_qty--;
                        $coupon_qty->save();
                    }
                }else{
                    $order_detail->order_de_coupon  = 'no';
                }
                $order_detail->save();

                $status = Cart::where('cart_id',$cart->cart_id)->first();
                $status->cart_status = 2;
                $status->save();
            }
            Session::forget('coupon');

            return response()->json([
                'status'=>200,
                'url'=>route('home.index'),
                'message'=>'Order Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'url'=>route('home.index'),
                'message'=>'Empty Shopping Cart!'
            ]);
        }

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
