@extends('profile.layout')

@section('title','Edit Profile')
@section('editprofile')

<h1> Edit Profile Data </h1>

<div class="container col-md-10 col-md-offset-3 ">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

{!! Form::model(Auth::user(),['route'=>['profile.update','id'=>Auth::user()->id],'method'=>'PUT','files'=>true]) !!}


{!! Form::label('name' , 'User Name')!!}
{!! Form::text('name',null,['class'=>'col-form-label text-md-right form-control']) !!} <br>
{!! Form::label('picture' , 'Upload Profile Picture' )!!}
{!! Form::file('picture')!!}<br>
{!! Form::label('idScan' , 'Upload ID Card/Passport/Driving License Document' )!!}
{!! Form::file('idScan')!!}<br>
{!! Form::label('mobile' , 'User Mobile' ) !!}
{!! Form::text('mobile',null,['class'=>'col-form-label text-md-right form-control'])!!}<br>
{!! Form::label('facebook' , 'Facebook profile link' ) !!}
{!! Form::text('facebook',null,['class'=>'col-form-label text-md-right form-control'])!!}<br>
{!! Form::label('email' , 'User Email' ) !!}
{!! Form::email('email',null,['class'=>'col-form-label text-md-right form-control'])!!} <br>
{!! Form::submit('Update profile' , ['class'=>'btn btn-primary'])!!}
{!! Form::close() !!}
</div>
    @endsection