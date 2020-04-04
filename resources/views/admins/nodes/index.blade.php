@extends('layouts.app')

@section('content')
    <h1>Nodes</h1>
    <br/>
    @include('cards.nodes')
    <br/>
    <div class="flex justify-center">{{ $nodes->links() }}</div>
@endsection