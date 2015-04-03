<!DOCTYPE html>
<html>
    <head>
        <base href="{{ env('BASE_PATH') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Seite') &raquo; {{ env('SITE_TITLE') }} </title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>
<body>

<div class="navbar navbar-default visible-xs" role="navigation">
    <div class="navbar-header">
        <span class="navbar-brand">Alarm2SMS</span>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#xs-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>

    </div>

    <div class="collapse navbar-collapse" id="xs-navbar-collapse">
        @include('include.menulist', ['nav_classes' => 'nav navbar-nav'])
    </div>
</div>


<div class="container">
    <div class="row hidden-xs">
        <div class="col-sm-12">
            <h1>{{ env('SITE_TITLE') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 hidden-xs">
            <h2>Navigation</h2>

            @include('include.menulist', ['nav_classes'=>'nav nav-pills nav-stacked'])
        </div>

        <div class="col-sm-9 col-xs-12">
            @yield('subnav')

            @if(Session::has('flash_message'))
            <div class="alert {{ Session::has('flash_message_class') ? Session::get('flash_message_class') : 'alert-success' }}">{{ Session::get('flash_message') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @yield('content')
        </div>
    </div>


</div>

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>