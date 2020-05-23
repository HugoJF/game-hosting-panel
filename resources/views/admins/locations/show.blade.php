@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.location')
        <strong>{{ $location->short }}</strong>
    </h1>
    <br/>
    @include('cards.nodes', ['showRoute' => 'admins.nodes.show', 'nodes' => $location->nodes])
@endsection
