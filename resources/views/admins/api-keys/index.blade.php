@extends('layouts.app')

@section('content')
    @include('cards.api-keys')
    <br/>
    <div class="flex justify-center">{{ $apiKeys->links() }}</div>
@endsection