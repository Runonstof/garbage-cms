<html>
    <head>
        <title>Garbage CMS</title>
        <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
        <meta name="csrf_token" content="{{ csrf_token() }}">
    </head>
    <body>
        @yield('content')
        
        <script type="text/javascript" src="{{ mix('js/admin/app.js') }}"></script>
    </body>
</html>