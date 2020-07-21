@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.announcement')
            </span>
            <div class="btn-group" role="group">
                @isset($slot)
                    {{ $slot }}
                @endisset
                <a class="btn btn-primary btn-sm" href="{{ route('admins.announcements.create') }}">
                    @lang('words.create')
                </a>
            </div>
        </div>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th>@lang('words.visible')</th>
            <th>@lang('words.type')</th>
            <th>@lang('words.description')</th>
            <th>@lang('words.action')</th>
            <th>@lang('words.expires_at')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($announcements ?? [] as $announcement)
            <tr>
                <!-- Visible -->
                <td>
                    {{ $announcement->visible ? '✔' : '❌' }}
                </td>

                <!-- Type -->
                <td>
                    <span class="badge badge-secondary">{{ $announcement->type }}</span>
                </td>

                <!-- Description -->
                <th>
                    <small>{{ $announcement->description }}</small>
                </th>

                <!-- Action -->
                <th>
                    <a href="{{ $announcement->action_url }}">
                        {{ $announcement->action }}
                    </a>
                </th>

                <!-- Actions -->
                <td>
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('admins.announcements.show', $announcement) }}">
                            @lang('words.view')
                        </a>
                        @admin
                        <a class="btn btn-primary btn-sm" href="{{ route('admins.announcements.edit', $announcement) }}">
                            @lang('words.edit')
                        </a>
                        @endadmin
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('announcements.no_announcements')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
