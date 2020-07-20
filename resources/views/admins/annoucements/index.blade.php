@extends('layouts.app')

@section('content')
    <h1>@lang('words.annoucements')</h1>
    <br/>
    @include('cards.annoucements')
    <br/>
    <div class="flex justify-center">{{ $annoucements->links() }}</div>
@endsection
