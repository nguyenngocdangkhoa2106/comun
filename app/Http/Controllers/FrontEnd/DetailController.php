<?php

namespace App\Http\Controllers\FrontEnd;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = request()->all();

            $query = $data['query'];

            $filter_data = Product::select('product_name')->where('product_name', 'LIKE', '%'.$query.'%')
                            ->get();

            $data = array();
            foreach ($filter_data as $fil)
                {
                    $data[] = $fil->product_name;
                }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail';
        $detail = Product::where('product_slug',$id)->orwhere('product_id',$id)->first();
        $detail->product_view = $detail->product_view + 1;
        $detail->save();

        $gallery = Gallery::where('pro_id',$detail->product_id)->orderBy('gallery_sorting','asc')->get();
        $product_like = Product::where('product_status',1)->where('category_id',$detail->category_id)->get();
        return view('User.detail', compact('title', 'detail','gallery','product_like'));
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
