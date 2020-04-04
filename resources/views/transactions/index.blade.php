@extends('layouts.app')

@section('content')
    <h1>Transactions</h1>
    <br/>
    @include('cards.transactions', ['indexRoute' => false])
@endsection
