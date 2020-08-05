@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row mb-8 items-center justify-between">
        <h2 class="flex items-center text-xl md:text-3xl lg:text-4xl">
            <div class="flex-shrink-0 mr-4 h-12 w-12">
                @include('flags.brazil')
            </div>
            <span>
                @lang('deploys.deploying')
            </span>
            <span class="ml-2 mr-4 py-1 px-2 bg-red-200 text-red-800 font-mono tracking-tight break-words rounded">
                {{ $server->name }}
            </span>
        </h2>
    </div>

    <div class="mb-4">
        <h3>Information</h3>
        <small class="text-gray-500">
            Before deploying your server, take your time to read the information below
        </small>
    </div>

    <div class="mb-10 p-8 flex-grow grid grid-cols-2 gap-4 bg-white">
        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="activity"></span>
                Deploying a server
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                Your server is currently allocated and installed in one of our nodes, meaning you can play around with any configuration file without being charged for it.
                Once you are done configuring the server and want bring it online, you are ready to deploy it!
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="settings"></span>
                Configuration
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                Feel free to update the server resource configuration as much as necessary, as it's not fixed and can be changed between deployments.
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="credit-card"></span>
                Costs
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                When this server is deployed, you will be immediately charged R$ {{ number_format(abs($costPerPeriod) / 100, 2) }}, which is the entire first billing period of your server.
                After this period ends, you will be automatically charged again for another period, where your server will continue to be online and running until your account runs out of funds or you decide to terminate the server.
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="power"></span>
                Termination
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                With your server up and running, you can choose to terminate its deploy when you stop using it.
                You have an option to forcefully terminate the server, meaning it will be immediately turned off before finishing the period that has already been paid.
                Or you can request termination and the server will only be turned off after the current paid period expires.
            </p>
        </div>
    </div>

    <div class="mb-4">
        <h3>Server summary</h3>
        <small class="text-gray-500">
            Summary of current configuration and costs for deployment
        </small>
    </div>

    <!-- Information -->
    @include('servers.information')

    <div class="flex justify-center">
        {{ Form::open(['method' => 'POST', 'url' => route('servers.deploy', $server)]) }}
            <div class="btn-group btn-group-lg">
                <button class="btn btn-primary btn-lg" type="submit">Deploy server</button>
                <a class="btn btn-outline-secondary btn-lg" href="{{ route('servers.configure', $server) }}">Update configuration</a>
            </div>
        {{ Form::close() }}
    </div>
@endsection
