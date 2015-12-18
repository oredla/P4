@extends('layouts.master')

@section('title')
    @if($access && $edit)
        Editing
    @else
        Viewing
    @endif
    Timeslots for {{ $timeslot->room->room_name }}
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.5em;">
        Timeslots for {{ $timeslot->room->room_name }}
    </span>
    @if($access)
        @if(!$edit)
            <a href="/timeslots/edit/{{ $timeslot->id }}">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                     Edit
                </button>
            </a>
        @else
            <a href="/timeslots/confirm-delete/{{ $timeslot->id }}">
                <button type="button" class="btn btn-default btn-lg btn-danger">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                     Delete this room
                </button>
            </a>
        @endif
    @endif
</h2>
@stop

@section('content')
<form method="POST" action="/timeslots/edit/{{$timeslot->id}}" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $timeslot->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name</label>
        <div class="col-sm-10">
            @if($access & $edit)
                <select id='inputRoomID' name='inputRoomID' class="form-control">
                    @foreach($rooms_for_dropdown as $room_id => $room_name)
                        {{ $selected = ( old('inputRoomID') == $room_id) ? 'SELECTED' : '' }}
                        <option value='{{ $room_id }}' {{ $selected }}>
                            {{ $room_name }}
                        </option>
                    @endforeach
                </select>
            @else
                <p class="form-control-static">{{ $timeslot->room->room_name }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available From</label>
        <div class="col-sm-10">
            @if($access & $edit)
                <input type="time" class="form-control" name="inputAvailableFrom"
                        placeholder="Available From Time"
                        value="{{ $timeslot->available_from }}">
            @else
                <p class="form-control-static">{{ $timeslot->available_from }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available Until</label>
        <div class="col-sm-10">
            @if($access & $edit)
                <input type="time" class="form-control" name="inputAvailableUntil"
                        placeholder="Available Until Time"
                        value="{{ $timeslot->available_until }}">
            @else
                <p class="form-control-static">{{ $timeslot->available_until }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Available Weekdays</label>
        <div class="col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputSun" value="1000000"
                    @if(intval($timeslot->available_weekdays/1000000))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Sun
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputMon" value="100000"
                    @if(intval($timeslot->available_weekdays/100000 % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Mon
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputTue" value="10000"
                    @if(intval($timeslot->available_weekdays/10000 % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Tue
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputWed" value="1000"
                    @if(intval($timeslot->available_weekdays/1000 % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Wed
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputThu" value="100"
                    @if(intval($timeslot->available_weekdays/100 % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Thu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputFri" value="10"
                    @if(intval($timeslot->available_weekdays/10 % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Fri
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="inputSat" value="1"
                    @if(intval($timeslot->available_weekdays % 10))
                         checked
                    @endif
                    @if(!$access || !$edit)
                        disabled
                    @endif> Sat
                </label>
            </div>
        </div>
    </div>
    @if($access & $edit)
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
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/timeslots">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     Return to timeslots listing
                </button>
            </a>
        </div>
    </div>
    @endif
</form>
@stop
