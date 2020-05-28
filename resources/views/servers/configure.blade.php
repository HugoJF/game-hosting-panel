@extends('layouts.app')

@php
    // Flaticon attributions
    $flaticon = [
        'nikita-golubev' => 'Nikita Golubev',
        'freepik' => 'Freepik',
        'surang' => 'surang',
        'nhor-phai' => 'Nhor Phai',
        'xnimrodx' => 'xnimrodx',
        'icongeek26' => 'Icongeek26',
    ];
@endphp

@section('content')
    <div
        data-server="{{ $server->hash }}"
        data-game="{{ $server->game_id }}"
        data-location="{{ $server->node->location_id }}"
        data-react="deploy-configurer"
    ></div>
@endsection
