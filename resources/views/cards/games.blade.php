@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Games</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.games') }}">View games</a>
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
            <th>Name</th>
            <th>Cover</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($games ?? [] as $game)
            <tr>
                <!-- Name -->
                <td>{{ $game->name }}</td>

                <!-- Cover -->
                <td>
                    @if($game->cover)
                        <a href="{{ $game->cover }}">{{ $game->cover }}</a>
                    @else
                        <span class="badge badge-dark">N/A</span>
                    @endif
                </td>

                <!-- Description -->
                <td>
                    <small>{{ $game->description }}</small>
                </td>

                <!-- Actions -->
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admins.games.edit', $game) }}">Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">No games!</h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
