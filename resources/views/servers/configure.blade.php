@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    <div
        data-location="{{ $location->id }}"
        data-react="configurer"
    ></div>

    {!! Form::open(['method' => 'POST', 'url' => route('servers.store', [$game, $location])]) !!}


    {!! Form::close() !!}
@endsection
