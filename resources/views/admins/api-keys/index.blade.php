@extends('layouts.app')

@section('content')
    <h1>@lang('words.api_keys')</h1>
    <br/>
    @include('cards.api-keys')
    <br/>
    <div class="flex justify-center">{{ $apiKeys->links() }}</div>
@endsection
