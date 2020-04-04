@extends('layouts.app')

@section('content')
    <h1>Servers</h1>
    <br/>
    @component('cards.servers')
        <a class="btn btn-primary btn-sm" href="{{ route('servers.select-game') }}">Create new server</a>
    @endcomponent
    <br/>
@endsection
