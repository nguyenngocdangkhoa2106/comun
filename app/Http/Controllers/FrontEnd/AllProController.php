<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class AllProController extends Controller
{
    public function __construct()
    {
        $this->page = 6;
        $this->pageSearch = 30;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Product';
        $action = 'All';
        $id_cate_hidden = '';
        $sample = Product::where('product_status',1)->paginate($this->page);
        return view('User.all_product', compact('title','sample','action','id_cate_hidden'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if(request()->action == 'All'){
                $sample = Product::where('product_status',1)->paginate($this->page);
            }else{
                $sample = Product::where('category_id',request()->id)->where('product_status',1)->paginate($this->page);
            }
            return view('User.include_all', compact('sample'))->render();
        }
        $data = request()->txt_search;
        $select = $this->pageSearch;
        $action = 'Search';
        $title = 'Search: "'.$data.'"';
        $id_cate_hidden = '';
        $sample = Product::where('product_status',1)->where('product_name','LIKE','%'.$data.'%')
                                    ->orWhere('product_price','LIKE','%'.$data.'%')
                                    ->orWhere('product_price_sale','LIKE','%'.$data.'%')
                                    ->take($select)->paginate($select);

        return view('User.all_product',compact('sample','action','title','select','id_cate_hidden'));
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
        $cateDetail = Category::where('category_slug',$id)->orwhere('category_id',$id)->first();
        $id_cate_hidden = $cateDetail->category_id;
        $title = $cateDetail->category_name;
        $action = 'Category';
        $sample = Product::where('category_id',$cateDetail->category_id)->where('product_status',1)->paginate($this->page);
        return view('User.all_product', compact('title','sample','action','id_cate_hidden'));
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
