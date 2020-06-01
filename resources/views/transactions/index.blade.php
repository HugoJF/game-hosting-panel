@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.transactions')
    </h1>
    <br/>
    @include('cards.transactions')

    <div class="w-100 flex justify-center">
        {{ $transactions->links() }}
    </div>
@endsection
