@extends('layouts.app')

@section('content')
    <h1>Orders</h1>
    <br/>
    @include('cards.orders', ['indexRoute' => false])
@endsection
