@extends('layouts.app')

@section('content')
    <h1>Node <strong>{{ $node->name }}</strong></h1>
    <br/>
    @component('partials.card')
        @slot('title')
            Games
        @endslot
        
        @include('cards.games', ['games' => $node->games])
    @endcomponent
@endsection