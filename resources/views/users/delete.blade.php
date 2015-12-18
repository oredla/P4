@extends('layouts.master')

@section('title')
Delete Your Account
@stop

@section('page_header')
    <h1 class="textcenter">Deleting {{ $delete_user->name }}&#39;s account?</h1>
@stop

@section('content')
<div class="textcenter">
    <strong>
        Please confirm you want to delete this account
    </strong>
<form method="POST" action="/user/delete" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $user->id }}'>
    <input type='hidden' name='delete_id' value='{{ $delete_user->id }}'>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default btn-lg btn-danger">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
             Delete
            </button>
            &#160;&#160;
            <a href="/user">
                <button type="button" class="btn btn-default btn-lg btn-success">
                    <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                     Cancel
                </button>
            </a>
        </div>
    </div>
</form>
</div>
@stop
