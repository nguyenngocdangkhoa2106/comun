<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\InfoOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $output = '';
            $output_2 = '';
            $total = 0;
            $subtotal = 0;
            $carts= Cart::join('product','product.product_id','cart.pro_id')
                        ->where('user_id',Auth::id())
                        ->where('cart_status',1)
                        ->get();
            $count = Cart::where('user_id',Auth::id())->where('cart_status',1)->get()->count();
            foreach($carts as $cart){
                if($cart->product_price_sale != 0){
                    $price = $cart->product_price_sale;
                }else{
                    $price = $cart->product_price;
                }
                $subtotal += ($cart->cart_qty)*($price);
                $output .='
                <tr>
                    <td class="align-middle"><img src="'. asset('uploads/product/'.$cart->product_image) .'" alt=""
                            style="width: 50px;"> '.$cart->product_name.'</td>';
                    if($cart->product_price_sale != 0){
                        $output .='<td class="align-middle">'.number_format($cart->product_price_sale).' vnđ</td>';
                    }else{
                        $output .='<td class="align-middle">'.number_format($cart->product_price).' vnđ</td>';
                    }
                    $output .='
                    <td class="align-middle">
                        <div class="input-group quantity mx-auto" style="width: 100px;">
                            <input type="number"
                                class="form-control form-control-sm bg-secondary border-0 text-center up_qty" data-id="'.$cart->cart_id.'" value="'.$cart->cart_qty.'" min="1" max="100" oninput="this.value = Math.abs(this.value)">
                        </div>
                    </td>
                    <td class="align-middle">'.number_format(($cart->cart_qty)*($price)).' vnđ</td>
                    <td class="align-middle"><button class="btn btn-sm btn-danger removecart" data-id="'.$cart->cart_id.'"><i
                                class="fa fa-times"></i></button></td>
                </tr>
                ';
            }
            if($count <= 0){
                Session::forget('coupon');
                $total = 0;
            }
            if(Session::get('coupon')){
                foreach(Session::get('coupon') as $coupon){
                    if($coupon['coupon_condition'] == 2){
                        $show_number = $coupon['coupon_number'].'%';
                        $subcoupon = $subtotal*$coupon['coupon_number']/100;
                        $total += $subtotal - $subcoupon;
                    }else{
                        $show_number = number_format($coupon['coupon_number']).' '.'vnđ';
                        $total += $subtotal - $coupon['coupon_number'];
                    }
                }
            }else{
                $show_number = '0 vnđ';
                $total += $subtotal;
            }
            Session::put('total',$total);
            $output_2 .= '
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>'.number_format($subtotal).' vnđ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Discount</h6>
                        <h6 class="font-weight-medium">'.$show_number.'</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>'.number_format($total).' vnđ</h5>
                    </div>';
                    if(Auth::check() && $count > 0){
                        if($count > 0){
                            $output_2 .= '<button class="btn btn-block btn-primary font-weight-bold my-3 py-3 clickCheckOut" data-href="'.route('cart.create').'">Proceed To Checkout</button>';
                        }else{
                            $output_2 .= '<button disabled class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>';
                        }
                    }else{
                        $output_2 .= '<button class="btn btn-block btn-primary font-weight-bold my-3 py-3 clickCheckOut" data-href="'.route('sign.index').'">Proceed To Checkout</button>';
                    }
                    $output_2 .= '
                </div>
            ';
            return response()->json([
                'cart'=>$output,
                'total'=>$output_2
            ]);
        }
        $title = 'Shopping Cart';
        return view('User.Cart.shopping_cart', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Checkout';
        $carts = Cart::where('user_id',Auth::id())->where('cart_status',1)->join('product','product_id','cart.pro_id')->get();
        $info = InfoOrder::where('user_id',Auth::id())->first();
        $view = 'User.Cart.checkout';

        return view($view , compact('title','carts','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->ajax()){
            if(Auth::check()){
                $check_cart = Cart::where('user_id',Auth::id())->where('pro_id',$request->id)->where('cart_status',1)->first();
                if ($check_cart) {
                    $check_cart->cart_qty = $check_cart->cart_qty+$request->qty;
                    $check_cart->save();

                    return response()->json([
                        'action'=>'update',
                        'message'=>'Update Cart Successfully!'
                    ]);
                }else{
                    $cart = new Cart();
                    $cart->user_id = Auth::id();
                    $cart->pro_id = $request->id;
                    $cart->cart_qty = $request->qty;
                    $cart->cart_status = 1;
                    $cart->save();

                    return response()->json([
                        'action'=>'add',
                        'message'=>'Add Cart Successfully!'
                    ]);
                }
            }else{
                return response()->json([
                    'action'=>'login',
                    'url'=>route('sign.index')
                ]);
            }
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
        if(request()->ajax()){
            $cart = Cart::findOrfail($id);
            if($cart){
                $cart->cart_qty = $request->qty;
                $cart->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Update Successfully!'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Data Not Found'
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->ajax()){
            $cart = Cart::findOrfail($id);
            if($cart){
                $cart->delete();

                return response()->json([
                    'status'=>200
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Data Not Found'
                ]);
            }

        }
    }
}
