<?php

namespace App\Http\Controllers\FrontEnd;

use App\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
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

            if(Auth::check()){
                $wishlist = Wishlist::where('user_id',Auth::id())->get();
                $output .=''.count($wishlist).'';

                return response()->json([
                    'status'=>200,
                    'data'=>$output,
                    'wish'=>$wishlist
                ]);
            }else{
                $output .='0';

                return response()->json([
                    'status'=>404,
                    'data'=>$output
                ]);
            }
        }
        $title = 'Wishlist';
        return view('User.wishlist', compact('title'));
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
            if(Auth::check()){
                $wishlist = Wishlist::where('user_id',Auth::id())->join('product','product.product_id','wishlist.pro_id')->get();
                foreach($wishlist as $wish){
                    $output .='
                        <tr>
                            <td class="align-middle"><button class="btn btn-sm btn-danger removewish" data-id="'.$wish->wishlist_id.'"><i
                                        class="fa fa-times"></i></button></td>
                            <td class="align-middle"><img src="'. asset('uploads/product/'.$wish->product_image) .'" alt=""
                                    style="width: 50px;"> '.$wish->product_name.'</td>';
                            if($wish->product_price_sale != 0){
                                $output .='<td class="align-middle">'.number_format($wish->product_price_sale).' vnđ</td>';
                            }else{
                                $output .='<td class="align-middle">'.number_format($wish->product_price).' vnđ</td>';
                            }
                            $output .='
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input type="number" id="hidden_qtypro'. $wish->pro_id .'"
                                        class="form-control form-control-sm bg-secondary border-0 text-center" value="1" min="1" max="100" oninput="this.value = Math.abs(this.value)">
                                </div>
                            </td>
                            <td class="align-middle"><button class="btn btn-primary submit_coupon clickAddCart" id="'.$wish->pro_id.'">Add To Cart</button></td>
                        </tr>
                    ';
                }
            }else{
                $output .='
                    <tr>
                        <td class="align-middle" colspan="5">Data Not Found</td>
                    </tr>
                ';
            }

            return response()->json([
                'data'=>$output
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
            if(Auth::check()){
                $check_wish = Wishlist::where('user_id',Auth::id())->where('pro_id',$request->id)->first();
                if ($check_wish) {
                    $check_wish->delete();

                    return response()->json([
                        'action'=>'remove'
                    ]);
                }else{
                    $wish = new Wishlist();
                    $wish->user_id = Auth::id();
                    $wish->pro_id = $request->id;
                    $wish->save();

                    return response()->json([
                        'action'=>'add',
                        'message'=>'Successfully!'
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
        if(request()->ajax()){
            $wish = Wishlist::findOrfail($id);
            if($wish){
                $wish->delete();

                return response()->json([
                    'status'=>200,
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
