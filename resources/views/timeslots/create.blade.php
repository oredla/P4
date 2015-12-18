@extends('layouts.master')

@section('title')
Add a New Timeslot
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Add a New Timeslot
    </span>
</h2>
@stop

@section('content')
    @if($access)
<form method="POST" action="/timeslots/create" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name</label>
        <div class="col-sm-10">
            <select id='inputRoomName' name='inputRoomID' class="form-control">
                @foreach($rooms_for_dropdown as $room_id => $room_name)
                    {{ $selected = ( old('inputRoomID') == $room_id) ? 'SELECTED' : '' }}
                    <option value='{{ $room_id }}' {{ $selected }}>
                        {{ $room_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available From</label>
        <div class="col-sm-10">
            <input type="time" class="form-control" name="inputAvailableFrom"
                    placeholder="Available From Time"
                    value="{{ old('inputAvailableFrom') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available Until</label>
        <div class="col-sm-10">
            <input type="time" class="form-control" name="inputAvailableUntil"
                    placeholder="Available Until Time"
                    value="{{ old('inputAvailableUntil') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available Weekdays</label>
        <div class="col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputSun" value="1000000"
                    @if(null != old('inputSun'))
                        checked
                    @endif>
                    Sun
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputMon" value="100000">
                    Mon
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputTue" value="10000">
                    Tue
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputWed" value="1000">
                    Wed
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputThu" value="100">
                    Thu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputFri" value="10">
                    Fri
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputSat" value="1">
                    Sat
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
             Update
            </button>
            &#160;&#160;
            <a href="/timeslots">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     Cancel
                </button>
            </a>
        </div>
    </div>
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
</form>
@stop
