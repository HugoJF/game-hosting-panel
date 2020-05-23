@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.nodes')
            </span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.nodes') }}">
                        @lang('nodes.view_all')
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
            <th>@lang('words.description')</th>
            <th>@lang('words.location')</th>
            <th>@lang('words.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($nodes ?? [] as $node)
            <tr>
                <!-- Name -->
                <td scope="row">
                    <a href="{{ route($showRoute ?? 'nodes.show', $node) }}">
                        {{ $node->name }}
                    </a>
                </td>

                <!-- Type -->
                <td>
                    <small>
                        {{ $node->description }}
                    </small>
                </td>

                <!-- Location -->
                <td>
                    <span class="badge badge-secondary">
                        {{ $node->location->short }}
                    </span>
                </td>

                <!-- Actions -->
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admins.nodes.edit', $node) }}">
                        @lang('words.edit')
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('nodes.no_nodes')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
