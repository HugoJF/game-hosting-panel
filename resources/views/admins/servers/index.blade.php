@extends('layouts.app')

@section('content')
    <h1>@lang('words.servers')</h1>
    <br/>
    @include('cards.servers')
    <br/>
    <div class="flex justify-center">{{ $servers->links() }}</div>
@endsection
