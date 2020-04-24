@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    {!! Form::open(['method' => 'POST', 'url' => route('servers.custom-deploy', $server)]) !!}

    @include('partials.configuration')

    {!! Form::close() !!}
@endsection
