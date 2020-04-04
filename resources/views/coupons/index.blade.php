@extends('layouts.app')

@section('content')
    @include('cards.coupons', ['indexRoute' => false])
@endsection
