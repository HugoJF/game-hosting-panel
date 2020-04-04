@extends('layouts.app')

@section('content')
    @include('cards.transactions')
    <br/>
    <div class="flex justify-center">{{ $transactions->links() }}</div>
@endsection