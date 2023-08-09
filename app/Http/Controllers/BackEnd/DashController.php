<?php

namespace App\Http\Controllers\BackEnd;

use App\User;
use App\Order;
use App\Slider;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\Statistical;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sp_count = Product::all()->count();
        $dh_count = Order::all()->count();
        $kh_count = User::all()->count();
        $dm_count = Category::all()->count();
        $sl_count = Slider::all()->count();

        $view_product = Product::where('product_status',1)->orderBy('product_view','desc')->limit(3)->get();
        $total_view_product = Product::where('product_status',1)->sum('product_view');

        // dd(Str::studly('xxx ttttt'));

        return view('Admin.dashboard', compact('sp_count','dh_count','kh_count','dm_count','sl_count','view_product','total_view_product'));
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
        $sub40ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(40)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date', [$sub40ngay,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        $data = json_encode($chart_data);
        echo $data;
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
