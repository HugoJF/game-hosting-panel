@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    <div
        data-react="creation-configurer"
        data-csrf="{{ csrf_token() }}"
        data-route="{{ route('servers.store', [$game, $location]) }}"
        data-location="{{ $location->id }}"
    ></div>
@endsection
