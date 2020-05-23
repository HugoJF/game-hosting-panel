@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @lang('words.games')
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($games as $game)
                            <li>
                                <a>{{ $game->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('games.create', $location) }}">
                        @lang('games.create')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
