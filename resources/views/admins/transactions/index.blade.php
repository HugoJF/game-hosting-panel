@extends('layouts.app')

@section('content')
    <h1>@lang('words.transactions')</h1>
    <br/>
    @include('cards.announcements')
    <br/>
    <div class="flex justify-center">{{ $transactions->links() }}</div>
@endsection
