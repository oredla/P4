@extends('layouts.master')

@section('title')
    @if($access)
        Editing
    @else
        Viewing
    @endif
    {{ $room->room_name }}
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Information for {{ $room->room_name }}
    </span>
    @if($access)
        <a href="/rooms/confirm-delete/{{ $room->id }}" style="float:right;">
            <button type="button" class="btn btn-default btn-md btn-danger">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                 Delete this room
            </button>
        </a>
    @endif
</h2>
@stop

@section('content')
<form method="POST" action="/rooms/edit/{{$room->id}}" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $room->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name</label>
        <div class="col-sm-10">
            @if($access)
                <input type="text" class="form-control" name="inputRoomName"
                        placeholder="Name of the Room"
                        value="{{ $room->room_name }}">
            @else
                <p class="form-control-static">{{ $room->room_name }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Location</label>
        <div class="col-sm-10">
            @if($access)
                <input type="text" class="form-control" name="inputRoomLocation"
                        placeholder="Room Location (A brief description)"
                        value="{{ $room->room_location }}">
            @else
                <p class="form-control-static">{{ $room->room_location }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Maximum Capacity</label>
        <div class="col-sm-10">
            @if($access)
                <input type="number" class="form-control" name="inputRoomMaxPpl"
                        placeholder="Maximum Capacity Allowed" min="1"
                        value="{{ $room->room_max_ppl }}">
            @else
                <p class="form-control-static">{{ $room->room_max_ppl }}</p>
            @endif
        </div>
    </div>
    @if($access)
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                 Update
                </button>
                &#160;&#160;
                <a href="/rooms">
                    <button type="button" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                         Cancel
                    </button>
                </a>
            </div>
        </div>
    @else
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/rooms">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     Return to previous page
                </button>
            </a>
        </div>
    </div>
    @endif
</form>
@stop
