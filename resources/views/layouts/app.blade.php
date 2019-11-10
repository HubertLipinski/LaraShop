<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app" class="super_container">
        @include('layouts.navbar.navbar')
        <main class="py-4">

            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('plugins/greensock/TweenMax.min.js')}}"></script>
    <script src="{{asset('plugins/greensock/TimelineMax.min.js')}}"></script>
    <script src="{{asset('plugins/owl/owl.carousel.js')}}"></script>
    <script src="{{asset('plugins/slick-1.8.0/slick.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    @yield('scripts')
</body>
</html>
