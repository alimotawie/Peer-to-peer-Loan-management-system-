@extends('Dashboard.layout_dashboard')

@section('loandetails')


    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 topmargin">
<h3 > Loan Collection Detials</h3>
            </div>
                <div class="col-md-12 bottommargin-sm">
                    @if( (($amountCollected*100)/$loan->amount)==100 )

                        <h5 style="color: limegreen"> LOAN COLLECTION COMPLETED  </h5>

                        @endif

                    <h5>Loan Collection Progress</h5>

                        <ul class="skills col-md-6" >
                        <li data-percent={!! (($amountCollected*100)/$loan->amount) !!}>

                            <div class="progress" >
                                <div class="progress-percent"  ><div class="counter counter-inherit counter-instant" ><span  data-from="0" data-to="{!! (($amountCollected*100)/$loan->amount) !!}" data-refresh-interval="30" data-speed="1100" ></span>%</div></div>
                            </div>
                        </li>
                    </ul>
             </div>
        </div>

        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>DESCRIPTION</th>
                    <th>AMOUNT</th>
                    <th>LOAN PERIOD</th>
                    <th>INTEREST PER MONTH</th>
                    <th>PUBLISHED AT</th>
                    <th>AMOUNT COLLECTED</th>
                    <th>AMOUNT LEFT</th>
                </tr>
                </thead>
                <tbody>
                    <tr>

                        <td> {{$loan->description}} </td>

                        <td>{{$loan->amount}}</td>
                        <td>  {{$loan->period}}</td>
                        <td> {{$loan->rate}} % </td>

                        <td>{{$loan->created_at->diffForHumans()}}</td>
                        <td> {{$amountCollected}}</td>
                        <td> {{ $amountLift }}</td>

                    </tr>
                </tbody>
            </table>
        </div>

        @if(Auth::user()->id==$loan->user_id)
        <div class="row">
            <div class="col-md-12">

                <h4> Pending Cash Request </h4>
            </div>
        </div>

        <div class="row">
        <div class="col-md-12">



            @if( $amountLift ==0)
                <h5  class="content center" style="color: limegreen"> CONGRATULATION !! LOAN COLLECTION COMPLETED  </h5>

                @elseif($pending->count()==0)
                    <div class="content center"><h4> No pending cash request </h4></div>

                    @else
                <h5> Contact lender to know more detonls about receiving payment <i class="icon-line2-call-out"></i></h5>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>AMOUNT</th>
                                <th>LENDER</th>
                                <th>CONTACT DETAILS </th>
                                <th>PAYMENT METHOD</th>
                            </tr>
                            </thead>
                            <tbody>
                @foreach($pending as $pending)
                        <tr>
                            {!! Form::open(['route'=>['confirmed','id'=>$pending->id] ]) !!}
                            <td>{{ $pending->amount}} </td>

                            <td> <a href="{{route('profile.show',['id'=>$pending->user_id] )}}">{{ App\User::find($pending->user_id)->name }}</a> </td>
                            <td> Mobile : <a href="tel:{{ App\User::find($pending->user_id)->mobile}}"> {{ App\User::find($pending->user_id)->mobile}} </a> <br>
                                   Email : <a href="mailto:{{ App\User::find($pending->user_id)->email}}"> {{ App\User::find($pending->user_id)->email}} </a> </td>
                            <td>{{ $pending->paymentmethod}} </td>
                            <td>{{Form::submit('CONFIRM CASH')}}</td>
                        </tr>
                @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <h4> Accepted Cash Requests </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                @if($confirmed->count()==0)
                    <div class="content center"><h4> No cash Received </h4></div>
                @else
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>AMOUNT</th>
                            <th>LENDER</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($confirmed as $confirmed)
                            <tr>
                                <td>{{ $confirmed->amount}} </td>
                                <td> <a href="{{route('profile.show',['id'=>$confirmed->user_id] )}}">{{ App\User::find($confirmed->user_id)->name }}</a> </td>
                                <td> {{$confirmed->updated_at}} </td>

                            </tr>
                        @endforeach
                        @endif


                        </tbody>
                    </table>
            </div>
        </div>
        @endif















    </div>
    @endsection