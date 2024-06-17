<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendors/@coreui/icons/css/free.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
    <style>
        #pageMessages {
            position: fixed;
            top: 70px;
            right: 15px;
            width: 30%;
        }

        .cellcolor {
            background-color: lightblue;
        }
    </style>
</head>

<body class="c-app">
    @include('layouts.sidebar')
    <div class="c-wrapper c-fixed-components" id="app">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button><a class="c-header-brand d-lg-none" href="#">
                <h3>{{ __('app.c_school_version') }}</h3>
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <ul class="c-header-nav ml-auto mr-4">
                <notifications-dropdown :user-id="{{ Auth::user()->id}}"></notifications-dropdown>
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                    </svg> {{ Auth::user()->name }}
                </li>
            </ul>
        </header>
        <div class="c-body">
            <main class="c-main">
                @yield('content')
                <div id="pageMessages">
                    @include('layouts.message_alert')
                </div>
            </main>
            <footer class="c-footer">
                <div><a href="#">{{ __('app.c_school') }}</a>{{ __('app.copy_right_date') }}</div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('template/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <!--[if IE]><!-->
    <script src="{{ asset('template/vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
    <!--<![endif]-->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>