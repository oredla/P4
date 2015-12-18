@extends('layouts.master')

@section('title')
Register A New Account
@stop

@section('page_header')
<h1>
    Register A New Account
</h1>
@stop

@section('content')
<p>Already have an account? <a href='/login'>Login here...</a></p>
<form method="POST" action="/register" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-sm-2 control-label" for='name'>Name</label>
        <div class="col-sm-10">
            <input type='text' name='name' class="form-control" id='name'
                    value='{{ old('name') }}'>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for='email'>Email</label>
        <div class="col-sm-10">
            <input type='email' name='email' class="form-control" id='email'
                    value='{{ old('email') }}'>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for='password'>Password</label>
        <div class="col-sm-10">
            <input type='password' name='password' class="form-control" id='password'>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for='password_confirmation'>Confirm Password</label>
        <div class="col-sm-10">
            <input type='password' name='password_confirmation' class="form-control" id='password_confirmation'>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
             Register
            </button>
            &#160;&#160;
            <a href="/">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     Cancel
                </button>
            </a>
        </div>
    </div>
</form>
@stop
