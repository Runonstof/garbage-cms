<html>
    <head>
        <title>Garbage CMS</title>
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>
        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    </body>
</html>