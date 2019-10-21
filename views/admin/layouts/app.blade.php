<html>
    <head>
        <title>Garbage CMS</title>
        <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
        <meta name="csrf_token" content="{{ csrf_token() }}">
    </head>
    <body>
        @yield('content')
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{ mix('js/admin/app.js') }}"></script>
    </body>
</html>