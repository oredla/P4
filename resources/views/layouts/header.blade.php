{{-- HEADER.BLADE.PHP --}}
{{-- header with Site's name and the 'title' name of the tool --}}
{{-- navigation menubar --}}
<a class="hidden-xs" href='/' style="padding:0;">
    <img
    src='/images/room-res-logo.png'
    style='width:700px'
    alt='Room Reservations App Logo'>
</a>

@section('menu')
<nav class="navbar navbar-default">
    <div class="container-fluid"><!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>
            <span class="hidden-md hidden-lg hidden-sm">
                <a class="navbar-brand" href='/' style="padding:5px;">
                    <img
                    src='/images/room-res-logo.png'
                    style='width:250px;'
                    alt='Room Reservations App Logo'
                    align='middle'>
                </a>
            </span>
        </div><!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigationbar">
            <ul class="nav navbar-nav">
                {{-- regardless login or not, user will still see HOME --}}
                <li @if(Request::getRequestUri() == "/") class="active" @endif>
                    <a href='/'>Home</a>
                </li>
                {{-- There are IF tests to set test which page we are currently on and highlight the page as active --}}
                @if(Auth::check())
                    <li @if(Request::getRequestUri() == "/user") class="active" @endif>
                        <a href='/user'>{{ $user->name }}</a>
                    </li>
                    <li @if(Request::getRequestUri() == "/rooms") class="active" @endif>
                        <a href='/rooms'>Rooms</a>
                    </li>
                    <li>
                        <a href='/logout'>Log out</a>
                    </li>
                @else
                    <li @if(Request::getRequestUri() == "/login") class="active" @endif>
                        <a href='/login'>Log in</a>
                    </li>
                    <li @if(Request::getRequestUri() == "/register") class="active" @endif>
                        <a href='/register'>Register</a>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@show

{{-- this will display the submenu if the tool specificially have a submenu --}}
@yield('submenu')
