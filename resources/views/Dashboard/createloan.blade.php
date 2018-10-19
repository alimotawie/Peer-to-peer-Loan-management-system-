@extends('Dashboard.layout_dashboard')

@section('loanrequest')


    {!! Form::open(['method'=>'post', 'route'=>'loanrequest.store','name'=>'Loanrequest','class'=>'form-group' ]) !!}

        <h3> Create a Loan Request  </h3>
        {!! Form::label('description','Loan Description') !!}
        {!! Form::text('description',null,['required','class'=>'form-control']) !!}
        <br>
    {!! Form::label('amount','Loan Amount') !!}
    {!! Form::number('amount',null,['required','id'=>'LoanAmount','class'=>'form-control','oninput'=>'myloancal()']) !!}
    <br>
    {!! Form::label('period','Installment Period') !!}
    {!! Form::number('period',null,['required','id'=>'InstallmentPeriod','class'=>'form-control','oninput'=>'myloancal()']) !!}
        <br>
    {!! Form::label('rate','Interest per month') !!}
    {!! Form::number('rate',null,['required','id'=>'Interest','class'=>'form-control','oninput'=>'myloancal()','step' => '0.1' ]) !!}
    {!! Form::hidden('total') !!}
    {!! Form::hidden('payback') !!}

    <br>

<div class="container">
        <div class="row">

            <div class="col-sm-3">
                <h4  > Total Interest % </h4>  <p id="Total interest"> </p>
            </div>

            <div class="col-sm-3">
                <h4>Interest Value </h4> <span id="interest value"> </span>
            </div>

                <div class="col-sm-3">
                     <h4 > Total Cost </h4> <p id="Total cost"> </p>
                </div>

                    <div class="col-sm-3">
    <h4  > Monthly Installments </h4>  <p id="monthly installments"> </p>
                    </div>

    </div>
</div>

    <div class="container">
        <div class="row">

            <div class="col-sm-6 ">
    {!! Form::submit('Publish Loan Request',['class'=>'button button-medium button-circle button-green ']) !!}
    {!! Form::close() !!}
            </div>
            <div class="col-sm-6 ">
        {!! Form::open(['method'=>'get','route'=>['loanrequest.show','id'=>Auth::user()->id]] ) !!}
            {!! Form::submit('Decline Loan',['class'=>'button button-medium button-circle button-red ']) !!}
            {!! Form::close() !!}
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
        function myloancal() {

            var LoanAmount = document.getElementById("LoanAmount").value;
            var InstallmentPeriod = document.getElementById("InstallmentPeriod").value;
            var Interest = document.getElementById("Interest").value;

            document.getElementById("Total interest").innerHTML=Interest*InstallmentPeriod;
            var cal_interest = document.getElementById("interest value").innerHTML =(((LoanAmount*Interest)/100)*InstallmentPeriod);
            var total = document.getElementById("Total cost").innerHTML = Number(LoanAmount)+Number(cal_interest) ;
            var payback = document.getElementById("monthly installments").innerHTML= Math.ceil(total/InstallmentPeriod);

            document.forms['Loanrequest']['total'].value =total;
            document.forms['Loanrequest']['payback'].value =payback;


        }

    </script>



    @endsection
