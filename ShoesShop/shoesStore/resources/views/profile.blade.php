@extends('layouts.master')

@section('title',$title)

@section('content')
<div class ="container">
    <div class ="row">
        <div class ="col-md-10 col-md-offset-1">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br> 
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
@endif
            <h2>{{ $user->name }}'s Profile</h2>
            <img src="{{asset($user->avatar)}}" style ="width:200px; height:200px; float:left; border-radius:50%; margin-right :50px;">
            <h5>Email: {{$user->email}}</h5>
            <form enctype="multipart/form-data" action="{{url('/profile/'.$user->id.'/avatarUpload')}}" method="POST">
            <label> Profile Image </label>
            <input type="file" name="avatar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="pull-right btn btn-sm btn-primary">       
        </form>
        </div>
    </div>
</div>
@endsection