@extends('layouts.app')

@section('content')
    <h1>API Keys</h1>
    <br/>
    @include('cards.api-keys', ['indexRoute' => false])
@endsection
