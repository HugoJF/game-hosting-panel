<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Home') | Host de_nerdTV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,500,600&subset=latin" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Vendor CSS -->
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar-z sticky top-0 left-0 right-0 p-0">
    <!-- Announcement -->
    <div class="shadow-inner">
        @foreach ($globalAnnouncements ?? [] as $announcement)
            @php
                $colors = [
                    'danger' => 'red',
                    'success' => 'green',
                ];
                $color = $colors[ $announcement->type ];
            @endphp
            <div class="px-5 py-2 flex justify-center items-center text-white bg-{{ $color }}-500 font-semibold">
                <span class="h-8 w-8 mr-3 flex-shrink-0" data-feather="alert-circle"></span>
                <p>{{ $announcement->description }}</p>
                <a class="trans px-2 py-1 ml-5 hover:text-black border border-white hover:bg-{{ $color }}-400" href="{{ $announcement->action_url }}">
                    {{ $announcement->action }}
                </a>
            </div>
        @endforeach
    </div>

    <!-- Header -->
    <div class="flex items-center flex-no-wrap flex-col md:flex-row items-stretch justify-center bg-gray-800">
        <a class="sidebar-width px-6 py-3 text-gray-400 text-lg no-underline flex-shrink-0 mr-0" href="{{ route('dashboard') }}">
            @lang('words.denerdtv_servers')
        </a>
        <div class="hidden md:flex items-stretch flex-grow text-gray-400">
            {!! Form::open(['url' => route('search'), 'method' => 'GET', 'class' => 'flex items-stretch w-100']) !!}
            <input autocomplete="off" name="term" class="trans-fast py-2 px-5 w-100 bg-transparent outline-none focus:border-b focus:border-gray-500 focus:shadow-inner focus:bg-gray-200 focus:text-gray-700" type="text" placeholder="Search" aria-label="Search">
            {!! Form::close() !!}
        </div>
        <ul class="navbar-nav flex-shrink">
            <li class="h-full flex items-stretch text-nowrap">
                @auth
                    <a href="{{ route('notifications.index') }}" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <div class="relative">
                            <span class="mr-1 inline text-gray-400" data-feather="bell"></span>
                            @if(auth()->user()->unreadNotifications()->count() > 0)
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('servers.create') }}" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="plus"></span>
                        <span>
                            @lang('servers.create')
                        </span>
                    </a>
                    <a href="{{ route('settings') }}" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="settings"></span>
                        <span>
                            @lang('words.settings')
                        </span>
                    </a>
                    {!! Form::open(['method' => 'POST', 'url' => route('logout'), 'class' => 'trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700 select-none']) !!}
                        <span class="mr-1 inline text-gray-400" data-feather="log-out"></span>
                        <button>
                            @lang('words.logout')
                        </button>
                    {!!  Form::close() !!}
                @else
                    <a href="{{ route('register') }}" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="user-plus"></span>
                        <span>
                            @lang('words.register')
                        </span>
                    </a>
                    <a href="{{ route('login') }}" class="trans flex flex-grow justify-center items-center p-3 no-underline text-gray-400 hover:bg-gray-700">
                        <span class="mr-1 inline text-gray-400" data-feather="log-in"></span>
                        <span>
                            @lang('words.login')
                        </span>
                    </a>
                @endauth
            </li>
        </ul>
    </div>

    <!-- Sidebar -->
    <div class="h-full block md:fixed light sidebar-width bg-gray-900">
        <div class="sidebar-sticky p-4">
            @include('sidebar.header')

            @include('sidebar.alerts')

            @include('sidebar.packs.servers')

            @include('sidebar.packs.menu')
        </div>
    </div>
</nav>

<div class="w-full">
    <main class="flex flex-col md:flex-row md:flex-wrap min-h-screen">
        <!-- Main -->
        <main role="main" class="flex flex-col flex-grow sidebar-margin">
            <!-- Breadcrumbs -->
            <div class="flex items-center py-3 px-8 bg-gray-100 text-gray-600 border-b border-gray-400">
                {{ Breadcrumbs::render() }}
            </div>

            <!-- Main container -->
            <div class="flex-grow text-gray-800 pt-8 p-1 md:p-8 overflow-x-hidden">
                <!-- Flash message -->
                <div class="container">
                    @include('partials.flash')
                </div>

                <!-- Content -->
                <div class="container">
                    @yield('content')
                </div>
            </div>

            <!-- Copyright -->
            <div class="flex flex-col py-1 px-8 bg-gray-100 text-gray-600 border-t border-gray-400">
                <p>
                    Copyright © {{ now()->year }} <a href="https://denerdtv.com/">de_nerdTV</a>.
                </p>

                <!-- Flaticon attributions -->
                @isset($flaticon)
                    <div class="flex flex-wrap text-gray-400 text-sm tracking-tight">
                        @foreach ($flaticon as $url => $name)
                            @if(!$loop->first)
                                <div class="mx-2">|</div>
                            @endif
                            <div class="flex-shrink-0">
                                Icons made by <a href="https://www.flaticon.com/authors/{{ $url }}" title="{{ $name }}">{{ $name }}</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </main>
    </main>
</div>

<script type="text/javascript" src="{{ mix('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

@stack('scripts')

@include('analytics')

</body>
</html>
