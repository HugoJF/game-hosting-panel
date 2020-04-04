@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Games</div>

                <div class="card-body">
                    <ul>
                        @foreach ($games as $game)
                            <li>
                                <a>{{ $game->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('games.create', $location) }}">Create new game</a>
                </div>
            </div>
        </div>
    </div>
@endsection
