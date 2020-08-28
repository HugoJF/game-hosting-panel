@extends('layouts.app')

<!-- TODO: unused?  -->

@section('content')
    @component('partials.card')
        @slot('title')
            Deploy new server
        @endslot
        @include('partials.location-deck')
    @endcomponent
@endsection
