@extends('Dashboard.layout_dashboard')

@section('payback')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 topmargin-sm">
                 <h4>Payback Schedule</h4>
                @foreach($loans as $index=>$loan)
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Loan ID : {{$loan->id}}</th>
                        <th>Loan Description : {{$loan->description}} </th>
                        <th> Loan Total Amount : {{$loan->total}} </th>
                        <th> Paid : {{ $paid[$index] }}</th>

                        <th> Amount left : {{($loan->total)-$paid[$index]}}</th>
                    </tr>
                    <tr>
                        <th>To</th>
                        <th>Amount</th>
                        <th> Deadline </th>
                         <th>Confirm</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($loan->paybacks() as $index=>$payments)

                        <tr>
                            <td> {{  $names[$index]}} </td>
                            <td> {{ ceil($loan->payback*$payments->percent/100)}} </td>
                            <td>{{$payments->deadline}} </td>
                            <td>
                                    {!! Form::open([ 'route'=>['updateDate','loanid'=>$loan->id ,'userid'=>$payments->user_id],'method' => 'get' ]) !!}
                                    {!! Form::submit('Confirm Payment') !!}
                                    {!! Form::Close() !!}
                            </td>
                        </tr>
                    @endforeach
                    @endforeach
                    </tbody>

                </table>



            </div>
        </div>
    </div>






    @endsection