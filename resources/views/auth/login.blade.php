@extends('layouts.master')

@section('title')
Login
@stop

@section('page_header')
<h1>
    Login Now
</h1>
@stop

@section('content')
<p>Don't have an account? <a href='/register'>Register here...</a></p>
<form method="POST" action="/login" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
        <label class="col-sm-2 control-label" for='remember'>Remember me</label>
        <div class="col-sm-10">
            <input type='checkbox' name='remember' id='remember'>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
             Login
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
