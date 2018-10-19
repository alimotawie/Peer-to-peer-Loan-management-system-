@extends('profile.layout')

@section('title',$user->name." |Profile")

@section('profile')
		<!-- Content
		============================================= -->

		@if (\Session::has('message'))
			<div class="alert alert-success">
				<ul>
					<li>{!! \Session::get('message') !!}</li>
				</ul>
			</div>
		@endif

		<div class="container-fluid ">
			<div class="row">
				<div class="col-md-6">
							<img src="{{URL::asset('images/profilepic/').'/'.$user->picture}}" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">

							<div class="heading-block noborder">
								<h3>{{$user->name}} </h3>
								<h5> On site Since: {{$user->created_at->diffForHumans()}} </h5>
								<span>Average Rate ({{$average_rate}}) from ({{$rates_count}}) users </span>
								<input id="input-15" class="rating" value="{{$average_rate}}" data-size="md" data-glyphicon="false" data-rating-class="fontawesome-icon" data-readonly="true">

							</div>
							<div class="title topmargin title-border">
								<h4>About Me</h4>
								@if( $user->idScan != Null)
								<p> ID / Passport / Driving Lisence </p>
								<img src="{{URL::asset('images/identification/').'/'.$user->idScan}}" width="200px">
								@endif
								<p>Mobile: {{$user->mobile}} </p>
								<p>Email: {{$user->email}} </p>
								@if( $user->facebook != Null)
								<p> Facebook Profile <a target="_blank" href="{{$user->facebook}}"><i class=" i-small i-rounded icon-facebook"></i></a> </p>
								@endif
								<h3>Reviews about {{$user->name}} </h3>
								<div style="width: 750px; overflow-y: auto; height: 200px;">

								<ul>
									@foreach( $reviews as $review)

										<li><a href="{{ route('profile.show',[$review->reviewer_id]) }}">
												<img src="{{asset('images/profilepic/').'/'.App\User::find($review->reviewer_id)->picture}}" width="40px">
												{{ App\User::find($review->reviewer_id)->name }} </a> : {{ $review->review}} </li>

									@endforeach

								</ul>
					</div>
								@if( Auth::user()->id != $user->id)

									{!!Form::open(['url'=>['addreviews',$user->id] ]) !!}
									<h3> Add Rate </h3>
									{!!Form::number('rate',null,[ 'required','id'=>'input-1', 'class'=>'rating' ,'data-size'=>'md' , 'min'=>'0', 'max'=>'5','data-step'=>'1', 'data-glyphicon'=>'false', 'data-rating-class'=>'fontawesome-icon']) !!}

									<h3> Add review </h3>
									{!!Form::textarea('review',null,['required']) !!}
									<br>
									{!!Form::submit('Add Rate and Review!') !!}

									{!!Form::close() !!}

								@endif
							</div>
				</div>

					<div class="col-md-6 ">
					<h4> My Loans Request</h4>
						@if($borrowed != 0 )
						<h5><u> Total Requested amount</u> : {{$borrowed}}</h5>
							@else
							<h5><u> Total Requested amount</u> : 0</h5>
						@endif

								<div style="width: 500px">
									@if($myloans->count() == 0)
										<h3> No loans found </h3>
								</div>
								@else
									<div  style="width: 500px" >
										<h4> Published loans requests </h4>
									</div>
									<div style="width: 750px; overflow-y: auto; height: 400px;">
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

											@php $counter=0 @endphp

											@foreach($myloans as $loan)
												@php $counter+=1 @endphp
                                                <tr>
													@if(App\loanRequests::find($loan->id)->cashcollections() != $loan->amount )

														<td>
															<button class="button button-border button-rounded button-green" data-toggle="modal" data-target=".{{$counter}}">{{$loan->description}}</button>

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
                                            </tbody>
												@endif
												<!-- Large modal -->
												@if(Auth::user()->id != $loan->user_id)
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

												@endif
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