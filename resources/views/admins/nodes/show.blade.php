@extends('layouts.app')

@section('content')
    <h1>Node
        <strong>{{ $node->name }}</strong>
    </h1>
    <br/>
    @component('cards.games', ['games' => $node->games])
        <a class="btn btn-primary btn-sm" href="#">Add</a>
    @endcomponent
@endsection
