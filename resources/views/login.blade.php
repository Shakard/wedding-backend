@extends('auth.master.master')

@section('title', 'Login')

@section('content')
    <div class="box box_login shadow">
        <div class="header">
            <a href="{{ url('/')}}">
                <img src="{{ url('/static/images/logo.png')}}" alt="">
            </a>
        </div>
        <div class="inside">
        {!! Form::open(['route' => 'login']) !!}
        <label style="color:#4f62fa" for="email">Email:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div style="color:#4f62fa" class="input-group-text"><i class="far fa-envelope-open" aria-hidden="true"></i></div>
            </div>
        {!! Form::text('email', null,  [ 'class' => 'form-control', 'required']) !!}
        </div>

        <label style="color:#4f62fa" for="password" class="mtop16">Password:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div style="color:#4f62fa" class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>
            </div>
        {!! Form::password('password', [ 'class' => 'form-control', 'required']) !!}
        </div>  
        {!! Form::submit('Login', [ 'class' => 'btn btn-success mtop16', 'style' => 'background-color: #02ccc6']) !!}
        {!! Form::close() !!}
        
        <div class=" footer mtop16">
            <a href="" style="color:#4f62fa">Forgot password</a>?</a>
        </div>
        </div>
    </div>
@endsection

