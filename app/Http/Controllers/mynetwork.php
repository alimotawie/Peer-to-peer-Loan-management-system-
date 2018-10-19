<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class mynetwork extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('Dashboard.mynetwork');
    }

    public function findpeer(Request $request){

        $name=$request->name;
        $result=user::where('email',$name)->orwhere('mobile',$name)->orwhere('name','like','%'.$name.'%')->get();

            return view ('Dashboard.findpeer', compact('result'));
    }
}
