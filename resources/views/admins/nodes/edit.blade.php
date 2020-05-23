@extends('layouts.app')

@section('content')
    <h1>
        @lang('words.node')
        <strong>{{ $node->name }}</strong>
    </h1>
    <br/>
    {!! Form::open(['method' => 'PATCH', 'url' => route('admins.nodes.update', $node)]) !!}

    {!! Form::text('name') !!}

    {!! Form::close() !!}
@endsection
