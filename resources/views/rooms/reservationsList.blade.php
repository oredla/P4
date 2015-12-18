@extends('layouts.master')

@section('title')
List of Reservations for {{ \App\Room::find($room_id)->room_name }}
@stop


@section('page_header')
<h1>
    List of Reservations for <strong>{{ \App\Room::find($room_id)->room_name }}</strong>
</h1>
@if(Auth::check())
    @if(!str_contains(Request::getRequestUri(), "/rooms/roomReservations/all"))
        <a href="/rooms/roomReservations/all/{{$room_id}}">
            <button type="button" class="btn btn-default btn-md">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                 View All Past and Upcoming Reservations
            </button>
        </a>
    @else
        <a href="/rooms/roomReservations/{{$room_id}}">
            <button type="button" class="btn btn-default btn-md">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                 View Only Upcoming Reservations
            </button>
        </a>
    @endif
@endif
@stop

@section('content')
    @if(!is_null($reservations))
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1.2em;font-weight:bold;">
                    <td>Date of Event</td>
                    <td>Start Time</td>
                    <td>End Time</td>
                    <td>Group Reserved</td>
                    <td>Reserved By</td>
                    <td>Status</td>
                    <td class="textcenter">Action(s)</td>
                </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{$reservation->date_of_event}}</td>
                    <td>{{$reservation->start_time}}</td>
                    <td>{{$reservation->end_time}}</td>
                    <td>{{$reservation->user_group}}</td>
                    <td>{{\App\User::find($reservation->user->id)->name}}</td>
                    <td>{{$reservation->status}}</td>
                    <td class="textcenter">
                        @if($access)
                            <a href='/reservations/view/{{$reservation->id}}'>
                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            </a>
                            <a href='/reservations/edit/{{$reservation->id}}' style="padding-left:1em;">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="/reservations/pending/{{ $reservation->id }}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        @else
                            <a href='/reservations/view/{{$reservation->id}}'>
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
        <h3 class="textcenter">No reservations found for this room.</h3>
    @endif
@stop
