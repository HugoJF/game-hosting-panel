@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-baseline">
        <h1 class="mb-8">
            @lang('words.servers')
        </h1>
        <div class="btn-group btn-group-lg">
            <a class="btn btn-primary btn-lg" href="{{ route('servers.create') }}">
                @lang('servers.create')
            </a>
        </div>
    </div>

    @include('cards.servers')
@endsection
