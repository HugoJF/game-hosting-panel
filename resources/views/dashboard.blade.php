@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-baseline">
        <h1 class="mb-8">
            @lang('words.servers')
        </h1>
        <div class="btn-group btn-group-lg">
            <a class="btn btn-primary btn-lg" href="{{ route('servers.create') }}">
                @lang('servers.create')
            </a>
            <a class="btn btn-outline-primary btn-lg" href="{{ route('servers.index') }}">
                @lang('servers.view_all')
            </a>
        </div>
    </div>

    @include('cards.servers')
@endsection
