<?php

namespace App\Http\Controllers;
use App\Notifications\RateAndReview;
use App\rate;

use App\review;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Reviews extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    use Notifiable;

    public function add_reviews($id)
    {
        $rate = new rate;
        $rate->rate = Input::get('rate');
        $rate->user_id= $id;
        $rate->save();

        $review= new review;
        $review-> review = Input::get('review');
        $review->user_id= $id;
        $review->reviewer_id=Auth::user()->id;
        $review->save();
        $userRate=Input::get('rate');
        $userReview=Input::get('review');
        $from=Auth::user()->id;


        User::find($id)->notify(new RateAndReview($userRate, $userReview,$from));


        return redirect()->route('profile.show',['id'=>$id])->with('message','Rate and Review Added !');
    }


}
