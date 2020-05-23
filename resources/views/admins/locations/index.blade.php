@extends('layouts.app')

@section('content')
    <h1>@lang('words.locations')</h1>
    <br/>
    @include('cards.locations', ['showRoute' => 'admins.locations.show'])
    <br/>
    <div class="flex justify-center">{{ $locations->links() }}</div>
@endsection
