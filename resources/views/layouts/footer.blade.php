{{-- breadcrumb is on the LEFT, while credit is on the RIGHT of the navbar-fixed-bottom --}}
@section('breadcrumb')
    <ol class="breadcrumb hidden-xs hidden-sm">
        <li><a href="/">home</a></li>
        <li class="active">@yield('title')</li>
        <span style="float:right;">&copy; {{ date('Y') }} &nbsp;&nbsp;</span>
    </ol>
@show
