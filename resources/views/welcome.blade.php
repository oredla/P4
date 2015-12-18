@extends('layouts.master')

@section('title')
@if(\Auth::check())
Welcome Back, {{ $user->name }}!
@else
Welcome, Guest!
@endif
@stop

@section('page_header')
@if(\Auth::check())
    <?php $currentHour = localtime(time(\Carbon\Carbon::now()), true)['tm_hour']?>
    <h1>
        @if($currentHour < 12)
            Good Morning,
        @elseif($currentHour >= 18)
            Good Evening,
        @else
            Good Afternoon,
        @endif
        {{ $user->name }}!
    </h1>
@endif
@stop

@section('content')
<div>
    <p>
        This is the Room Reservation App for Boston Chinese Evangelical Church (BCEC).
    </p>
    @if(\Auth::check())
        @if(!isset($reservations))
            <p>
                Here's your reservations summary:
            </p>
            <table class="table table-hover table-striped">
                <thead>
                    <tr style="font-size:1em;font-weight:bold;">
                        <td>
                            Date of Event
                            <br><i>Requested By</i>
                        </td>
                        <td width=300>
                            Room Name
                            <br><i>Description</i>
                        </td>
                        <td>
                            Start Time
                            <br><i>Status</i>
                        </td>
                        <td width=170>
                            End Time
                            <br><i>Status Notes</i>
                        </td>
                        <td>
                            User Group
                            <br><i>Approved By</i>
                        </td>
                        <td class="textcenter">
                            Action(s)
                        </td>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date_of_event }}</td>
                        <td>{{ $reservation->room->room_name }}</td>
                        <td>{{ $reservation->start_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                        <td>{{ $reservation->user_group }}</td>
                        <td class="textcenter">
                            <a href='/reservations/edit/{{$reservation->id}}'>
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="/reservations/confirm-delete/{{$reservation->id}}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><i>
                            {{ \App\User::find($reservation->user->id)->name }}
                        </i></td>
                        <td><i>{{$reservation->description_of_event}}</i></td>
                        <td><i>{{$reservation->status}}</i></td>
                        <td><i>{{$reservation->status_notes}}</i></td>
                        <td><i>
                            @if($reservation->approved_by > 0)
                                {{\App\User::find($reservation->approved_by)->name}}
                            @endif
                        </i></td>
                        <td></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        @else
            <h3 class="textcenter">You currently have no room reservations.</h3>
        @endif
    @else
        <p>
            Please <a href="/login">sign in</a> or <a href="/register">register</a> to request a room reservation.
        </p>
        <p>
            You can also view current available <a href="/rooms">rooms</a>,
                <a href="/timeslots">timeslots</a>, and <a href="/reservations">reservations</a>
                 without signing up for an account.
        </p>
    @endif
</div>
@stop
