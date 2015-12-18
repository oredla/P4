@extends('layouts.master')

@section('title')
List of Timeslots
@stop

@section('page_header')
    <h1 class="textcenter">List of Timeslots</h1>
@stop

@section('content')
    @if(!is_null($timeslots))
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1.2em;font-weight:bold;">
                    <td>Room Name
                        <span style="font-size:0.8em;font-weight:normal;">
                            (click on a room to make a reservation.)
                        </span>
                    </td>
                    <td>Available From</td>
                    <td>Available Until</td>
                    <td>Available Days</td>
                    <td class="textcenter">Action(s)</td>
                </tr>
            </thead>
            <tbody>
            @foreach($timeslots as $timeslot)
                <tr>
                    <td><a href='/reservations/{{$timeslot->room_id}}/create'>
                        {{ $timeslot->room->room_name }}</a></td>
                    <td>{{ $timeslot->available_from }}</td>
                    <td>{{ $timeslot->available_until }}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Weekdays Group">
                            <div class="btn-group" role="group" aria-label="Weekdays">
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/1000000))
                                        disabled
                                    @endif>Sun
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/100000 % 10))
                                        disabled
                                    @endif>Mon
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/10000 % 10))
                                        disabled
                                    @endif>Tue
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/1000 % 10))
                                        disabled
                                    @endif>Wed
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/100 % 10))
                                        disabled
                                    @endif>Thu
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays/10 % 10))
                                        disabled
                                    @endif>Fri
                                </button>
                                <button type="button" class="btn btn-default"
                                    @if(!intval($timeslot->available_weekdays % 10))
                                        disabled
                                    @endif>Sat
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="textcenter">
                        @if($access)
                            <a href='/timeslots/edit/{{$timeslot->id}}'>
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="/timeslots/confirm-delete/{{$timeslot->id}}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        @else
                            <a href='/timeslots/view/{{$timeslot->id}}'>
                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            </a>
                        @endif
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    @else
        <h3 class="textcenter">No Timeslots found</h3>
    @endif
@stop
