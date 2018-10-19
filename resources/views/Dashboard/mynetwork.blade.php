@extends('Dashboard.layout_dashboard')

@section('mypeers')

                <form action="{{route('findpeer')}}"  class="navbar-form navbar-center" role="search">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Search for a peer">
                    </div>
                    <button type="submit" class="btn btn-default">FIND </button>
                </form>

@endsection
