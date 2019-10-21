<html>
    <head>
        <title>Garbage CMS</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <meta name="csrf_token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app{{ isset($class) ? ' '.$class : '' }}">
            @yield('content')
        </div>
        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    </body>
</html>