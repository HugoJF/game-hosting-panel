@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Servers</h1>

    @include('cards.servers')
@endsection
