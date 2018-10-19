<?php

namespace App\Http\Controllers;

use App\cashCollections;
use App\loanRequests;
use App\Transactions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PaybackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mypayback()
    {


        $loans = loanRequests::where([
            ['user_id',Auth::user()->id],['status','complete'],['paymentStatus',NULL] ])->get();



        foreach ($loans as $loan)
        {   $pay=0;

            $payments=$loan->payments()->all();

            foreach($payments as $payment)
            {
                $pay += $payment->amount;
            }

            $paid[]=$pay;
        foreach($loan->paybacks() as $payments) {
            $names[]=User::find($payments->user_id)->name;
        }
        }

    return view('Dashboard.payback',compact('loans','names','paid'));
    }


    public function NewDeadline($loanid , $userid)
    {
        $loan=cashCollections::where([
            ['loan_id',$loanid],
            ['user_id',$userid]
        ])->get();


        foreach($loan as $deadlineupdate)
        {
            $deadlineupdate->deadline = date('Y-m-d', strtotime($deadlineupdate->deadline.' + '.'31'.' days'));

            $deadlineupdate->save();

            $trans=New Transactions;
            $trans->amount=$deadlineupdate->payback;
            $trans->from=Auth::user()->id;
            $trans->to=$deadlineupdate->user_id;
            $trans->loan=$deadlineupdate->loan_id;
            $trans->type='Payback';
            $trans->save();

        }

        return redirect()->back();

    }

}
