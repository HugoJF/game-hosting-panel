@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    {!! Form::open(['method' => 'POST', 'url' => route('servers.store', [$game, $location])]) !!}

    @include('partials.configuration')

    <button class="btn btn-lg btn-block btn-success" type="submit">Criar servidor</button>

    {!! Form::close() !!}
@endsection
