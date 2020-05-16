@extends('layouts.app')

@php
    $currentDeploy = $server->currentDeploy()->first();
@endphp

@section('content')
    <div class="flex mb-8 items-center justify-between">
        <h1 class="flex items-center">
            <div class="mr-4 h-12 w-12">@include('flags.brazil')</div>
            <span>Server</span>
            <span class="py-1 px-2 bg-red-200 text-red-800 font-mono tracking-tight break-words rounded">{{ $server->name }}</span>
        </h1>
        <div class="btn-group">
            @if($server->getDeploy())
                <a class="btn btn-primary btn-lg" href="{{ route('servers.terminate', $server) }}" data-toggle="tooltip" data-placement="top" title="set deploy to terminate at the end of paid period.">Terminate</a>
                <a class="btn btn-danger btn-lg" href="{{ route('servers.force-terminate', $server) }}" data-toggle="tooltip" data-placement="top" title="terminates deploy without waiting for currently paid period.">Force terminate</a>
                <a class="btn btn-outline-secondary btn-lg" href="#">help</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{ route('servers.deploy', $server) }}">Deploy</a>
                <a class="btn btn-outline-primary btn-lg" href="{{ route('servers.configure-deploy', $server) }}">Custom deploy</a>
            @endif
        </div>
    </div>

    <div class="mb-4">
        <h3>Current deploy</h3>
        <small class="text-gray-500">Information about the current deploy of your server</small>
    </div>

    @include('cards.deploys')

    <div class="mb-4">
        <h3>Transactions</h3>
        <small class="text-gray-500">Last 5 transactions generated by this server</small>
    </div>

    @include('cards.transactions')
@endsection
