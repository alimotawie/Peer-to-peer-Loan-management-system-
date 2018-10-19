<?php

namespace App\Http\Controllers;

use App\cashCollections;
use App\loanRequests;
use App\Notifications\CashRequest;
use App\Transactions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class cashcollection extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function loandetails($loanid)
    {

        $loan = loanRequests::find($loanid);


        $pending = cashCollections::where([
            ['loan_id',$loanid],
            ['status','pending'],
        ])->get();

        $confirmed = cashCollections::where([
            ['loan_id',$loanid],
            ['status','confirmed'],
        ])->get();

            if ($confirmed->count()==0)
            {
                $amountCollected = 0;
                $amountLift =$loan->amount ;
            }
            else
            {   $amountCollected=0;
                foreach ($confirmed as $confirm)
                {

                    $amountCollected +=$confirm->amount;

                    $amountLift = ($loan->amount) - $amountCollected;
                }
            }

        if( $amountCollected == (loanRequests::where('id','=',$loanid)->first()->amount))
        {
            $complete=loanRequests::where('id',$loanid)->first();
            $complete->status='complete';
            $complete->save();
        }

        return view('Dashboard.loandetails', compact('loan','pending','confirmed','amountCollected','amountLift'));
    }

    public function notification(Request  $request)
    {
        $cash= new cashCollections;

        $cash->amount=$request->amount;
        $cash->user_id=Auth::user()->id;
        $cash->loan_id=$request->loan_id;
        $cash->paymentmethod=$request->paymentmethod;
        $cash->payback=$request->payback;
        $cash->status='pending';

        $cash->save();

        $amount=$request->amount;
        $lender=Auth::user()->id;
        $loanID=$request->loan_id;

        $user=loanRequests::find($request->loan_id)->user_id;

        User::find($user)->notify(new CashRequest($amount ,$lender,$loanID));

        return redirect()->route('showpeers')->with('message','User notified');
    }

    public function confirmcash($id)
    {
        $status=cashCollections::find($id);
        $status->status='confirmed';
        $status->percent= (($status->amount)*100)/loanRequests::find(cashCollections::find($id)->loan_id)->amount;
        $status->deadline=date('Y-m-d', strtotime($status->deadline.' + '.'31'.' days'));

        $status->save();

        $trans=New Transactions;
        $trans->amount=$status->amount;
        $trans->from=$status->user_id;
        $trans->to=Auth::user()->id;
        $trans->loan=$status->loan_id;
        $trans->type='Borrow';
        $trans->save();

        $confirmed = cashCollections::where([
            ['loan_id',cashCollections::find($id)->loan_id],
            ['status','confirmed'],
        ])->get();

        $amountCollected=0;

            foreach ($confirmed as $confirm)
            {

                $amountCollected +=$confirm->amount;
            }

        if( $amountCollected == (loanRequests::where('id',cashCollections::find($id)->loan_id))->first()->amount)
        {
            $complete=loanRequests::where('id',cashCollections::find($id)->loan_id)->first();

            $complete->deadline=cashCollections::find($id)->deadline;
            $complete->save();
        }
        return redirect()->back();

    }








}
