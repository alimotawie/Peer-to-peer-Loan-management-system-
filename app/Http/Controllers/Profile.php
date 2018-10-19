<?php

namespace App\Http\Controllers;

use App\cashCollections;
use App\loanRequests;
use App\review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\User;
use APP\rate;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;


class Profile extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user=user::findorfail($id);

        $rates=0;
        $rates_count= $user->user_rates()->count();
        if ($rates_count==0)
        {
            $average_rate=0;
        }
        else {
            foreach ($user->user_rates as $rate) {
                $rates += $rate->rate;
            }
            $average_rate = $rates / $user->user_rates->count();
        }
        $reviews = review::where('user_id',$user->id)->get();

        $myloans=loanRequests::where('user_id',$user->id)->orderBy('status', 'asc')->get();

        if($myloans->count()==0)
        {
            $amountCollected = 0;
            $borrowed=0;

        }else {
            $borrowed=0;
            foreach ($myloans as $loan) {

                $borrowed += intval($loan->amount);

                $confirmed = cashCollections::where([
                    ['loan_id', $loan->id],
                    ['status', 'confirmed'],
                ])->get();
                if ($confirmed->count() == 0) {
                    $amountCollected = 0;
                } else {
                    $amountCollected = 0;

                    foreach ($confirmed as $confirm) {

                        $amountCollected += $confirm->amount;
                    }

                }

            }

        }

        return view('profile.profile',compact('user','borrowed','myloans','amountCollected','average_rate','reviews', 'rates_count'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view("profile.editprofilepage");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'picture' => 'image | max:1000',
            'idScan' => 'image| max:1000',
            'facebook'=>'url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i'
        ]);

            if($request->picture) {

                if(user::find($id)->picture != "avatar.jpg") {
                    File::delete(public_path().'/images/profilepic/'.user::find($id)->picture);
                }

                $pictureName = $id.time().'.'.$request->picture->getClientOriginalExtension();
                $request->picture->move(public_path('images/profilepic'), $pictureName);

                User::find($id)->update(['picture'=>$pictureName]);
            }


        if($request->idScan) {

            if(user::find($id)->idScan != Null ) {
                File::delete(public_path().'/images/identification/'.user::find($id)->idScan);
            }

            $docName = $id.time().'.'.$request->idScan->getClientOriginalExtension();
            $request->idScan->move(public_path('images/identification'), $docName);

            User::find($id)->update(['idScan'=>$docName]);
        }

        User::where('id',$id)->update([

            'name' => $request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'facebook'=>$request->facebook,

        ]);



//        $input = Input::all();
//        auth::user()->update($input);

        return  redirect()->route('profile.index')->with('message','profile updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
