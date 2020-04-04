@extends('layouts.app')

@section('content')
    <h1>Coupons</h1>
    <br/>
    @include('cards.coupons')
    <br/>
    <div class="flex justify-center">{{ $coupons->links() }}</div>
@endsection