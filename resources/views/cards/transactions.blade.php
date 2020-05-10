@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>Transactions</span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.transactions') }}">View transactions</a>
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
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($transactions ?? [] as $transaction)
            <tr>
                <!-- ID -->
                <td>
                    <code>{{ $transaction->id }}</code>
                </td>

                <!-- Value -->
                <td>
                    @if($transaction->value > 0)
                        <span class="badge badge-success">R$ {{ round($transaction->value / 100, 2) }}</span>
                    @elseif($transaction->value < 0)
                        <span class="badge badge-danger">R$ {{ round(-$transaction->value / 100, 2) }}</span>
                    @else
                        <span class="badge badge-secondary">R$ {{ round($transaction->value / 100, 2) }}</span>
                    @endif
                </td>

                <!-- Created at -->
                <td>{{ $transaction->created_at->diffForHumans() }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="100"><h5 class="text-center">No transactions!</h5></td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
