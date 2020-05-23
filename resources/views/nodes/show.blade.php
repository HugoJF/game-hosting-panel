@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.node')
        <strong>{{ $node->name }}</strong>
    </h1>
    <br/>
    @component('partials.card')
        @slot('title')
            @lang('words.games')
        @endslot

        @include('cards.games', ['games' => $node->games])
    @endcomponent
@endsection
