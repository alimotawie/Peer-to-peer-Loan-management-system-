@extends('common layout.Container')

@section('title','Loan Calculations')
@section('calculations')
<h3> borrow request - loan  calculator</h3>
        <lable> Loan amount</lable>
        <input type="number"  id="LoanAmount" min="1000" max="1000000" step="100" name="LoanAmount"  oninput="myloancal()">
    <br>

        <lable>  Installment Period</lable>
        <input type="number"  min="1" max="36" step="1" id="InstallmentPeriod" name="InstallmentPeriod" oninput="myloancal()">
    <br>

            <lable>  Interest value per month</lable>
            <input type="number"  min="0" max="3" step="0.5" id="Interest" name="Interest" oninput="myloancal()"> <br>


            <lable > interest value <p id="interest value"> </p> </lable>

           <lable > Total cost  <p id="Total cost"> </p> </lable>
           <lable > monthly installments  <p id="monthly installments"> </p> </lable>

<script>
    function myloancal() {

        var LoanAmount = document.getElementById("LoanAmount").value;
        var InstallmentPeriod = document.getElementById("InstallmentPeriod").value;
        var Interest = document.getElementById("Interest").value;

       var cal_interest = document.getElementById("interest value").innerHTML =(((LoanAmount*Interest)/100)*InstallmentPeriod);
       var total_cost = document.getElementById("Total cost").innerHTML = Number(LoanAmount)+Number(cal_interest) ;
        document.getElementById("monthly installments").innerHTML = total_cost/InstallmentPeriod;
    }
</script>



<h3> lending request - investment calculator</h3>


<lable> lending amount</lable>
<input type="number"  min="100" max="100000" step="100" name="investAmount" id="investAmount" oninput="myProfitcal()"> <br>

<script type="text/javascript">
   function myProfitcal () {

       var investAmount = document.getElementById("investAmount").value;
       var InstallmentPeriod = document.getElementById("InstallmentPeriod").value;
       var Interest = document.getElementById("Interest").value;
       var cal_interest = document.getElementById("profits").innerHTML =(((investAmount*Interest)/100)*InstallmentPeriod);
       var total = document.getElementById("total").innerHTML =Number(investAmount)+Number(cal_interest);
       var payback = document.getElementById("payback").innerHTML =Number(total)/InstallmentPeriod;
   }

</script>

<lable> profit <p id="profits"> </p> </lable> <br>
<lable> Total return <p id="total"> </p>  </lable> <br>
<lable> monthly payback <p id="payback"></p> </lable>


@endsection