@extends('Dashboard.layout_dashboard')

@section('loanrequest')


    @if (\Session::has('message'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif

    <div class="container-fluid topmargin">
    <div class="row">
        <div class="col-md-6">

    {!! Form::open(['route'=>'loanrequest.create' , 'method'=>'get' ]) !!}
    {!! Form::label('Create a New Loan Request') !!}
    {!! Form::submit('Click Here !', ['class'=>'button button-small button-circle button-green']); !!}
{!! Form::close() !!}
        </div>
</div>
</div>

    <div class="container-fluid ">
        <div class="row">

            <div class="col-md-12">
            @if($myloans->count() == 0)
                <h3> No loans found </h3>
            </div>
            @else

                <div class="col-md-12">
                    <h4> Published loans requests </h4>
                </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>DESCRIPTION</th>
                        <th>AMOUNT</th>
                        <th>LOAN PERIOD</th>
                        <th>INTEREST PER MONTH</th>
                        <th>TOTAL LOAN AMOUNT</th>
                        <th>MONTHLY PAYBACKS</th>
                        <th>AMOUNT COLLECTED</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($myloans as $myloans)
                    <tr>
                        <td>  <a href="{{route('loandetails',['loanid'=>$myloans->id])}}" target="_blank"> {{$myloans->description}} </a> </td>
                        <td>{{$myloans->amount}}</td>
                        <td>{{$myloans->period}}</td>
                        <td>{{$myloans->rate}} %</td>
                        <td>{{$myloans->total}}</td>
                        <td>{{$myloans->payback}}</td>
                        @if(\App\loanRequests::find($myloans->id)->cashcollections() == $myloans->amount )
                            <td>  Completed 100% </td>
                        @else
                        <td>{{\App\loanRequests::find($myloans->id)->cashcollections()}}</td>
                            @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endif

            </div>
        </div>
    </div>



    @endsection