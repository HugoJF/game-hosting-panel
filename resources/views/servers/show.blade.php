@extends('layouts.app')

@php
    $currentDeploy = $server->getDeploy();
@endphp

@section('content')
    <div class="flex flex-col lg:flex-row mb-8 items-center justify-between">
        <h2 class="flex items-center text-xl md:text-3xl lg:text-4xl">
            <div class="flex-shrink-0 mr-4 h-12 w-12">
                @include('flags.brazil')
            </div>
            <span>
                @lang('words.server')
            </span>
            <span class="ml-2 mr-4 py-1 px-2 bg-red-200 text-red-800 font-mono tracking-tight break-words rounded">
                {{ $server->name }}
            </span>
        </h2>
        <div class="btn-group mt-4 lg:m-0">
            @if($server->installed_at)
                <a class="btn btn-primary btn-lg" href="{{ config('pterodactyl.url') }}/server/{{ $server->panel_hash }}" target="_blank">
                    @lang('words.go_to_panel')
                </a>
                @if($server->getDeploy())
                    <a
                        class="btn btn-warning btn-lg"
                        href="{{ route('servers.terminate', $server) }}"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Set deploy to terminate at the end of paid period."
                    >
                        @lang('words.terminate')
                    </a>
                    <a
                        class="btn btn-outline-danger btn-lg"
                        href="{{ route('servers.force-terminate', $server) }}"
                        data-toggle="tooltip"
                        data-placement="top" title="Terminates deploy without waiting for currently paid period."
                    >
                        @lang('words.force_terminate')
                    </a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('servers.deploying', $server) }}">
                        @lang('words.deploy')
                    </a>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('servers.configure', $server) }}">
                        @lang('words.configure')
                    </a>
                @endif
            @else
                <h2>@include('servers.status')</h2>
            @endif
        </div>
    </div>

    <div class="mb-4">
        <h3>Server summary</h3>
        <small class="text-gray-500">
            Summary of current configuration and costs for deployment
        </small>
    </div>

    <x-well>
        @include('servers.information')
    </x-well>

    <div class="mb-4">
        <h3>
            @lang('deploys.latest')
        </h3>
        <small class="text-gray-500">
            @lang('deploys.description')
        </small>
    </div>

    @include('cards.deploys')

    <div class="mb-4">
        <h3>
            @lang('words.transactions')
        </h3>
        <small class="text-gray-500">
            @lang('transactions.description', ['count' => 5])
        </small>
    </div>

    @include('cards.transactions')
@endsection
