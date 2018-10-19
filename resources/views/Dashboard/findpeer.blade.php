@extends('Dashboard.layout_dashboard')

@section('searchbar')

    <form action="{{route('findpeer')}}"  class="navbar-form navbar-center" role="search">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Search for a peer">
        </div>
        <button type="submit" class="btn btn-default">FIND </button>
    </form>



                <div class="clear"></div>

                <div class="fancy-title title-center title-dotted-border topmargin">
                    <h3>Search Result</h3>
                </div>

    <div class="container-fluid">
        <div class="row">
            @if(count($result)!=0)


    @foreach($result as $result)

      <div class="col-sm-4">
                                <a href="{{ route('profile.show',[$result->id] )}}" ><img class="image_fade  img-circle img-thumbnail  " src="{{asset('images/profilepic/').'/'.$result->picture}}" alt="profile pic" style="max-width: 100px;"></a>

                            <div class="entry-title">
                                <h3><a href="{{ route('profile.show',[$result->id] )}}"> {{$result->name}}  </a></h3>
                            </div>

                            <ul class="entry-title">
                                <li><i class="icon-calendar3"></i>On site since : {{$result->created_at->diffForHumans()}}</li>

                                <li> <i class="icon-info"></i> Average Rate : @php $rate_container=$result->user_average_rate(); print_r($rate_container['average_rate']); @endphp
                                    from @php print_r($rate_container['rates_count']) @endphp Users </li>

                            </ul>
        </div>
    @endforeach
        </div>
</div>

@else
    <section class="content ">
        <div class="col_ful center">
    <h3 > Sorry !! User not found</h3> <br>
    <h3>Invite user </h3><br>
            <form action="" method="" >
            <input  name="email" placeholder="Enter Peer Email to invite" class="form-control">
            <input type="button" value="Send Invitation" class="button button-3d button-mini button-rounded button-blue">
            </form>

        </div>
    </section>
    </div>
    </div>
@endif



@endsection
