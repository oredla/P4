@extends('layouts.master')

@section('title')
List of Rooms
@stop

@section('page_header')
    <h1 class="textcenter">List of Rooms</h1>
@stop

@section('content')
    @if(!is_null($rooms))
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1.2em;font-weight:bold;">
                    <td>Rooms
                        <span style="font-size:0.8em;font-weight:normal;">
                        (Click on the room to see reservations under each room)
                        </span>
                    </td>
                    <td>Location</td>
                    <td class="textcenter">Maximum People</td>
                    <td class="textcenter">Action(s)</td>
                </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td><a href='/rooms/roomReservations/{{$room->id}}'>
                        {{ $room->room_name }}</a></td>
                    <td>{{ $room->room_location }}</td>
                    <td class="textcenter">{{ $room->room_max_ppl }}</td>
                    <td class="textcenter">
                        @if($access)
                            <a href='/rooms/edit/{{$room->id}}'>
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="/rooms/confirm-delete/{{ $room->id }}" style="padding-left:1em;">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        @else
                            <a href='/rooms/edit/{{$room->id}}'>
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
        <h3 class="textcenter">No Rooms found</h3>
    @endif
@stop
