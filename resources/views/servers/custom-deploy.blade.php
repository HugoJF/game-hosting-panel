@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    <div
        data-react="deployment-configurer"
        data-csrf="{{ csrf_token() }}"
        data-route="{{ route('servers.custom-deploy', $server) }}"
        data-server="{{ $server->id }}"
    ></div>

@endsection
