@extends('layouts.app')

@section('content')
    <h1>Search results for: <strong>{{ request('term') }}</strong></h1>
    <br/>

    @foreach ($result as $type => $items)
        <div class="mb-10">
            <h2 class="mb-4">{{ $mapping[$type]['title'] }}</h2>
            @include($mapping[$type]['view'], [$mapping[$type]['variable'] => $items])
        </div>
    @endforeach
@endsection
