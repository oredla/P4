@extends('layouts.master')

@section('title')
Add a New Room
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Add a New Room
    </span>
</h2>
@stop

@section('content')
    @if($access)
    <form method="POST" action="/rooms/create" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type='hidden' name='id' value='{{ $user->id }}'>
        <div class="form-group">
            <label class="col-sm-2 control-label">Room Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="inputRoomName"
                        placeholder="Name of the Room"
                        value="{{ old('inputRoomName') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Room Location</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="inputRoomLocation"
                        placeholder="Room Location (A brief description)"
                        value="{{ old('inputRoomLocation') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Maximum Capacity</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="inputRoomMaxPpl"
                        placeholder="Maximum Capacity Allowed" min="1"
                        value="{{ old('inputRoomMaxPpl') }}">
            </div>
        </div>
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
    </form>
    @else
    <div class="alert alert-danger">You don't have access to create a new room.</div>
    <div class="form-group">
        <div class="col-sm-12">
            <a href="/rooms">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     Return to rooms listing
                </button>
            </a>
        </div>
    </div>
    @endif
@stop
