<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
</head>

<body class="c-app  flex-row align-items-center">
    <div class="container" id="app">
        @yield('content')
    </div>
    <!--<![endif]-->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>