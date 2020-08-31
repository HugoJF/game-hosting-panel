@extends('layouts.app')

@section('content')
    <h1 class="mb-8">@lang('words.search_results', ['term' => request('term')])</h1>

    @foreach ($result as $type => $items)
        <div class="mb-10">
            <h2 class="mb-4">{{ $mapping[$type]['title'] }}</h2>
            @include($mapping[$type]['view'], [$mapping[$type]['variable'] => $items])
        </div>
    @endforeach
@endsection
