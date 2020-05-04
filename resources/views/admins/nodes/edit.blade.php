@extends('layouts.app')

@section('content')
    <h1>Node
        <strong>{{ $node->name }}</strong>
    </h1>
    <br/>
    {!! Form::open(['method' => 'PATCH', 'url' => route('admins.nodes.update', $node)]) !!}

    {!! Form::text('name') !!}

    {!! Form::close() !!}
@endsection
