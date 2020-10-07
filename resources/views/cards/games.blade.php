@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>@lang('words.games')</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.games') }}">
                        @lang('games.view_all')
                    </a>
                @endisset
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th>@lang('words.name')</th>
            <th>@lang('words.cover')</th>
            <th>@lang('words.description')</th>
            <th>@lang('words.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($games ?? [] as $game)
            <tr>
                <!-- Name -->
                <td>
                    <a href="{{ route('admins.games.show', $game) }}">
                        {{ $game->name }}
                    </a>
                </td>

                <!-- Cover -->
                <td>
                    @if($game->cover)
                        <a href="{{ $game->cover }}">
                            {{ $game->cover }}
                        </a>
                    @else
                        <span class="badge badge-dark">
                            @lang('words.na')
                        </span>
                    @endif
                </td>

                <!-- Description -->
                <td>
                    <small>
                        {{ $game->description }}
                    </small>
                </td>

                <!-- Actions -->
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admins.games.edit', $game) }}">
                        @lang('words.edit')
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('games.no_games')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
