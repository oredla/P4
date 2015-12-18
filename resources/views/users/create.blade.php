@extends('layouts.master')

@section('title')
Add a New User
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Add a New User
    </span>
</h2>
@stop

@section('content')
    @if($access)
    <form method="POST" action="/user/create" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="inputName"
                        placeholder="Name of the User"
                        value="{{ old('inputName') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="inputPassword"
                        placeholder="Password"
                        value="{{ old('inputPassword') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="inputEmail"
                        placeholder="Please provide an email for account sign in."
                        value="{{ old('inputEmail') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">User Role</label>
            <div class="col-sm-10">
                <select id='inputUserRole' name='inputUserRole' class='form-control'>
                    <option value='admin'
                        @if(old('inputUserRole') == 'admin')
                            SELECTED
                        @endif>
                        Admin
                    </option>
                    <option value='member'
                        @if(old('inputUserRole') == 'member')
                             SELECTED
                        @endif>
                        Member
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">User Group</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="inputUserGroup"
                        placeholder="User Group"\
                        value="{{ old('inputUserGroup') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">User Verified?</label>
            <div class="col-sm-10">
                <input type="checkbox" name="inputUserVerified"
                        value="{{ old('inputUserVerified') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                 Update
                </button>
                &#160;&#160;
                <a href="/users">
                    <button type="button" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                         Cancel
                    </button>
                </a>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-danger">You don't have access to create a new user.</div>
    <div class="form-group">
        <div class="col-sm-12">
            <a href="/">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     Return to home page
                </button>
            </a>
        </div>
    </div>
    @endif
@stop
