<?php

namespace App\Http\Controllers;

use App\cashCollections;
use App\loanRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class loanrequest extends Controller
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
        return view('Dashboard.createloan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = new loanRequests;
        $loan->user_id=Auth::user()->id;
        $loan->description=$request->description;
        $loan->amount=$request->amount;
        $loan->period=$request->period;
        $loan->rate=$request->rate;
        $loan->total=$request->total;
        $loan->payback=$request->payback;
        $loan->save();

        return redirect()->route('loanrequest.show',['id'=>Auth::user()->id])->with('message', 'loan request published');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myloans=loanRequests::where('user_id',$id)->get();
        if($myloans->count()==0)
        {
            $amountCollected = 0;
            return view('Dashboard.myrequest', compact('myloans','amountCollected'));
        }else

        {
            foreach ($myloans as $loan)
            {
                $confirmed = cashCollections::where([
                    ['loan_id',$loan->id],
                    ['status','confirmed'],
                ])->get();
                if ($confirmed->count()==0)
                {
                    $amountCollected = 0;
                }
                else
                {   $amountCollected=0;
                    foreach ($confirmed as $confirm)
                    {

                        $amountCollected +=$confirm->amount;

                    }
                }

            }
            return view('Dashboard.myrequest', compact('myloans','amountCollected'));
        }

    }

//    public function showpeers()
//    {
//        $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->inRandomOrder()->get();
//
//
//
//        return view('Dashboard.peersrequest' , compact('peersloan'));
//    }



    public function showpeers($sort = null)
    {
        if($sort=='Interest'){
            $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('rate', 'desc')->get();
        }
            elseif($sort=='Amount'){
                $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('amount', 'desc')->get();

            }
            elseif($sort=='Period'){
                $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('period', 'desc')->get();

            }
            elseif($sort=='Date'){
                $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('created_at', 'asc')->get();
            }
            else{
                $peersloan=loanRequests::where('user_id','!=',Auth::user()->id)->inRandomOrder()->get();
            }

        return view('Dashboard.peersrequest' , compact('peersloan'));
    }



    public function loansRate()
    {

        $peersloanRate=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('rate', 'asc')->get();

        return view('Dashboard.peersrequest' , compact('peersloanRate'));
    }
    public function loansAmount()
    {

        $peersloanamount=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('amount', 'asc')->get();

        return view('Dashboard.peersrequest' , compact('peersloanamount'));
    }
    public function loansPeriod()
    {

        $peersloanPeriod=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('period', 'asc')->get();

        return view('Dashboard.peersrequest' , compact('peersloanPeriod'));
    }
    public function loansDate()
    {

        $peersloanDate=loanRequests::where('user_id','!=',Auth::user()->id)->orderBy('created_at', 'asc')->get();

        return view('Dashboard.peersrequest' , compact('peersloanDate'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
