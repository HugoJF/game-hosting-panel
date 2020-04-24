@extends('layouts.app')

@section('content')
    <h1>Servers</h1>
    <br/>
    @component('cards.servers', ['servers' => $servers])
        <a class="btn btn-primary btn-sm" href="{{ route('servers.select-game') }}">Create new server</a>
    @endcomponent
    <br/>
@endsection
