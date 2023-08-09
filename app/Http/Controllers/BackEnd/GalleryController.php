<?php

namespace App\Http\Controllers\BackEnd;

use App\Gallery;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $gall = Gallery::find(request()->id);
            $output = '';
            $output .='<img class="d-block w-100" src="'.asset('uploads/gallery/'.$gall->gallery_image).'">';

            return response()->json([
                'data'=>$output
            ]);
        }
        $title = 'Photo Gallery';
        $photo = Gallery::all();
        return view('Admin.Photo_Gallery', compact('title','photo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if (request()->gall_id_array) {

                foreach (request()->gall_id_array as $key => $value) {
                    $sorting = Gallery::where('pro_id',request()->id_pro)->where('gallery_id',$value)->first();
                    $sorting->gallery_sorting = $key+1;
                    $sorting->save();
                }
            }
            $output = '';
            $gallery_show = Gallery::where('pro_id',$sorting->pro_id)->orderBy('gallery_sorting','asc')->get();
            foreach($gallery_show as $gal){
                $output .='
                <tr id="'.$gal->gallery_id.'">
                    <td>'.$gal->gallery_sorting.'</td>
                    <td class="col-6">
                        <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                        <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                    </td>
                    <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                    </button></td>
                </tr>
                ';
            }
            return response()->json([
                'data'=>$output,
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
        if($request->ajax()){

            foreach($request->file('file') as $image){
                $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(563, 563);
                $image_resize->save(public_path('uploads/gallery/' .$name));

                $gallery = new Gallery();
                $gallery->pro_id = $request->id;
                $gallery->gallery_image = $name;
                $gallery->gallery_sorting = count(Gallery::where('pro_id',$request->id)->get())+1;
                $gallery->save();
            }


            $output = '';
            $gallery_show = Gallery::where('pro_id',$request->id)->orderBy('gallery_sorting','asc')->get();
            foreach($gallery_show as $gal){
                $output .='
                <tr id="'.$gal->gallery_id.'">
                    <td>'.$gal->gallery_sorting.'</td>
                    <td class="col-6">
                        <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                        <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                    </td>
                    <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                    </button></td>
                </tr>
                ';
            }

            return response()->json([
                'data'=>$output,
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
    public function show($id, Request $request)
    {
        if($request->ajax()){
            $name = Product::find($id);
            $gallery = Gallery::where('pro_id',$id)->orderBy('gallery_sorting','asc')->get();
            $output = '';
            foreach($gallery as $gal){
                $output .='
                <tr id="'.$gal->gallery_id.'">
                    <td>'.$gal->gallery_sorting.'</td>
                    <td class="col-6">
                        <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                        <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                    </td>
                    <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                    </button></td>
                </tr>
                ';
            }

            return response()->json([
                'data'=>$output,
                'gall'=>$name
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
        if($request->ajax()){
            $gallery = Gallery::find($id);
            $image = $request->file('file');

            $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(563, 563);
            $image_resize->save(public_path('uploads/gallery/' .$name));
            unlink(public_path('uploads/gallery/').$gallery->gallery_image);
            $gallery->gallery_image = $name;
            $gallery->save();


            $output = '';
            $gallery_show = Gallery::where('pro_id',$gallery->pro_id)->orderBy('gallery_sorting','asc')->get();
            foreach($gallery_show as $gal){
                $output .='
                <tr id="'.$gal->gallery_id.'">
                    <td>'.$gal->gallery_sorting.'</td>
                    <td class="col-6">
                        <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                        <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                    </td>
                    <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                    </button></td>
                </tr>
                ';
            }

            return response()->json([
                'data'=>$output,
                'message'=>'Update Successfully'
            ]);
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
            $output = '';
            if(request()->action == 'One'){
                $one = Gallery::findOrfail(request()->id_gall);
                if($one){
                    unlink(public_path('uploads/gallery/').$one->gallery_image);
                    $one->delete();

                    $all = Gallery::where('pro_id',$one->pro_id)->orderBy('gallery_sorting','asc')->get();
                    foreach($all as $gal){
                        $output .='
                        <tr id="'.$gal->gallery_id.'">
                            <td>'.$gal->gallery_sorting.'</td>
                            <td class="col-6">
                                <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                                <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                            </td>
                            <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                            </button></td>
                        </tr>
                        ';
                    }

                    return response()->json([
                        'status'=>200,
                        'data'=>$output,
                        'message'=>'Delete Successfully'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Not Found'
                    ]);
                }
            }else{
                $all = Gallery::where('pro_id',$id)->get();
                if(count($all) > 0){
                    foreach($all as $al){
                        unlink(public_path('uploads/gallery/').$al->gallery_image);
                        $al->delete();
                        $id_all = $al->pro_id;
                    }
                    foreach(Gallery::where('pro_id',$id_all)->orderBy('gallery_sorting','asc')->get() as $gal){
                        $i++;
                        $output .='
                        <tr id="'.$gal->gallery_id.'">
                            <td>'.$i.'</td>
                            <td class="col-6">
                                <img src="'.url('uploads/gallery/'.$gal->gallery_image).'" width="90px" height="80px" class="img-thumbnail" />
                                <input type="file" class="file_image form-control mt-1" style="width: 61%;" name="file" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" accept="image/*" multiple="">
                            </td>
                            <td><button type="button" class="btn btn-outline-danger deletegal" data-id="'.$gal->pro_id.'" data-id_gall="'.$gal->gallery_id.'"><i class="fa fa-trash"></i>
                            </button></td>
                        </tr>
                        ';
                    }
                    return response()->json([
                        'status'=>200,
                        'data'=>$output,
                        'message'=>'Delete Successfully'
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Data Required'
                    ]);
                }
            }
        }
    }
}
