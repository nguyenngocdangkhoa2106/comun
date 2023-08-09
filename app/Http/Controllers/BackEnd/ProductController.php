<?php

namespace App\Http\Controllers\BackEnd;

use App\Gallery;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Product::join('category','category.category_id','product.category_id')->orderBy('product_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->product_id.'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->product_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->addColumn('price_td', function($data){
                    if ($data->product_price_sale > 0) {
                        $price = '<span class="text-info"><b>'.number_format($data->product_price_sale).'</b></span>';
                    }else{
                        $price = '<span>'.number_format($data->product_price).'</span>';
                    }
                    return $price;
                })
                ->addColumn('image', function($data){
                    return '<img src="'.url('uploads/product/'.$data->product_image).'" width="80px" height="80px" class="img-thumbnail" />';
                })
                ->addColumn('gallery_td', function($data){
                    $gallery = Gallery::where('pro_id',$data->product_id)->get()->count();
                    if ($gallery > 5) {
                        $gall = '<a href="'.route('gallery.show',[$data->product_id]).'" class="badge bg-success click_gallery">Gallery ('.$gallery.')</a>';
                    }else if ($gallery >= 1 && $gallery <= 5) {
                        $gall = '<a href="'.route('gallery.show',[$data->product_id]).'" class="badge bg-warning click_gallery">Gallery ('.$gallery.')</a>';
                    }else{
                        $gall = '<a href="'.route('gallery.show',[$data->product_id]).'" class="badge bg-danger click_gallery">Gallery ('.$gallery.')</a>';
                    }
                    return $gall;
                })
                ->rawColumns(['action','price_td','image','gallery_td'])
                ->make(true);
        }
        $title = 'Product';
        $category = Category::where('category_status',1)->get();
        return view('Admin.M_product', compact('category','title'));
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
        if(request()->ajax()){
            $product = new Product();
            $product->product_name = $request->pro_name;
            $product->product_slug = $request->pro_slug;
            $product->category_id  = $request->pro_cate;
            $product->product_desc = $request->pro_desc;
            $product->product_info = $request->pro_info;
            $product->product_price = $request->pro_price;
            $product->product_price_sale = $request->pro_price_sale;
            $product->product_quantity = $request->pro_qty;
            $product->product_view = 0;
            $product->product_sold = 0;
            $product->product_status = $request->pro_status;
            $product->product_size = $request->pro_size;
            $product->product_color = $request->pro_color;

            if ($request->file('pro_image')) {
                $image = $request->file('pro_image');
                $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(563, 563);
                $image_resize->save(public_path('uploads/product/' .$name));

                $product->product_image = $name;
            }

            $product->save();

            return response()->json([
                'status'=>200,
                'message'=>'Add Successfully'
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
        $sample = Product::findOrfail($id);
        if($sample){
            $size = explode(',',$sample->product_size);
            $color = explode(',',$sample->product_color);
            return response()->json([
                'status'=>200,
                'data'=>$sample,
                'size'=>$size,
                'color'=>$color
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
            ]);
        }
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
            $product = Product::findOrfail($id);
            if($product){
                $product->product_name = $request->pro_name;
                $product->product_slug = $request->pro_slug;
                $product->category_id  = $request->pro_cate;
                $product->product_desc = $request->pro_desc;
                $product->product_info = $request->pro_info;
                $product->product_price = $request->pro_price;
                $product->product_price_sale = $request->pro_price_sale;
                $product->product_quantity = $request->pro_qty;
                $product->product_status = $request->pro_status;
                $product->product_size = $request->pro_size;
                $product->product_color = $request->pro_color;

                if ($request->file('pro_image')) {
                    unlink(public_path('uploads/product/').$product->product_image);
                    $image = $request->file('pro_image');
                    $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(325.8, 325.8);
                    $image_resize->save(public_path('uploads/product/' .$name));

                    $product->product_image = $name;
                }

                $product->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Add Successfully'
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
        $sample = Product::findOrfail($id);
        if($sample){
            unlink(public_path('uploads/product/').$sample->product_image);
            $sample->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
            ]);
        }
    }
}
