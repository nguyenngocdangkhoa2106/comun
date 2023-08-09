<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Sign In';
        return view('User.signin', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        Auth::logout();

        return redirect()->route('home.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->action == 'In'){
            $check= array('email'=>$request->email, 'password'=>$request->password);

            if(Auth::attempt($check)){
                if (Auth::user()->level == 1) {

                    return response()->json([
                        'status'=>200,
                        'url'=>route('home.index'),
                        'message'=>'Sign In Success!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>400,
                        'url'=>route('dashboard.index'),
                        'message'=>'Sign In Success!'
                    ]);
                }
            }else{

                return response()->json([
                    'status'=>404,
                    'message'=>'Email Or Password Invalid!'
                ]);
            }
        }else{
            $user = User::where('email',request()->email)->first();
            if($user){
                return response()->json([
                    'status'=>400,
                    'message'=>'Email Address already Exists'
                ]);
            }else{
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->level = 1;
                $user->save();

                Auth::login($user,true);
                return response()->json([
                    'status'=>200,
                    'message'=>'Create Account Successfully!',
                    'url'=>route('home.index')
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
        //
    }
}
