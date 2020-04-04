@extends('layouts.app')

@section('content')
    <h1>Admin dashboard</h1>
    <br/>
    @include('cards.locations', ['showRoute' => 'admins.locations.show'])
    <br/>
    @include('cards.nodes', ['showRoute' => 'admins.nodes.show'])
    <br/>
    @include('cards.games')
    <br/>
    @include('cards.servers')
    <br/>
    @include('cards.transactions')
    <br/>
    @include('cards.coupons')
    <br/>
    @include('cards.users')
@endsection
