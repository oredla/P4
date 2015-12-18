@extends('layouts.master')

@section('title')
    @if(($access || $reservation->user->id == $user->id) && $edit)
        Editing
    @else
        Viewing
    @endif
    Reservation for {{ \App\Room::find($reservation->room_id)->room_name }}
        on {{ $reservation->date_of_event }}, {{ $reservation->start_time }}
@stop

@section('page_header')
<h2>
    <span style="padding-right:1em;vertical-align: middle;font-size:1.2em;">
        Reservation for {{ $reservation->date_of_event }} at {{ $reservation->start_time }}
    </span>
</h2>
@stop

@section('content')
<form method="POST" action="/reservations/edit" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $reservation->id }}'>
    <div class="form-group">
        <label class="col-sm-2 control-label">Reserved By</label>
        <div class="col-sm-10">
            <p class="form-control-static">{{ $reservation->user->name }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <select id='inputRoomName' name='inputRoomID' class="form-control">
                    @foreach($rooms_for_dropdown as $room_id => $room_name)
                        {{ $selected = ( old('inputRoomID') == $room_id) ? 'SELECTED' : '' }}
                        <option value='{{ $room_id }}' {{ $selected }}>
                            {{ $room_name }}
                        </option>
                    @endforeach
                </select>
            @else
                <p class="form-control-static">{{ $reservation->room->room_name }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date of Event</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <input type="date" class="form-control" name="inputDateOfEvent"
                        placeholder="Date of Event"
                        value="{{ $reservation->date_of_event }}">
            @else
                <p class="form-control-static">{{ $reservation->date_of_event }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Start Time</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <input type="time" class="form-control" name="inputStartTime"
                        placeholder="Start Time"
                        value="{{ $reservation->start_time }}">
            @else
                <p class="form-control-static">{{ $reservation->start_time }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">End Time</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <input type="time" class="form-control" name="inputEndTime"
                        placeholder="End Time"
                        value="{{ $reservation->end_time }}">
            @else
                <p class="form-control-static">{{ $reservation->end_time }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Expected Number of Attendees</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <input type="number" class="form-control" name="inputNumOfAttendees"
                        placeholder="Expected Number of Attendees"
                        value="{{ $reservation->expected_num_of_attendees }}">
            @else
                <p class="form-control-static">{{ $reservation->expected_num_of_attendees }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Description of Event</label>
        <div class="col-sm-10">
            @if(($access || $reservation->user->id == $user->id) & $edit)
                <textarea rows="4" cols="50"class="form-control"
                        name="inputDescription" placeholder="Status Notes">
                        {{ trim($reservation->description_of_event) }}
                </textarea>
            @else
                <p class="form-control-static">{{ $reservation->description_of_event }}</p>
            @endif
        </div>
    </div>
    <div class="alert-info" style="padding: 1em 0.5em 1em 0;">
        {{-- these functions are for ADMIN ONLY  --}}
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                @if($access & $edit)
                    <input type="text" class="form-control" name="inputStatus"
                            placeholder="End Time"
                            value="{{ $reservation->status }}">
                @else
                    <p class="form-control-static">{{ $reservation->status }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status Notes</label>
            <div class="col-sm-10">
                @if($access & $edit)
                    <textarea rows="4" cols="50"class="form-control"
                            name="inputStatusNotes" placeholder="Status Notes">
                            {{ trim($reservation->status_notes) }}
                    </textarea>
                @else
                    <p class="form-control-static">{{ $reservation->status_notes }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Approved By</label>
            <div class="col-sm-10">
                @if($access & $edit)
                    <select id='inputApprovedBy' name='inputApprovedBy' class="form-control">
                        @foreach($admins_for_dropdown as $id => $name)
                                {{ $selected = ( old('inputApprovedBy') == $id) ? 'SELECTED' : '' }}
                                <option value='{{ $id }}' {{ $selected }}>
                                {{ $name }}
                                </option>
                        @endforeach
                    </select>
                @else
                    <p class="form-control-static">{{ \App\User::find($reservation->approved_by)->name }}</p>
                @endif
            </div>
        </div>
    </div>
    <br>
    @if(($access || $reservation->user->id == $user->id) & $edit)
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
    @else
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/reservations">
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     Return to reservations listing
                </button>
            </a>
        </div>
    </div>
    @endif
</form>
@stop
