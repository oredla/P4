@extends('layouts.master')

@section('title')
List of Reservations for {{ $reservations->first()->room->room_name }}
@stop


@section('page_header')
<h1>
    List of Reservations for <strong>{{ $reservations->first()->room->room_name }}</strong>
</h1>
@if(Auth::check())
    @if(!str_contains(Request::getRequestUri(), "/rooms/reservations/all"))
        <a href="/rooms/reservations/all/{{$reservations->first()->room->id}}">
            <button type="button" class="btn btn-default btn-md">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                 View All Past and Upcoming Reservations
            </button>
        </a>
    @else
        <a href="/rooms/reservations/{{$reservations->first()->room->id}}">
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
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{$reservation->date_of_event}}</td>
                    <td>{{$reservation->start_time}}</td>
                    <td>{{$reservation->end_time}}</td>
                    <td>{{$reservation->user_group}}</td>
                    <td>{{$reservation->user->id}}</td>
                    <td>{{$reservation->status}}</td>
                    <td><a href="/reservation"
                </tr>
            </tbody>
            @endforeach
        </table>
    @else
        <h3 class="textcenter">No reservations found for this room.</h3>
    @endif
@stop
