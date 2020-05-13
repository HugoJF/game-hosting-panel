@extends('layouts.app')

@php
    $values = [
    'CPU' => ['25%', '50%', '75%', '100%'],
    'Memory' => ['1GB', '2GB', '3GB', '4GB', '5GB', '6GB'],
    'Disk' => ['10GB', '20GB', '30GB', '40GB', '50GB'],
    'Databases' => ['1', '2', '3', '4']
];
@endphp

@php
    $games = [
    'https://i.redd.it/uhdomasbp1p31.png',
    'https://i.imgur.com/rAwX8Af.png',
    'https://i.imgur.com/ADfCGqM.png',
    'https://i.redd.it/4vmdf5aiuyq31.png',
    'https://i.imgur.com/ORlkG0P.png',

];
@endphp

@section('content')
    <div class="mb-8">
        <h1>Create a new server</h1>
    </div>

    <div class="mb-8 bg-white rounded-lg overflow-hidden">
        <div class="flex items-baseline px-8 py-4 border-b bg-gray-100">
            <h2>Game</h2>
            <p class="ml-2 text-gray-500 font-light tracking-tight">Select which game you want to host.</p>
        </div>
        <div class="grid grid-cols-5 gap-4 p-8">
            @php
                $selected = rand(0, count($games) - 1);
            @endphp
            @foreach($games as $game)
                @if($loop->index === $selected)
                    <div class="relative rounded overflow-hidden" style="transform: scale(1.05);">
                        <div class="z-10 m-2 absolute text-white top-0 right-0 bg-blue-600 rounded-full shadow">
                            <span data-feather="check"></span>
                        </div>
                        <img class="z-0 trans cursor-pointer shadow-lg" src="{{ $game }}">
                    </div>
                @else
                    <div class="relative rounded overflow-hidden">
                        <img class="trans cursor-pointer hover:shadow" style="transform: scale(1.01); filter: blur(1px) grayscale(100%) brightness(60%)" src="{{ $game }}">
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="mb-8 bg-white rounded-lg overflow-hidden">
        <div class="flex items-baseline px-8 py-4 border-b bg-gray-100">
            <h2>Server location</h2>
            <p class="ml-2 text-gray-500 font-light tracking-tight">Select which location you want your server to be hosted at.</p>
        </div>
        <div class="relative">
            <div class="grid grid-cols-4 gap-4 p-8 z-0">
                @foreach (['canada' => 'Canada', 'us' => 'United States', 'brazil' => 'Brazil'] as $country => $c)
                    @if($loop->first)
                        <div class="z-0 relative flex flex-row items-center px-6 py-4 border-2 bg-blue-100 border-blue-600 rounded cursor-pointer shadow">
                            <div class="m-2 absolute text-white top-0 right-0 bg-blue-600 rounded-full shadow">
                                <span data-feather="check"></span>
                            </div>

                            <div class="w-16 h-16">@include("flags.$country")</div>
                            <div class="ml-4 flex-grow text-blue-700">
                                <p class="text-xl font-bold">{{ $c }}</p>
                                <p class="text-sm font-light tracking-tight">Maxihost - MH1</p>
                            </div>
                        </div>
                    @else
                        <div class="z-0 flex flex-row items-center px-6 py-4 border rounded cursor-pointer hover:border-blue-600 hover:shadow">
                            <div class="w-16 h-16">@include("flags.$country")</div>
                            <div class="ml-4 flex-grow">
                                <p class="text-xl font-bold">{{ $c }}</p>
                                <p class="text-sm font-light tracking-tight">Maxihost - MH1</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="mb-8 bg-white rounded-lg overflow-hidden">
        <div class="px-8 py-4 border-b bg-gray-100">
            <h2>Server resources</h2>
            <p class="text-gray-700">Select the resource limits based on your demand.</p>
        </div>
        <div class="grid grid-cols-2 bg-white rounded-lg">
            @foreach (['CPU', 'Memory', 'Disk', 'Databases'] as $param)
                @php
                    $p = strtolower($param);
                @endphp
                <div class="p-8 flex">
                    <!-- Icon -->
                    <div class="w-16 h-16 mr-6">
                        @include("icons.$p")
                    </div>

                    <!-- Body -->
                    <div class="flex-grow">
                        <!-- Header -->
                        <div class="mb-3 flex items-baseline">
                            <h3>{{ $param }}</h3>
                            <small class="ml-1 text-sm text-gray-600 font-light">Maximum core usage</small>
                        </div>

                        <!-- Options -->
                        <div class="grid grid-cols-4 gap-4">
                            @php
                                $selected = rand(0, 3);
                            @endphp
                            @foreach ($values[$param] as $text)
                                @if($loop->index === $selected)
                                    <div class="trans px-4 py-2 text-blue-600 text-xl text-center font-bold border-2 border-blue-600 bg-blue-100 rounded cursor-pointer shadow">
                                        {{ $text }}
                                    </div>
                                @else
                                    <div class="trans px-4 py-2 text-xl text-center font-bold border rounded cursor-pointer hover:shadow">
                                        {{ $text }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="bg-white rounded-lg overflow-hidden">
        <div class="px-8 py-4 border-b bg-gray-100">
            <h2>Summary</h2>
            <p class="text-gray-700">Details and cost for your new server.</p>
        </div>
        <div class="grid grid-cols-2 bg-white rounded-lg">
            <!-- Resumo -->
            <div class="p-8 flex">
                <!-- Icon -->
                <div class="w-16 h-16 mr-6">
                    @include('icons.summary')
                </div>

                <!-- Body -->
                <div class="flex-grow">
                    <!-- Header -->
                    <div class="mb-3 flex items-baseline">
                        <h3>Resumo</h3>
                        <small class="ml-1 text-sm text-gray-600 font-light">Maximum core usage</small>
                    </div>

                    <!-- Options -->
                    <ul class="grid grid-cols-1 gap-4">
                        @foreach ([
                            'Game' => 'Call of Duty 4: Modern Warfare',
                            'CPU' => '25%',
                            'Memory' => '2GB',
                            'Disk' => '30GB',
                            'Databases' => '1 database',
                            'Period' => 'Daily',
                        ] as $name => $spec)
                            <div class="trans flex justify-between items-center px-4 py-2 text-center border rounded">
                                <h4>{{ $name }}:</h4>
                                {{ $spec }}
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Periodo -->
            <div class="flex flex-col">
                <div class="p-8 flex">
                    <!-- Icon -->
                    <div class="w-16 h-16 mr-6">
                        @include('icons.period')
                    </div>

                    <!-- Body -->
                    <div class="flex-grow">
                        <!-- Header -->
                        <div class="mb-3 flex items-baseline">
                            <h3>Período de pagamento</h3>
                            <small class="ml-1 text-sm text-gray-600 font-light">Maximum core usage</small>
                        </div>

                        <!-- Options -->
                        <div class="grid grid-cols-3 gap-4">
                            @foreach (['Minutely', 'Hourly', 'Daily', 'Weekly', 'Monthly'] as $text)
                                @if($loop->index === $selected)
                                    <div class="trans px-4 py-2 text-blue-600 text-xl text-center font-bold border-2 border-blue-600 bg-blue-100 rounded cursor-pointer shadow">
                                        {{ $text }}
                                    </div>
                                @else
                                    <div class="trans px-4 py-2 text-xl text-center font-bold border rounded cursor-pointer hover:shadow">
                                        {{ $text }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="p-8 flex">
                    <!-- Icon -->
                    <div class="w-16 h-16 mr-6">
                        @include('icons.cost')
                    </div>

                    <!-- Body -->
                    <div class="flex-grow">
                        <!-- Header -->
                        <div class="mb-3">
                            <h3>Custo total</h3>
                        </div>

                        <!-- Options -->
                        <div>
                            <div class="flex mb-6 justify-center items-baseline text-3xl">
                                <span>R$ 20,00</span>
                                <span class="ml-1 text-2xl text-gray-700 font-light tracking-tight">por dia</span>
                            </div>
                            <div class="trans px-5 py-3 bg-green-500 text-center text-3xl text-white font-semibold rounded cursor-pointer hover:shadow">
                                Finalizar pedido
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
