@extends('layouts.app')

@section('content')
    <div
        data-server="{{ $server->id }}"
        data-game="{{ $server->game_id }}"
        data-location="{{ $server->node->location_id }}"
        data-react="deploy-configurer"
    ></div>
@endsection
