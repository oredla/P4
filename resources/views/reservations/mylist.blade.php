@extends('layouts.master')

@section('title')
My Reservations
@stop

@section('page_header')
    <h1 class="textcenter">My Reservations</h1>
@stop

@section('content')
    @if(!is_null($reservations))
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
            @endforeach
            </tbody>
        </table>
    @else
        <h3 class="textcenter">No Reservations found</h3>
    @endif
@stop
