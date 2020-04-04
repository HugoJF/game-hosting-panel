@extends('layouts.app')

@section('content')
    <h1>Servers</h1>
    <br/>
    @include('cards.servers')
    <br/>
    <div class="flex justify-center">{{ $servers->links() }}</div>
@endsection