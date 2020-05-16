@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Server</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.servers.index') }}">View servers</a>
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
            <th>Game</th>
            <th>Node</th>
            <th>Deploys</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($servers ?? [] as $server)
            <tr>
                <!-- Server name -->
                <td>{{ $server->name }}</td>

                <!-- Game name -->
                <td>{{ $server->game->name }}</td>

                <!-- Node name -->
                <td>{{ $server->node->name }}</td>

                <!-- Deploys -->
                <td>{{ $server->deploys()->count() }}</td>

                <!-- Status -->
                <td>
                    @if(!$server->installed_at)
                        <span class="badge badge-warning">Installing</span>
                    @elseif($server->getDeploy())
                        <span class="badge badge-primary">Deployed</span>
                    @else
                        <span class="badge badge-dark">Stopped</span>
                    @endif
                </td>

                <!-- Actions -->
                <td>
                    {!! Form::open(['method' => 'DELETE', 'url' => route('servers.destroy', $server)]) !!}
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('servers.show', $server) }}">View</a>
                        @admin
                        <button class="btn btn-danger btn-sm">Delete</button>
                        @endadmin
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100"><h5 class="text-center">No servers!</h5></td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
