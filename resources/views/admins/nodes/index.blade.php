@extends('layouts.app')

@section('content')
    <h1>@lang('words.nodes')</h1>
    <br/>
    @include('cards.nodes')
    <br/>
    <div class="flex justify-center">{{ $nodes->links() }}</div>
@endsection
