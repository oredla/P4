<!doctype html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'Room Reservations App' --}}
        @yield('title','BCEC Room Reservations App')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    {{-- main.css includes general items that needs styling,
      with some !important added to override the default setting from Bootstrap --}}
    <link href="/css/main.css" type='text/css' rel='stylesheet'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    {{-- Theme --}}
    {{-- <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.min.css"/> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"/>

    {{-- Yield any page specific CSS files or anything else you might want in the head tag --}}
    @yield('head')

</head>
<body>
  <div class='container'>
        @if(\Session::has('flash_message'))
            <div class='alert alert-warning hidden-print' role='alert'>
            <!-- flash_message -->
                {{ \Session::get('flash_message') }}
            </div>
        @endif
        @if(count($errors) > 0)
        <div class='alert alert-danger hidden-print' role='alert'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li><span class='fa fa-exclamation-circle'></span>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <header class="hidden-print">
            {{-- calls for the header of the HTML page, including the navigation bar that is within the HEADER.BLADE.PHP --}}
            @include('layouts.header')
        </header>

        <section id="page_header">
            @yield('page_header')
        </section>
        <section>
            {{-- Main page content will be yielded here --}}
            @yield('content')
        </section>

        <footer class="footer hidden-print">
          <div class="container navbar-fixed-bottom">
            {{-- calls the FOOTER.BLADE.PHP for the footer credit as well as the BREADCRUMB. --}}
            @include('layouts.footer')
          </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


        {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
        @yield('body')
    </div>
</body>
</html>
