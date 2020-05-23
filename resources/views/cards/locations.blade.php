@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.locations')
            </span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.locations') }}">
                        @lang('locations.view_all')
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
            <th>@lang('words.short')</th>
            <th>@lang('words.long')</th>
            <th>@lang('words.flag')</th>
            <th>@lang('words.actions')</th>
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

                <!-- Flag -->
                <td>
                    {{ $location->flag }}
                </td>

                <!-- Actions -->
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admins.locations.edit', $location) }}">
                        @lang('words.edit')
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('locations.no_locations')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
