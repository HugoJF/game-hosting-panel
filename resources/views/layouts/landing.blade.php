<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Host de_nerdTV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&subset=latin" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/landing_critical.min.css') }}" rel="stylesheet">
</head>
<body class="custom-gradient text-black">

@yield('content')

<link href="{{ mix('css/landing.css') }}" rel="stylesheet">
@stack('scripts')
</body>
</html>
