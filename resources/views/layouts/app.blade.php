<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Home') | Host de_nerdTV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

<nav class="navbar-z flex items-center flex-no-wrap flex-col md:flex-row items-stretch justify-center sticky top-0 left-0 right-0 bg-gray-800 p-0">
    <a class="px-6 py-3 text-gray-400 text-lg no-underline w-1/5 mr-0" href="#">Servidores de_nerdTV</a>
    <div class="flex items-stretch flex-grow text-gray-400">
        {!! Form::open(['url' => route('home'), 'method' => 'GET', 'class' => 'flex items-stretch w-100']) !!}
        <input name="term" class="trans-fast py-2 px-5 w-100 bg-transparent outline-none focus:border-b focus:border-gray-500 focus:shadow-inner focus:bg-gray-200 focus:text-gray-700" type="text" placeholder="Search" aria-label="Search">
        {!! Form::close() !!}
    </div>
    <ul class="navbar-nav flex-shrink">
        <li class="h-full flex items-stretch text-nowrap">
            @auth
                <!-- TODO:VVVV fix this -->
                <a href="#" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                    <span class="mr-1 inline text-gray-400" data-feather="plus"></span>
                    <span>Criar servidor</span>
                </a>
            @endauth
            <a href="{{ route('faq') }}" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                <span class="mr-1 inline text-gray-400" data-feather="help-circle"></span>
                <span>FAQ</span>
            </a>
            @auth
                <a href="#" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                    <span class="mr-1 inline text-gray-400" data-feather="settings"></span>
                    <span>Configurações</span>
                </a>
                <a href="{{ route('logout') }}" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                    <span class="mr-1 inline text-gray-400" data-feather="log-out"></span>
                    <span>Logout</span>
                </a>
            @else
                <a href="#" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                    <span class="mr-1 inline text-gray-400" data-feather="log-in"></span>
                    <span>Login</span>
                </a>
            @endauth
        </li>
    </ul>
</nav>

<div class="w-full">
    <main class="flex flex-wrap">
        <nav class="w-1/5 light sidebar bg-gray-900">
            <div class="sidebar-sticky p-4 pt-8">
                <div class="flex flex-col px-24 mt-4 mb-4 items-center">
                    <div class="top-0 self-center p-4 justify-center items-center bg-white rounded-full shadow sm:flex">
                        <img class="h-28 w-28 rounded-full" src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/45/45be9bd313395f74762c1a5118aee58eb99b4688_full.jpg"/>
                    </div>
                    @auth
                        <a href="{{ route('orders.create') }}" class="flex items-center mt-3 font-semibold text-gray-200 no-underline">
                            <span class="m-0 mr-2 inline hover:text-white cursor-pointer" data-feather="plus-circle"></span>
                            <span class="mr-1 text-base font-light">R$</span>
                            <span>{{ number_format(Auth::user()->balance / 100, 2) }}</span>
                        </a>
                    @endauth
                </div>

                <h6 class="flex justify-between items-center px-3 mt-8 mb-4 uppercase font-normal tracking-wider text-gray-700">
                    <span>Menu</span>
                    <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                </h6>

                <!-- Home -->
                <ul class="pl-0 mb-0 flex flex-col text-sm">
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('home') }}" class="flex items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="home"></span>
                            <span class="group-hover:text-gray-400">Home</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- Servidores -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('servers.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="cpu"></span>
                            <span class="group-hover:text-gray-400">Servidores</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- Transações -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('transactions.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="credit-card"></span>
                            <span class="group-hover:text-gray-400">Transações</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- Pedidos -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('orders.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="shopping-cart"></span>
                            <span class="group-hover:text-gray-400">Pedidos</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- Coupons -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('coupons.index') }}" class="flex flex-grow items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="gift"></span>
                            <span class="group-hover:text-gray-400">Coupons</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- API -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('api-keys.index') }}" class="flex flex-grow items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="key"></span>
                            <span class="group-hover:text-gray-400">API Keys</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>

                    <!-- Admin -->
                    <li class="flex justify-between my-2 ml-3">
                        <a href="{{ route('admins.dashboard') }}" class="flex flex-grow items-center text-gray-500 no-underline text-base group">
                            <span class="group-hover:text-white" data-feather="briefcase"></span>
                            <span class="group-hover:text-gray-400">Administrative</span>
                        </a>
                        <a class="group no-underline" href="#">
                            <span class="group-hover:text-white" data-feather="help-circle"></span>
                        </a>
                    </li>
                </ul>

                <h6 class="flex justify-between items-center px-3 mt-8 mb-4 uppercase font-normal tracking-wider text-gray-700">
                    <span>Links rápidos</span>
                    <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                </h6>

                <ul class="pl-0 mb-0 flex flex-col text-sm">
                    <li class="my-2 ml-3 group">
                        <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                            <span class="mr-1 w-4 h-4" data-feather="chevron-right"></span>
                            Como comprar VIP com skins <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="my-2 ml-3 group">
                        <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                            <span class="mr-1 w-4 h-4" data-feather="chevron-right"></span>
                            Como comprar VIP com MercadoPago
                        </a>
                    </li>
                    <li class="my-2 ml-3 group">
                        <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                            <span class="mr-1 w-4 h-4" data-feather="chevron-right"></span>
                            Como comprar VIP com PayPal
                        </a>
                    </li>
                    <li class="my-2 ml-3 group">
                        <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                            <span class="mr-1 w-4 h-4" data-feather="chevron-right"></span>
                            Perguntas frequentes
                        </a>
                    </li>
                    <li class="my-2 ml-3 group">
                        <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                            <span class="mr-1 w-4 h-4" data-feather="chevron-right"></span>
                            Suporte
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
        <main role="main" class="w-4/5 ml-auto">
            <div class="flex items-center py-3 px-8 bg-gray-100 text-gray-600 border-b border-gray-400">
                <!--
                <span>Home</span>
                <span class="mr-1 w-4 h-4 inline text-gray-700" data-feather="chevron-right"></span>
                <span>Pedidos</span>
                <span class="mr-1 w-4 h-4 inline text-gray-700" data-feather="chevron-right"></span>
                <span>#203238458</span>
                -->
                {{ Breadcrumbs::render() }}
            </div>
            <div class="text-gray-800 p-8 shadow-inner">
                @include('flash::message')

                @yield('content')
            </div>
        </main>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(function () {
        // Enables popover
        $("[data-toggle=popover]").popover();
    });
    /* globals Chart:false, feather:false */

    (function () {
        'use strict';

        feather.replace();
    }())
</script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
