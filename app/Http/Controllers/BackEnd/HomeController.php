<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use App\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use App\User;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Str::slug(request()->keyword);
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            if($request->action == 'category'){
                $sample = Category::findOrfail($request->id);
                if($sample){
                    if($request->statusss == 1){
                        $sample->category_status = 1;
                    }else{
                        $sample->category_status = 2;
                    }
                    $sample->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Change Status Successfully!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Not Found!'
                    ]);
                }
            }

            if($request->action == 'product'){
                $sample = Product::findOrfail($request->id);
                if($sample){
                    if($request->statusss == 1){
                        $sample->product_status = 1;
                    }else{
                        $sample->product_status = 2;
                    }
                    $sample->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Change Status Successfully!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Not Found!'
                    ]);
                }
            }

            if($request->action == 'coupon'){
                $sample = Coupon::findOrfail($request->id);
                if($sample){
                    if($request->statusss == 1){
                        $sample->coupon_status = 1;
                    }else{
                        $sample->coupon_status = 2;
                    }
                    $sample->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Change Status Successfully!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Not Found!'
                    ]);
                }
            }

            if($request->action == 'slider'){
                $sample = Slider::findOrfail($request->id);
                if($sample){
                    if($request->statusss == 1){
                        $sample->slider_status = 1;
                    }else{
                        $sample->slider_status = 2;
                    }
                    $sample->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Change Status Successfully!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Not Found!'
                    ]);
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
