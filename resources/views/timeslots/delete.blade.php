@extends('layouts.master')

@section('title')
Delete A Timeslot
@stop

@section('page_header')
    <h2 class="textcenter">Deleting A Timeslot for: {{ $delete_timeslot->room->room_name }}?</h2>
@stop

@section('content')
<div class="textcenter">
    <strong>
        Please confirm you want to delete this timeslot:
    </strong>
    @if(!is_null($delete_timeslot))
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1.2em;font-weight:bold;">
                    <td>Room Name</td>
                    <td>Available From</td>
                    <td>Available Until</td>
                    <td>Available Days</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $delete_timeslot->room->room_name }}</td>
                    <td>{{ $delete_timeslot->available_from }}</td>
                    <td>{{ $delete_timeslot->available_until }}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Weekdays Group">
                            <div class="btn-group" role="group" aria-label="Weekdays">
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/1000000))
                                        disabled
                                    @endif>Sun
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/100000 % 10))
                                        disabled
                                    @endif>Mon
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/10000 % 10))
                                        disabled
                                    @endif>Tue
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/1000 % 10))
                                        disabled
                                    @endif>Wed
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/100 % 10))
                                        disabled
                                    @endif>Thu
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays/10 % 10))
                                        disabled
                                    @endif>Fri
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($delete_timeslot->available_weekdays % 10))
                                        disabled
                                    @endif>Sat
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
<form method="POST" action="/timeslots/delete" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='delete_id' value='{{ $delete_timeslot->id }}'>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default btn-lg btn-danger">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
             Delete
            </button>
            &#160;&#160;
            <a href="/timeslots">
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
