@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>
    
    
    {!! form_start($form) !!}
    
    {!! form_rest($form) !!}
    
    <div class="form-footer">
        <button type="submit" class="btn-success btn-block btn-lg btn">{{ $submit_text }}</button>
    </div>
    
    {!! form_end($form) !!}
@endsection