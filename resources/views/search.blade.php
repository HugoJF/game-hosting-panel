@extends('layouts.app')

@section('content')
    <h1>Search results for: <strong>{{ request('term') }}</strong></h1>
    <br/>

    @foreach($result->groupByType() as $type => $modelSearchResults)
        <h2 class="uppercase">{{ $type }}</h2>

        @foreach($modelSearchResults as $searchResult)
            <ul class="pl-4 ">
                <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
            </ul>
        @endforeach
    @endforeach
@endsection
