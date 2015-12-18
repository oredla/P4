{{-- breadcrumb is on the LEFT, while credit is on the RIGHT of the navbar-fixed-bottom --}}
@section('breadcrumb')
    <ol class="breadcrumb hidden-xs hidden-sm">
        <li><a href="/">home</a></li>
        @if(str_contains(Request::getRequestUri(), "/user"))
            <li><a href="/user">Profle</a></li>
        @endif
        @if(str_contains(Request::getRequestUri(), "/rooms"))
            <li><a href="/rooms">Rooms</a></li>
        @endif
        @if(str_contains(Request::getRequestUri(), "/timeslots"))
            <li><a href="/timeslots">Timeslots</a></li>
        @endif
        @if(str_contains(Request::getRequestUri(), "/reservations"))
            <li><a href="/reservations">Reservations</a></li>
        @endif
        <li class="active">@yield('title')</li>
    </ol>
@show
