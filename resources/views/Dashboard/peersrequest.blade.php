@extends('Dashboard.layout_dashboard')


@section('peersloan')


<div class="container-fluid ">
    <div class="row">
        <div class="col-md-12 topmargin">


            @if (\Session::has('message'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('message') !!}</li>
                    </ul>
                </div>
            @endif

            <h4> Published Peers loans requests </h4>

        </div>
        <div class="col-md-12">
            @if($peersloan->count() == 0)
                <h3> No Peers loans found </h3>
        </div>
        @else

            <h5> Click to know more <i class="icon-ok-circle"></i></h5>
            <div class="col-md-12">
                <div class="col-md-offset-7 bottommargin-sm">
                    Sort By :
                    <form action="{!! route('showpeers', ['sort' => 'Interest']) !!}" method="get" id="form1" style=" display: inline">
                        <button type="submit" form="form1" value="Submit" >Interest</button>
                    </form>
                        <form action="{!! route('showpeers', ['sort' => 'Amount']) !!}" method="get" id="form2" style=" display: inline">
                            <button type="submit" form="form2" value="Submit" style=" display: inline">Amount</button>
                        </form>
                            <form action="{!! route('showpeers', ['sort' => 'Period']) !!}" method="get" id="form3" style=" display: inline">
                                <button type="submit" form="form3" value="Submit">Period</button>
                            </form>
                                <form action="{!! route('showpeers', ['sort' => 'Date']) !!}" method="get" id="form4" style=" display: inline">
                                    <button type="submit" form="form4" value="Submit">Published Date</button>
                                </form>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>USER</th>
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
                    @php $counter=0 @endphp

                    @foreach($peersloan as $loan)

                                @php $counter+=1 @endphp
                        <tr>

                        <td> <a href="{{ route('profile.show', ['id'=> $loan->user_id]) }}" > {{ App\User::find($loan->user_id)->name }}</a><br>

                            @php $rate_container=App\User::find($loan->user_id)->user_average_rate() @endphp
                             <input id="input-15" class="rating" value="{{$rate_container['average_rate']}}" data-size="xs" data-glyphicon="false" data-rating-class="fontawesome-icon" data-readonly="true">
                        </td>
                            @if(App\loanRequests::find($loan->id)->cashcollections() != $loan->amount )

                          <td>  <button class="button button-border button-rounded button-green" data-toggle="modal" data-target=".{{$counter}}">{{$loan->description}}</button>

                              <ul class="skills col-md-12">
                                  <li data-percent={!! ((App\loanRequests::find($loan->id)->cashcollections()*100)/$loan->amount) !!}>

                                      <div class="progress">
                                          <div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to={!! ((App\loanRequests::find($loan->id)->cashcollections()*100)/$loan->amount) !!} data-refresh-interval="30" data-speed="1100"></span>%</div></div>
                                      </div>
                                  </li>
                              </ul>

                          </td>

                            <td>{{$loan->amount}}</td>
                            <td id="loanperiod{{$counter}}" >{{$loan->period}}</td>
                            <td id="rate{{$counter}}" >{{$loan->rate}} %</td>
                            <td>{{$loan->created_at->diffForHumans()}}</td>

                            <td>{{App\loanRequests::find($loan->id)->cashcollections()}}</td>

                            <td>{{($loan->amount)-(App\loanRequests::find($loan->id)->cashcollections())}}</td>

                        </tr>
                                @else
                                    <td>
                                      <button class="button button-border button-rounded button-green">{{$loan->description}}</button>

                                        <ul class="skills col-md-12">
                                            <li data-percent={!! ((App\loanRequests::find($loan->id)->cashcollections()*100)/$loan->amount) !!}>

                                                <div class="progress">
                                                    <div class="progress-percent"><div class="counter counter-inherit counter-instant"><span data-from="0" data-to={!! ((App\loanRequests::find($loan->id)->cashcollections()*100)/$loan->amount) !!} data-refresh-interval="30" data-speed="1100"></span>%</div></div>
                                                </div>
                                            </li>
                                        </ul>

                                    </td>
                                    <td>{{$loan->amount}}</td>
                                    <td id="loanperiod{{$counter}}" >{{$loan->period}}</td>
                                    <td id="rate{{$counter}}" >{{$loan->rate}} %</td>
                                    <td>{{$loan->created_at->diffForHumans()}}</td>

                                    <td>{{App\loanRequests::find($loan->id)->cashcollections()}}</td>

                                    <td>Collection Completed</td>


                                @endif
                        <!-- Large modal -->

                        <div class="modal fade {{$counter}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"> {{$loan->description}} </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid ">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4> Amount Collected </h4>
                                                       {{ App\loanRequests::find($loan->id)->cashcollections()}}
                                                    </div>
                                                    <div class="col-md-6">
                                                            <h4> Amount Left </h4>
                                                        {{($loan->amount)-(App\loanRequests::find($loan->id)->cashcollections())}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">

                                            {!! Form::open([ 'route'=>'notify', 'name'=>'lend' ])!!}
                                            {!! Form::label('amount', 'Enter Amount To Lend') !!}
                                            {!! Form::number('amount',null,[ 'required','id'=>'LendAmount'."$counter",'class'=>'form-control','oninput'=>"lendcal($counter)",'min'=>1,'max'=>($loan->amount)-(App\loanRequests::find($loan->id)->cashcollections() )]) !!}
                                            {!! Form::hidden('loan_id', $loan->id) !!}
                                             {!! Form::label('paymentmethod', 'Select Preferred payment method to Lend') !!}
                                              {!! Form::select('paymentmethod',['Bank Transfer' => 'Bank Transfer', 'Meeting' => 'Meeting', 'Postal Office'=>'Postal Office','Other'=>'Other'],null,['placeholder' => 'Pick a Method..','required'],['class'=>'form-control']) !!}
                                                        {!! Form::hidden('payback') !!}
                                                    </div>
                                                    </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h4> Profit </h4>
                                                        <p id="Profit{{$counter}}"> </p>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h4> Total Amount </h4>
                                                        <p id="Total Amount{{$counter}}"> </p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h4> Monthly Payback</h4>
                                                        <p id="Payback{{$counter}}"> </p>
                                                    </div>
                                                </div>
                                                {!! Form::submit( 'lend NOW',['class'=>'button button-3d button-rounded button-green']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{route('download')}}"> <button class="button button button-rounded button-red">Download Contract templatee</button> </a>

                                                <p class="nobottommargin">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif


    </div>
</div>

<script type="text/javascript">

    function lendcal(i)
        {
            var LendAmount = parseInt(document.getElementById("LendAmount"+i).value);
            var loanPeriod = parseInt(document.getElementById("loanperiod"+i).innerHTML);
            var Interest = parseFloat(document.getElementById("rate"+i).innerHTML);

            var profit = document.getElementById("Profit"+i).innerHTML = ((LendAmount * Interest) / 100) * loanPeriod;
            var total = document.getElementById("Total Amount"+i).innerHTML = profit + LendAmount;
            var payback = document.getElementById("Payback"+i).innerHTML = Math.ceil(total / loanPeriod);
            document.forms['lend']['payback'].value = Math.ceil(total / loanPeriod);
        }


</script>


@endsection