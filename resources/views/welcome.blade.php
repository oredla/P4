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
        <p>
            Here's your reservations summary:
        </p>
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
