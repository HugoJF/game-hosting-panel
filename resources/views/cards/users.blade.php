@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Users</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.nodes') }}">View users</a>
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
            <th>Server limit</th>
            <th>Server expiration (days)</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users ?? [] as $user)
            <tr>
                <!-- Name -->
                <td scope="row">{{ $user->name }}</td>

                <!-- Server limit -->
                <td><span class="badge badge-dark">{{ $user->server_limit }}</span></td>

                <!-- Server expiration -->
                <td><span class="badge badge-dark">{{ $user->server_expiration_days }} days</span></td>

                <!-- Email -->
                <td>{{ $user->email }}</td>

                <!-- Created At -->
                <td title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</td>
                <!-- Actions -->
                <td>
                    <div class="btn-group" role="group">
                        @admin
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user) }}">Edit</a>
                        @endadmin
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100"><h5 class="text-center">No users!</h5></td>
            </tr>

        @endforelse
        </tbody>
    </table>

@endcomponent
