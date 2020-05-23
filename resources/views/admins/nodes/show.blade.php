@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.node')
        <strong>{{ $node->name }}</strong>
    </h1>
    <br/>
    @component('cards.games', ['games' => $node->games])
        <a class="btn btn-primary btn-sm" href="#">
            @lang('words.add')
        </a>
    @endcomponent
@endsection
