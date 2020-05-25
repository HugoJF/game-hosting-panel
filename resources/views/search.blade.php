@extends('layouts.app')

@section('content')
    <h1>Search results for: <strong>{{ request('term') }}</strong></h1>
    <br/>

    @foreach ($result as $type => $items)
        <h2 class="mb-8">{{ $mapping[$type]['title'] }}</h2>
        @include($mapping[$type]['view'], [$mapping[$type]['variable'] => $items])
    @endforeach
@endsection
