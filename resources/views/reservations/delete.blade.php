@extends('layouts.master')

@section('title')
Delete A Reservation
@stop

@section('page_header')
    <h2 class="textcenter">Deleting A Reservation for: {{ $delete_res->room->room_name }}?</h2>
@stop

@section('content')
<div class="textcenter">
    <strong>
        Please confirm you want to delete this timeslot:
    </strong>
    @if(!is_null($delete_res))
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
                    <td>
                        End Time
                        <br><i>Status Notes</i>
                    </td>
                    <td>
                        User Group
                        <br><i>Approved By</i>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $delete_res->date_of_event }}</td>
                    <td>{{ $delete_res->room->room_name }}</td>
                    <td>{{ $delete_res->start_time }}</td>
                    <td>{{ $delete_res->end_time }}</td>
                    <td>{{ $delete_res->user_group }}</td>
                </tr>
                <tr>
                    <td><i>
                        {{ \App\User::find($delete_res->user->id)->name }}
                    </i></td>
                    <td><i>{{$delete_res->description_of_event}}</i></td>
                    <td><i>{{$delete_res->status}}</i></td>
                    <td><i>{{$delete_res->status_notes}}</i></td>
                    <td><i>
                        @if($delete_res->approved_by > 0)
                            {{\App\User::find($delete_res->approved_by)->name}}
                        @endif
                    </i></td>
                </tr>
            </tbody>
        </table>
    @endif
<form method="POST" action="/reservations/delete" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='hidden' name='id' value='{{ $user->id }}'>
    <input type='hidden' name='delete_id' value='{{ $delete_res->id }}'>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default btn-lg btn-danger">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
             Delete
            </button>
            &#160;&#160;
            <a href="/reservations">
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
