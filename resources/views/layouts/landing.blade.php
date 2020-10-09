<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hospedagem de servidores de jogos - de_nerdTV</title>

    <meta name="description" content="Hospedagem de CS:GO, Minecraft e CoD4 no Brasil com proteção DDoS">
    <meta property="og:description" content="Hospedagem de CS:GO, Minecraft e CoD4 no Brasil com proteção DDoS"/>
    <meta property="og:title" content="Hospedagem de servidores de jogos - de_nerdTV"/>
    <meta property="og:url" content="https://host.denerdtv.com/"/>
    <meta property="og:type" content="website"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&subset=latin" rel="stylesheet">

    @if(file_exists(public_path('css/landing-critical.css')))
        <!-- Critical CSS -->
        <style>
            {!! file_get_contents(public_path('css/landing-critical.css')) !!}
        </style>

        <!-- Styles -->
        <link rel="preload" href="{{ mix('css/landing.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ mix('css/landing.css') }}"></noscript>
    @else
        <link rel="stylesheet" href="{{ mix('css/landing.css') }}">
    @endif
</head>
<body class="custom-gradient text-black font-sans">

@yield('content')

@stack('scripts')

@include('analytics')

</body>
</html>
