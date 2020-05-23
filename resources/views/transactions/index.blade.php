@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.transactions')
    </h1>
    <br/>
    @include('cards.transactions', ['indexRoute' => false])
@endsection
