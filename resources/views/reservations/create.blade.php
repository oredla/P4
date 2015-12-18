@extends('layouts.master')

@section('title')
Add a new reservation
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Add a new reservation
    </span>
</h2>
@stop

@section('content')
<form method="POST" action="/reservations/{{$room->id}}/create" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $user->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Reserved By</label>
        <div class="col-sm-10">
            <p class="form-control-static">{{ $user->name }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Group</label>
        <div class="col-sm-10">
            <input type="test" class="form-control" name="inputUserGroup"
                    placeholder="User Group"
                    value="{{ old('inputUserGroup') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name</label>
        <div class="col-sm-10">
            <select id='inputRoomID' name='inputRoomID' class="form-control">
                @foreach($rooms_for_dropdown as $room_id => $room_name)
                    {{ $selected = ($room->id == $room_id) ? 'SELECTED' : '' }}
                    <option value='{{ $room_id }}' {{ $selected }}>
                        {{ $room_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date of Event</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="inputDateOfEvent"
                    placeholder="Date of Event"
                    value="{{ old('inputDateOfEvent') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Start Time</label>
        <div class="col-sm-10">
            <input type="time" class="form-control" name="inputStartTime"
                    placeholder="Start Time"
                    value="{{ old('inputStartTime') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">End Time</label>
        <div class="col-sm-10">
            <input type="time" class="form-control" name="inputEndTime"
                    placeholder="End Time"
                    value="{{ old('inputEndTime') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Expected Number of Attendees</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="inputNumOfAttendees"
                    placeholder="Expected Number of Attendees"
                    value="{{ old('inputNumOfAttendees') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Description of Event</label>
        <div class="col-sm-10">
            <textarea rows="4" cols="50"class="form-control"
                    name="inputDescriptions" placeholder="Status Notes">
                    {{ trim(old('inputDescriptions')) }}
            </textarea>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
             Update
            </button>
            &#160;&#160;
            <a href="/reservations">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     Cancel
                </button>
            </a>
        </div>
    </div>
</form>
@stop
