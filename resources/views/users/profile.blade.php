@extends('layouts.master')

@section('title')
    @if(!$edit)
        View
    @else
        Edit
    @endif
    {{ $user->name }}&#39;s Profile
@stop

@section('page_header')
<h1>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        {{ $user->name }}&#39;s Profile
    </span>
    @if(!$edit)
        <a href="/user/edit">
            <button type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                 Edit
            </button>
        </a>
    @else
        <a href="/user/confirm-delete/{{ $user->id }}">
            <button type="button" class="btn btn-default btn-lg btn-danger">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                 Delete this account
            </button>
        </a>
    @endif
</h1>
@stop

@section('content')
<form method="POST" action="/user/edit" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $user->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            @if($edit)
                <input type="text" class="form-control" name="inputName"
                        placeholder="username"
                        value="{{ $user->name }}">
            @else
                <p class="form-control-static">{{ $user->name }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            @if($edit)
                <input type="email" class="form-control" name="inputEmail"
                        placeholder="Email"
                        value="{{ $user->email }}">
            @else
                <p class="form-control-static">{{ $user->email }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
                <p class="form-control-static">**************
                    <a href="/user/edit/password"  style="padding-left:1em;">
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                             Change Password
                        </button>
                    </a>
                </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Role</label>
        <div class="col-sm-10">
            @if($edit && $user->user_role == 'admin')
                <input type="text" class="form-control" name="inputUserRole"
                        placeholder="User Role"
                        value="{{ $user->user_role }}">
            @else
                <p class="form-control-static">{{ $user->user_role }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Group</label>
        <div class="col-sm-10">
            @if($edit)
                <input type="text" class="form-control" name="inputUserGroup"
                        placeholder="User Group"
                        value="{{ $user->user_group }}">
            @else
                <p class="form-control-static">{{ $user->user_group }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Verification Status</label>
        <div class="col-sm-10">
            @if($edit)
                @if($user->user_role == 'admin')
                    <input type="checkbox" class="form-control" name="inputUserVerified"
                            placeholder="Verification Status" style="align:left;"
                            @if($user->user_verified == 1)
                                checked
                            @endif>
                @else
                    <p class="form-control-static">
                    @if($user->user_verified == 1)
                    <span class="alert alert-success">
                        <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                        You are verified!
                    </span>
                    @else
                    <span class="alert alert-danger">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        Verification Pending
                    </span>
                    @endif
                    </p>
                @endif
            @else
                <p class="form-control-static">
                @if($user->user_verified == 1)
                <span class="alert alert-success">
                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                    You are verified!
                </span>
                @else
                <span class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    Verification Pending
                </span>
                @endif
                </p>
            @endif
        </div>
    </div>
    @if($edit)
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
    @endif
</form>
@stop
