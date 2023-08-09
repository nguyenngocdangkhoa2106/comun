<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Coupon;
use App\Slider;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startmonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $endmonth = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();
        $product_new = Product::where('product_status',1)->whereBetween('created_at',[$startmonth,$endmonth])->orderByRaw("RAND()")->limit(8)->get();
        $product_fea = Product::where('product_status',1)->orderByRaw("RAND()")->limit(8)->get();
        $slider = Slider::where('slider_status',1)->get();
        $category = Category::where('category_status',1)->orderByRaw("RAND()")->limit(8)->get();
        return view('User.index', compact('slider','category','product_fea','product_new'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            $output = '';
            $count = Cart::where('user_id',Auth::id())->where('cart_status',1)->get()->count();
            if(Auth::check()){
                $output .=''.$count.'';
            }else{
                $output .='0';
            }

            return response()->json($output);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $today_d =  Carbon::now('Asia/Ho_Chi_Minh')->format('d');
            $today_m =  Carbon::now('Asia/Ho_Chi_Minh')->format('m');
            $today_y =  Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
            if (Auth::user()) {
                $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                if ($date_coupon) {
                    $create = date_create($date_coupon->coupon_date_end);
                    $day = date_format($create,'d');
                    $month = date_format($create,'m');
                    $year = date_format($create,'Y');

                    if ($month > $today_m && $year >= $today_y) {
                        $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
                    }else if($month == $today_m && $year == $today_y){
                        if ($day >= $today_d) {
                            $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
                        }else{
                            return response()->json(['error'=>'The discount code is incorrect or has expired']);
                        }
                    }else{
                        return response()->json(['error'=>'The discount code is incorrect or has expired']);
                    }



                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }
            }else{
                return response()->json([
                    'url'=>route('login.index'),
                    'error_login'=>'Please login to use discount code!'
                ]);
            }

            if ($used_coupon) {
                return response()->json(['error'=>'Discount code already used, please enter another code']);
            }else{
                $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                $create_date = date_create($date_coupon->coupon_date_end);
                $day = date_format($create_date,'d');
                $month = date_format($create_date,'m');
                $year = date_format($create_date,'Y');
                if ($month > $today_m && $year >= $today_y) {
                    $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                }else if($month == $today_m && $year == $today_y){
                    if ($day >= $today_d) {
                        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                    }else{
                        return response()->json(['error'=>'The discount code is incorrect or has expired']);
                    }
                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }

                if ($coupon) {
                    $coupon_count = $coupon->count();
                    if ($coupon_count>0) {
                        $coupon_session = Session::get('coupon');
                        if ($coupon_session==true) {
                            $is_avaiable = 0;
                            if ($is_avaiable==0) {
                                $coun[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_sale_number,
                                );
                                Session::put('coupon',$coun);
                            }
                        }else{
                            $coun[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_sale_number,
                                );
                            Session::put('coupon',$coun);
                        }
                        Session::save();

                        return response()->json(['message'=>'Add Coupon Successfully']);

                    }
                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }
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
