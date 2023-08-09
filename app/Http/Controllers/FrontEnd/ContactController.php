<?php

namespace App\Http\Controllers\FrontEnd;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Contact';
        return view('User.contact', compact('title'));
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
        if($request->ajax()){
            // dd($request->all());
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
            Mail::send('User.sendcontact',
                [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'content'=>$request->message
                ],function ($message) use($request,$now) {
                    $message->to('pipj.contact@gmail.com', 'ArulaShop');
                    $message->from($request->email, 'ArulaShop - Contact');
                    $message->subject($request->subject.' '.$now);
                });

            return response()->json([
                'status'=>200,
                'message'=>'We will reply as soon as possible.'
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
