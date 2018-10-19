@extends('Dashboard.layout_dashboard')

@section('trans')
<div class="content">
    <div class="row">
        <div class="col-md-12">

<table class="table table-striped">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Amount</th>
        <th>From </th>
        <th>To </th>
        <th> Type</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @if($lender->count()>0)

    @foreach( $lender as $index=>$lend )
    <tr>
        <td>{{$lend->id}}</td>
        <td>{{$lend->amount}}</td>
        <td>{{Auth::user()->name}} (You)</td>
        <td>{{$borrowerName[$index]}}</td>
        <td>{{$lend->type}} </td>
        <td>{{$lend->created_at}}</td>
    </tr>
        @endforeach
    @endif

        @if($borrower->count()>0)
        @foreach( $borrower as $index=>$borrow )
            <tr>
            <td>{{$borrow->id}}</td>
            <td>{{$borrow->amount}}</td>
            <td> {{$lenderName[$index] }}</td>
            <td>{{Auth::user()->name}} (You)</td>
            <td>{{ $borrow->type}} </td>
            <td>{{$borrow->created_at}}</td>
        </tr>
            @endforeach
        @endif
    </tbody>
</table>
        </div>
    </div>
</div>

            @endsection