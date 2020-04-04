@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Orders</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.orders') }}">View orders</a>
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
            <th>ID</th>
            <th>Value</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($orders ?? [] as $order)
            <tr>
                <td>
                    <code>{{ $order->id }}</code>
                </td>
                <td>
                    <span class="badge badge-primary">{{ number_format($order->value / 100, 2) }}</span>
                </td>
                <td>
                    @if($order->paid)
                        <span class="badge badge-success">Pago</span>
                    @else
                        <span class="badge badge-warning">Pendente</span>
                    @endif
                </td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>
                    <div class="btn-group" role="group">
                        @admin
                        <a class="btn btn-primary btn-sm" href="#">Edit</a>
                        @endadmin
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100"><h5 class="text-center">No orders!</h5></td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
