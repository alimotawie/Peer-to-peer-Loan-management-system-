<?php

namespace App\Http\Controllers;

use App\loanRequests;
use App\Transactions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $id = Auth::user()->id;

        $lender = Transactions::where('from', '=', $id)->get();

        $borrower = Transactions::where('to', '=', $id)->get();

        foreach ($lender as $lend) {

        $borrowerName[]= User::find($lend->to)->name;
}
        foreach( $borrower as $borrow ){

            $lenderName[]=User::find($borrow->from)->name;
    }


        return view('Dashboard.transaction',compact('lender','borrower','lenderName','borrowerName'));
    }





}
