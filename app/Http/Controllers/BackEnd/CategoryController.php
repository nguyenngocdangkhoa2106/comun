<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Category::orderBy('category_sorting','asc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->category_id.'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->category_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Category';
        return view('Admin.M_Category', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(request()->ajax()){
            if ($request->category_id_array) {

                foreach ($request->category_id_array as $key => $value) {
                    $sorting = Category::findOrfail($value);
                    $sorting->category_sorting = $key+1;
                    $sorting->save();
                }
            }
            return response()->json([
                'message' => 'Sorting Successfully !'
            ]);
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
        if(request()->ajax()){
            $category = new Category();
            $category->category_name = $request->cate_name;
            $category->category_slug  = $request->cate_slug;
            $category->category_status = $request->cate_status;
            $category->category_sorting = count(Category::all())+1;

            if ($request->file('category_image')) {
                $image = $request->file('category_image');
                $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(100, 100);
                $image_resize->save(public_path('uploads/category/' .$name));
                // $image->move(public_path('uploads/category'),$name);
                $category->category_image = $name;
            }

            $category->save();

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
        $sample = Category::findOrfail($id);
        if($sample){
            return response()->json([
                'status'=>200,
                'data'=>$sample
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
            $category = Category::findOrfail($id);
            if($category){
                $category->category_name = $request->cate_name;
                $category->category_slug  = $request->cate_slug;
                $category->category_status = $request->cate_status;

                if ($request->file('category_image')) {
                    unlink(public_path('uploads/category/').$category->category_image);
                    $image = $request->file('category_image');
                    $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(100, 100);
                    $image_resize->save(public_path('uploads/category/' .$name));
                    // $image->move(public_path('uploads/category'),$name);
                    $category->category_image = $name;
                }
                $category->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Update Successfully'
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
        $sample = Category::findOrfail($id);
        if($sample){
            unlink(public_path('uploads/category/').$sample->category_image);
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
