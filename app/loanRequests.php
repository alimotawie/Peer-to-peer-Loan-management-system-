<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class loanRequests extends Model
{
    protected $table = "loan";
    protected $fillable=[
       'description',
        'amount',
        'period',
        'rate',
        'total',
        'payback',
        'updated_at'
        ];

    public function borrower()
    {
        return $this->belongsTo('App\User');
    }


    public function cashcollections()
    {
        $realcash=$this->hasMany('App\cashCollections','loan_id','id')->where('status','confirmed')->get();
        $amountCollected=0;
        foreach ($realcash as $cash)
        {
            $amountCollected += $cash->amount;

         }
        return $amountCollected;
    }



    public function paybacks()
    {
        $realcash=$this->hasMany('App\cashCollections','loan_id','id')->where('status','confirmed')->get();

        Return $realcash;

    }
    public function isPaid()
    {
        $cash=$this->hasMany('App\Transactions','loan','id')->where('type','Payback')->get();

        Return $cash;

    }

    public function payments()
    {
        $payments=$this->hasMany('App\Transactions','loan','id')->where('from','=',Auth::user()->id)->get();

        return $payments;
    }

    public function  Getdeadline()
    {
        $deadline = $this->hasOne('App\cashCollections','loan_id','id')->first();
        return  $deadline;

    }






}
