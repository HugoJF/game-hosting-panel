@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.orders')
    </h1>
    <br/>
    @include('cards.orders', ['indexRoute' => false])
@endsection
