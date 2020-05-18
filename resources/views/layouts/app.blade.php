<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Home') | Host de_nerdTV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,500,600&subset=latin" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar-z sticky top-0 left-0 right-0 p-0">
    @isset($announcement)
        <div class="px-5 py-2 flex justify-center items-center text-white bg-red-500 font-semibold shadow-inner">
            <span class="h-8 w-8 mr-3 flex-shrink-0" data-feather="alert-circle"></span>
            <p>Nossos servidores estão em manutenção até 11h00 UTC</p>
            <a class="trans px-2 py-1 ml-5 hover:text-black border border-white hover:bg-green-500" href="#">Informações</a>
        </div>
    @endisset
    <div class="flex items-center flex-no-wrap flex-col md:flex-row items-stretch justify-center bg-gray-800">
        <a class="sidebar-width px-6 py-3 text-gray-400 text-lg no-underline flex-shrink-0 mr-0" href="{{ route('home') }}">Servidores de_nerdTV</a>
        <div class="hidden md:flex items-stretch flex-grow text-gray-400">
            {!! Form::open(['url' => route('home'), 'method' => 'GET', 'class' => 'flex items-stretch w-100']) !!}
            <input autocomplete="off" name="term" class="trans-fast py-2 px-5 w-100 bg-transparent outline-none focus:border-b focus:border-gray-500 focus:shadow-inner focus:bg-gray-200 focus:text-gray-700" type="text" placeholder="Search" aria-label="Search">
            {!! Form::close() !!}
        </div>
        <ul class="navbar-nav flex-shrink">
            <li class="h-full flex items-stretch text-nowrap">
                @auth
                    <a href="#" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <div class="relative">
                            <span class="mr-1 inline text-gray-400" data-feather="message-circle"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </div>
                    </a>
                    <a href="#" class="trans p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="plus"></span>
                        <span>Criar servidor</span>
                    </a>
                    <a href="#" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="settings"></span>
                        <span>Configurações</span>
                    </a>
                    <a href="#" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="log-out"></span>
                        <span>Sair</span>
                    </a>
                @else
                    <a href="#" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="log-in"></span>
                        <span>Entrar</span>
                    </a>
                @endauth
            </li>
        </ul>
    </div>
</nav>

<div class="w-full">
    <main class="flex flex-col md:flex-row md:flex-wrap">
        <nav class="block md:fixed light sidebar sidebar-width bg-gray-900">
            <div class="sidebar-sticky p-4">
                <div class="hidden md:flex flex-col px-20 mt-4 mb-4 items-center">
                    @auth
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
                    @endauth
                </div>

                @auth
                    @php
                        // $alerts = auth()->user()->getAlerts();
                        $alerts = collect();
                    @endphp

                    @if($alerts->count() !== 0)
                        <h6 class="flex justify-between items-center px-3 mt-8 mb-4 uppercase font-normal tracking-wider text-gray-700">
                            <span>Alertas</span>
                            <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                        </h6>

                        <ul class="flex flex-col items-center">
                            @foreach ($alerts as $alert)
                                <li><a href="{{ $alert['url'] }}" class="badge badge-{{ $alert['level'] }}">{{ $alert['message'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                @endauth

                @auth
                    @isset($onlineServers)
                        <a class="flex justify-between items-center px-3 mb-4 uppercase font-normal tracking-wider text-gray-700" data-toggle="collapse" href="#servers">
                            <span class="md:hidden" data-feather="menu"></span>
                            <span>Servers online {{ $onlineServers->count() }} / {{ $totalServers }}</span>
                            <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                        </a>

                        <div id="servers" class="collapse">
                            <ul class="ml-3 mr-2 mb-6 grid grid-cols-2 lg:grid-cols-1 lg:grid-cols-2 gap-2">
                                @foreach ($onlineServers as $server)
                                    <li>
                                        <a class="trans inline py-1 flex justify-center items-center hover:bg-gray-800 cursor-pointer rounded" href="{{ route('servers.show', $server) }}">
                                            <div class="flex-shrink-0 mr-4 h-2 w-2 bg-green-600 rounded-full"></div>
                                            <p class="text-gray-400 text-sm lg:text-xs xl:text-sm font-mono">{{ $server->name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endisset
                @endauth

                @auth
                    <a class="flex justify-between items-center px-3 mb-4 uppercase font-normal tracking-wider text-gray-700" data-toggle="collapse" href="#menu">
                        <span class="md:hidden" data-feather="menu"></span>
                        <span>Menu</span>
                        <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                    </a>

                    <!-- Home -->
                    <div id="menu" class="collapse">
                        <ul class="collapse pl-0 mb-0 flex flex-col text-sm">
                            <!-- Home -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('home') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="home"></span>
                                    <span class="group-hover:text-gray-400">Home</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#homeHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- Servidores -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('servers.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="server"></span>
                                    <span class="group-hover:text-gray-400">Servidores</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#ordersHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- Transactions -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('transactions.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="credit-card"></span>
                                    <span class="group-hover:text-gray-400">Transações</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#tokensHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- Usuários -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('orders.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="shopping-cart"></span>
                                    <span class="group-hover:text-gray-400">Pedidos</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#usersHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- Afiliados -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('coupons.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="gift"></span>
                                    <span class="group-hover:text-gray-400">Coupons</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#affiliatesHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- API -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('api-keys.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="key"></span>
                                    <span class="group-hover:text-gray-400">API Keys</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#productsHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>

                            <!-- Cupons -->
                            <li class="flex justify-between my-2 ml-3">
                                <a href="{{ route('admins.dashboard') }}" class="flex items-center text-gray-500 no-underline text-base group">
                                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="briefcase"></span>
                                    <span class="group-hover:text-gray-400">Administrative</span>
                                </a>
                                <a class="group no-underline" href="#">
                                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#couponsHelpModal" data-feather="help-circle"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth
                <a class="flex justify-between items-center px-3 mb-4 uppercase font-normal tracking-wider text-gray-700" data-toggle="collapse" href="#links">
                    <span class="md:hidden" data-feather="menu"></span>
                    <span>Links rápidos</span>
                    <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
                </a>
                <div id="links" class="collapse">
                    <ul class="pl-0 mb-0 flex flex-col text-sm">
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-skins/">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Como comprar VIP com skins <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-mercadopago/">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Como comprar VIP com MercadoPago
                            </a>
                        </li>
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-paypal/">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Como comprar VIP com PayPal
                            </a>
                        </li>
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/faq/">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Perguntas frequentes
                            </a>
                        </li>
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/discord">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Suporte
                            </a>
                        </li>
                        <li class="my-2 ml-3 group">
                            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                                Termos de uso
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main role="main" class="flex-grow sidebar-margin">
            <div class="flex items-center py-3 px-8 bg-gray-100 text-gray-600 border-b border-gray-400">
                {{ Breadcrumbs::render() }}
            </div>
            <div class="text-gray-800 pt-8 p-1 md:p-8 overflow-x-hidden">
                <div class="container">
                    @include('flash::message')
                </div>
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </main>
    </main>
</div>

<script type="text/javascript" src="{{ mix('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
