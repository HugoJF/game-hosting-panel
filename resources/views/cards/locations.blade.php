@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Locations</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.locations') }}">View locations</a>
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
            <th>Short</th>
            <th>Long</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($locations ?? [] as $location)
            <tr>
                <!-- Short -->
                <td scope="row">
                    <a href="{{ route($showRoute ?? 'locations.show', $location) }}">
                        {{ $location->short }}
                    </a>
                </td>

                <!-- Long -->
                <td>
                    {{ $location->long }}
                </td>

                <!-- Actions -->
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admins.locations.edit', $location) }}">Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">There are no locations available!</h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
