@extends('layouts.master')

@section('title')
Change Your Password
@stop

@section('page_header')
<h1>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Change Your Password
    </span>
</h1>
@stop

@section('content')
<form method="POST" action="/user/edit/password" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $user->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Current Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="inputCurrentPassword"  id="inputCurrentPassword"
                    placeholder="Current password" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="inputNewPassword" id="inputNewPassword"
                    placeholder="New password" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="inputConfirmPassword" id="inputConfirmPassword"
                    placeholder="Confirm password" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            Update
            </button>
            &#160;&#160;
            <a href="/user">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     Cancel
                </button>
            </a>
        </div>
    </div>
</form>
@stop
