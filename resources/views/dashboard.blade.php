@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-baseline">
        <h1 class="mb-8">Servers</h1>
        <div class="btn-group btn-group-lg">
            <a class="btn btn-primary btn-lg" href="{{ route('servers.create') }}">Create server</a>
            <a class="btn btn-outline-primary btn-lg" href="{{ route('servers.index') }}">View all servers</a>
        </div>
    </div>

    @include('cards.servers')
@endsection
