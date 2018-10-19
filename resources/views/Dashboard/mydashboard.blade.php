@extends('Dashboard.layout_dashboard')

@section('dashboard')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-6 topmargin-sm" style="border-right:1px solid;">

                <h4> Total Remaining Debit : {{$Debit - $paid}} | Payments Complete {{$paid}} </h4>
                                        @if($Debit !=0 )
                <div class="col_half center col_last nobottommargin">
                    <div class="rounded-skill nobottommargin" data-color="#3F729B" data-size="100" data-percent="{{$paid*100/$Debit}}" data-width="3" data-speed="2000">
                        <div class="counter counter-inherit"><span data-from="0" data-to="{{$paid*100/$Debit}}" data-refresh-interval="50" data-speed="2000"></span>%</div>
                    </div>
                </div>
                @endif

                <table class="table ">
                    <thead>
                    <tr>
                        <th>Loan</th>
                        <th>Payback</th>
                        <th> Deadline </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($loans as $loan)
                        <tr>
                            <td> {{$loan->description }}</td>
                            <td> {{$loan->payback}}</td>
                            <td>{{$loan->Getdeadline()->deadline}} </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-6 topmargin-sm" style="border-left:1px solid;">
                <h4> Total Credit : {{ $Credit - $TotalPayback }} | Payments Complete {{$TotalPayback}} </h4>
                @if($Credit !=0 )
                    <div class="col_half center col_last nobottommargin">
                        <div class="rounded-skill nobottommargin" data-color="#3F729B" data-size="100" data-percent="{{$TotalPayback*100/$Credit}}" data-width="3" data-speed="2000">
                            <div class="counter counter-inherit"><span data-from="0" data-to="{{$TotalPayback*100/$Credit}}" data-refresh-interval="50" data-speed="2000"></span>%</div>
                        </div>
                    </div>
                @endif

                <table class="table"  >
                    <thead>
                    <tr>
                        <th> Borrower</th>
                        <th>Amount</th>
                        <th> Deadline </th>
                    </tr>
                    </thead>
                    <tbody >
                            @foreach($contribution as $index=>$contributions)

                        <tr>
                            <td> {{$names[$index]}}</td>
                            <td>{!! $contributions->payback !!} </td>
                            <td>{!!  $contributions->deadline !!} </td>
                            <td> </td>
                        </tr>

                            @endforeach
                    </tbody>
                </table>

            </div>



        </div>
    </div>



    @endsection

