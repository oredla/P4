@extends('layouts.master')

@section('title')
Delete A Room
@stop

@section('page_header')
    <h2 class="textcenter">Deleting Room: {{ $delete_room->room_name }}?</h2>
@stop

@section('content')
<div class="textcenter">
    <strong>
        Please confirm you want to delete this room:
    </strong>
<form method="POST" action="/rooms/delete" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='delete_id' value='{{ $delete_room->id }}'>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default btn-lg btn-danger">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
             Delete
            </button>
            &#160;&#160;
            <a href="/rooms">
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
