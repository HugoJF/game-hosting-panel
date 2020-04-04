{!! Form::open(['url' => $url, 'method' => $method, 'class' => $class ?? '', 'style' => 'display: inline;']) !!}
{{ $slot }}
{!! Form::close() !!}
