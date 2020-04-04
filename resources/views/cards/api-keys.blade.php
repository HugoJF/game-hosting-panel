@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>API Keys</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.transactions') }}">View all API keys</a>
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
            <th>Key</th>
            <th>Description</th>
            <th>Last used at</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($keys ?? [] as $key)
            <tr>
                <td>
                    <code>{{ $key->id }}</code>
                </td>
                <td>{{ $key->description }}</td>
                @if($key->last_used_at)
                    <td>{{ $key->last_used_at->diffForHumans() }}</td>
                @else
                    <td>Not used yet</td>
                @endif
                <td>{{ $key->created_at->diffForHumans() }}</td>
                <td>
                    @component('partials.form', ['method' => 'DELETE', 'url' => route('api-keys.destroy', $key)])
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('api-keys.edit', $key) }}">Edit</a>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    @endcomponent
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100"><h5 class="text-center">No API keys!</h5></td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
