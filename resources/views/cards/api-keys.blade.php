@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.api_keys')
            </span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.transactions') }}">
                        @lang('api_keys.view_all')
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
            <th>@lang('words.key')</th>
            <th>@lang('words.description')</th>
            <th>@lang('words.last_used_at')</th>
            <th>@lang('words.created_at')</th>
            <th>@lang('words.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($keys ?? [] as $key)
            <tr>
                <!-- Id -->
                <td>
                    <code>{{ $key->id }}</code>
                </td>

                <!-- Description -->
                <td>
                    {{ $key->description }}
                </td>

                <!-- Last used at -->
                @if($key->last_used_at)
                    <td>
                        {{ $key->last_used_at->diffForHumans() }}
                    </td>
                @else
                    <td>
                        @lang('words.not_used_yet')
                    </td>
            @endif

            <!-- Created at -->
                <td>
                    {{ $key->created_at->diffForHumans() }}
                </td>

                <!-- Actions -->
                <td>
                    @component('partials.form', ['method' => 'DELETE', 'url' => route('api-keys.destroy', $key)])
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('api-keys.edit', $key) }}">
                                @lang('words.edit')
                            </a>
                            <button class="btn btn-danger btn-sm">
                                @lang('words.delete')
                            </button>
                        </div>
                    @endcomponent
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('api_keys.no_keys')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
