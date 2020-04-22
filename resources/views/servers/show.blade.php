@extends('layouts.app')

@php
    $currentDeploy = $server->currentDeploy()->first();
@endphp

@section('content')
    @if($currentDeploy)
        @component('partials.card')
            @slot('title')
                <div class="d-flex items-center justify-between">
                    <span>Deploys</span>
                </div>
            @endslot

        @endcomponent
        <br/>
    @endif

    @component('partials.card')
        @slot('title')
            <div class="d-flex items-center justify-between">
                <span>Deploys</span>
                <div class="btn-group" role="group">
                    @if($server->currentDeploy()->count() === 0)
                        <a class="btn btn-primary btn-sm" href="{{ route('servers.deploy', $server) }}">Deploy</a>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('servers.custom-deploy', $server) }}">Custom deploy</a>
                    @else
                        <a class="btn btn-primary btn-sm" href="#">Terminate</a>
                    @endif
                </div>
            </div>
        @endslot

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Duration</th>
                <th>Billable duration</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Created at</th>
                <th>Terminated at</th>
            </tr>
            </thead>
            <tbody class="list-unstyled">
            @foreach ($deploys as $deploy)
                <tr>
                    <!-- ID -->
                    <td>{{ $deploy->id }}</td>

                    <!-- Duration -->
                    @if($deploy->terminated_at)
                        <td>{{ $deploy->terminated_at->longAbsoluteDiffForHumans($deploy->created_at) }}</td>
                    @else
                        <td>{{ $deploy->created_at->longAbsoluteDiffForHumans() }}</td>
                @endif

                <!-- Billable duration -->
                    <td>{{ $deploy->billablePeriod() }} {{ $deploy->billing_period }}</td>

                    <!-- Status -->
                    <td>
                        @if($deploy->terminated_at)
                            <span class="badge badge-secondary">Terminated</span>
                        @elseif($deploy->termination_requested_at)
                            <span class="badge badge-warning">Terminating</span>
                        @else
                            <span class="badge badge-primary">Running</span>
                        @endif
                    </td>

                    <!-- Cost -->
                    <td>
                        @if($deploy->transaction->value > 0)
                            <span class="badge badge-success">R$ {{ round($deploy->transaction->value / 100, 2) }}</span>
                        @elseif($deploy->transaction->value < 0)
                            <span class="badge badge-danger">R$ {{ round(-$deploy->transaction->value / 100, 2) }}</span>
                        @else
                            <span class="badge badge-secondary">R$ {{ round($deploy->transaction->value / 100, 2) }}</span>
                        @endif
                    </td>

                    <!-- Created at -->
                    <td>{{ $deploy->created_at }}</td>

                    <!-- Terminated at -->
                    <td>{{ $deploy->terminated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br/>

        <div class="text-center">
            <div class="btn-group">
                @if($server->getDeploy())
                    <a class="btn btn-primary btn-lg" href="{{ route('servers.terminate', $server) }}" data-toggle="tooltip" data-placement="top" title="Set deploy to terminate at the end of paid period.">Terminate</a>
                    <a class="btn btn-danger btn-lg" href="#" data-toggle="tooltip" data-placement="top" title="Terminates deploy without waiting for currently paid period.">Force terminate</a>
                    <a class="btn btn-outline-secondary btn-lg" href="#">Help</a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('servers.deploy', $server) }}">Deploy</a>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('servers.custom-deploy', $server) }}">Custom deploy</a>
                @endif
            </div>
        </div>
    @endcomponent
@endsection
