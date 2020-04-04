@extends('layouts.app')

@php
    $deploy = $server->currentDeploy()->first();
@endphp

@section('content')
    @component('partials.card')
        @slot('title')
            Console
        @endslot
        
        {{--<div--}}
                {{--id="console"--}}
                {{--data-ws-jwt="{{ $jwt }}"--}}
                {{--data-ws-host="{{ $server->node->settings('ws_screenlogs_host') }}"--}}
                {{--data-home-id="{{ $server->settings('home_id') }}"--}}
        {{--></div>--}}
        <div id="console" data-ws-jwt="{{ $jwt }}" data-ws-host="192.168.25.222:3000" data-home-id="81"></div>
    @endcomponent
    <br/>
    @component('partials.card')
        @slot('title')
            Configuration
        @endslot
        
        @include('panels.' . $server->node->type . '.configurations')
    @endcomponent
    <br>
    
    @component('partials.card')
        @slot('title')
            Team
        @endslot
        @component('partials.form', ['method' => 'PATCH', 'url' => route('servers.set-team', $server)])
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="server_team">Team</label>
                </div>
                
                <select name="team" class="custom-select" id="server_team" aria-label="Example select with button addon">
                    <option selected>Choose team...</option>
                    @foreach ($server->user->teams as $team)
                        <option {{ $server->team_id === $team->id ? 'selected ' : '' }}value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="action" value="switch">Switch team</button>
                    @if($server->team)
                        <button class="btn btn-outline-danger" type="submit" name="action" value="remove">Remove from team</button>
                    @endif
                </div>
            </div>
        @endcomponent
    
    @endcomponent
    <br>
    @foreach ($server->modules() as $module)
        @include($module->getCardName(), $module->getCardData())
        <br>
    @endforeach
    
    @if($deploy)
        @component('partials.card')
            @slot('title')
                <div class="d-flex items-center justify-between">
                    <span>Deploys</span>
                </div>
            @endslot
            
            <div class="d-flex justify-content-center">
                @component('partials.form', ['method' => 'PATCH', 'url' => route('servers.home-update', $deploy)])
                    <div class="btn-group" role="group" aria-label="Server controls">
                        @if($server->driver()->status() && $server->currentDeploy()->exists())
                            <a class="btn btn-danger btn-lg" href="{{ route('deploys.stop', $deploy) }}">Stop</a>
                        @else
                            <button class="btn btn-primary btn-lg">Update</button>
                            <a class="btn btn-outline-dark btn-lg" href="{{ route('deploys.edit', $deploy) }}">Edit parameters</a>
                            <a class="btn btn-success btn-lg" href="{{ route('deploys.start', $deploy) }}">Start</a>
                        @endif
                    </div>
                @endcomponent
            </div>
        @endcomponent
        <br/>
    @endif
    
    @component('partials.card')
        @slot('title')
            <div class="d-flex items-center justify-between">
                <span>Deploys</span>
                <div class="btn-group" role="group">
                    @if($server->currentDeploy()->count() === 0)
                        <a class="btn btn-primary btn-sm" href="{{ route('deploys.create', $server) }}">Deploy</a>
                    @else
                        <a class="btn btn-primary btn-sm" href="{{ route('deploys.terminate', $server) }}">Terminate</a>
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
                @if($server->currentDeploy()->count() === 0)
                    <a class="btn btn-primary btn-lg" href="{{ route('deploys.create', $server) }}">Deploy</a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('deploys.terminate', $server) }}" data-toggle="tooltip" data-placement="top" title="Set deploy to terminate at the end of paid period.">Terminate</a>
                    <a class="btn btn-danger btn-lg" href="{{ route('deploys.force-terminate', $server) }}" data-toggle="tooltip" data-placement="top" title="Terminates deploy without waiting for currently paid period.">Force terminate</a>
                    <a class="btn btn-outline-secondary btn-lg" href="{{ route('deploys.terminate', $server) }}">Help</a>
                @endif
            </div>
        </div>
    @endcomponent
@endsection