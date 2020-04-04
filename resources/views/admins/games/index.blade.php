@extends('layouts.app')

@section('content')
    <h1>Games</h1>
    <br/>
    @include('cards.games')
    <br/>
    <div class="flex justify-center">{{ $games->links() }}</div>
@endsection