@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('cards.servers')

    <div class="grid grid-cols-4 gap-4 p-8">
        @foreach ($servers as $server)
            <div class="bg-white border rounded-lg overflow-hidden hover:shadow">
                <a class="block p-4" href="#">
                    <!-- Header -->
                    <div class="flex mb-4 justify-between items-center">
                        <h2 class="text-xl font-normal font-mono tracking-tight">{{ $server->name }}</h2>
                        @if(!$server->installed_at)
                            <span class="badge badge-warning text-lg">Installing</span>
                        @elseif($server->currentDeploy()->exists())
                            <span class="badge badge-primary text-lg">Deployed</span>
                        @else
                            <span class="badge badge-dark text-lg">Stopped</span>
                        @endif
                    </div>

                    <!-- Specs -->
                    <div class="">
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="cpu"></span>
                                <span class="text-gray-900 font-medium">CPU</span>
                            </p>
                            <span class="text-gray-700">{{ round($server->cpu) }}%</span>
                        </div>
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="database"></span>
                                <span class="text-gray-900 font-medium">RAM</span>
                            </p>
                            <span class="text-gray-700">{{ number_format($server->memory) }} MB</span>
                        </div>
                        <div class="flex py-2 justify-between">
                            <p>
                                <span class="inline text-gray-600" data-feather="hard-drive"></span>
                                <span class="text-gray-900 font-medium">Disk</span>
                            </p>
                            <span class="text-gray-700">{{ $server->disk / 1000 }} GB</span>
                        </div>
                    </div>
                </a>

                <!-- Footer -->
                <div class="flex p-4 bg-blue-100 border-t ">
                    <p class="flex-grow">
                        @if($server->currentDeploy()->exists())
                            <a class="text-blue-500 text-sm font-medium" href="#">Go to panel</a>
                        @else
                            <a class="text-blue-500 text-sm font-medium" href="#">Deploy</a>
                        @endif
                    </p>
                    <div class="pl-2 border-l border-gray-300">
                        <a href="{{ route('servers.custom-deploy', $server) }}"><span class="inline text-gray-600" data-feather="settings"></span></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
