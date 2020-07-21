@extends('layouts.app')

@section('content')
    <h1>@lang('passwords.users')</h1>
    <br/>
    @include('cards.users')
    <br/>
    <div class="flex justify-center">{{ $users->links() }}</div>
@endsection
