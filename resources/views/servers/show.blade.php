@extends('layouts.app')

@php
    $currentDeploy = $server->currentDeploy()->first();
@endphp

@section('content')

    <h1>Server {{ $server->name }}</h1>

    @include('cards.deploys');

    <br/>

    <div class="text-center">
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

@endsection
