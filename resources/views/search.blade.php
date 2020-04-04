@extends('layouts.app')

@php
    $total = count($locations) + count($nodes) + count($servers) + count($transactions) + count($coupons) + count($users);
@endphp

@section('content')
    <h1>Search results for: <strong>{{ request('term') }}</strong></h1>
    <br/>
    @if(count($locations) > 0)
        @include('cards.locations')
        <br/>
    @endif

    @if(count($nodes) > 0)
        @include('cards.nodes')
        <br/>
    @endif

    @if(count($servers) > 0)
        @include('cards.servers')
        <br/>
    @endif

    @if(count($transactions) > 0)
        @include('cards.transactions')
        <br/>
    @endif

    @if(count($coupons) > 0)
        @include('cards.coupons')
        <br/>
    @endif

    @if(count($users) > 0)
        @include('cards.users')
    @endif

    @if($total === 0)
        <h3>No results</h3>
    @endif

@endsection
