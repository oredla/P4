@extends('layouts.master')

@section('title')
List of All Reservations
@stop

@section('page_header')
    <h1 class="textcenter">List of All Reservations</h1>
@stop

@section('content')
    @if(!is_null($reservations))
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1em;font-weight:bold;">
                    <td>
                        Date of Event
                        @if($access)<br><i>Requested By</i> @endif
                    </td>
                    <td width=300>
                        Room Name
                        @if($access)<br><i>Description</i> @endif
                    </td>
                    <td>
                        Start Time
                        @if($access)<br><i>Status</i> @endif
                    </td>
                    <td width=170>
                        End Time
                        @if($access)<br><i>Status Notes</i>  @endif
                    </td>
                    <td>
                        User Group
                        @if($access)<br><i>Approved By</i> @endif
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
                        @if($access)
                            <a href='/reservations/edit/{{$reservation->id}}'>
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="/reservations/approve/{{$reservation->id}}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                            </a>
                            <a href="/reservations/confirm-delete/{{$reservation->id}}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                            </a>
                        @else
                            <a href='/reservations/view/{{$reservation->id}}'>
                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            </a>
                        @endif
                        </a>
                    </td>
                </tr>
                @if($access)
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
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <h3 class="textcenter">No Reservations found</h3>
    @endif
@stop
