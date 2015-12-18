@extends('layouts.master')

@section('title')
List of All Users
@stop

@section('page_header')
    <h1 class="textcenter">List of All Users</h1>
@stop

@section('content')
    @if(!is_null($users) && $access)
        <table class="table table-hover table-striped">
            <thead>
                <tr style="font-size:1em;font-weight:bold;">
                    <td>
                        Name
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        User Role
                    </td>
                    <td>
                        User Group
                    </td>
                    <td>
                        User Verified
                    </td>
                    <td>Action(s)</td>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_role }}</td>
                    <td>{{ $user->user_group }}</td>
                    <td>{{ $user->user_verified }}</td>
                    <td class="textcenter">
                        <a href="/user/confirm-delete/{{$user->id}}" style="padding-left:1em;">
                            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="textcenter">No Reservations found</h3>
    @endif
@stop
