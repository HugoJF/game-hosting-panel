@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.orders')
            </span>
            <div class="btn-group" role="group">
                @isset($indexRoute)
                    <a class="btn btn-outline-dark btn-sm" href="{{ route($indexRoute ?? 'admins.orders') }}">
                        @lang('orders.view_all')
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
            <th>@lang('words.id')</th>
            <th>@lang('words.value')</th>
            <th>@lang('words.status')</th>
            <th>@lang('words.created_at')</th>
            <th>@lang('words.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($orders ?? [] as $order)
            <tr>
                <td>
                    <code>
                        {{ $order->id }}
                    </code>
                </td>
                <td>
                    <span class="badge badge-primary">
                        {{ number_format($order->value / 100, 2) }}
                    </span>
                </td>
                <td>
                    @if($order->paid)
                        <span class="badge badge-success">
                            @lang('words.paid')
                        </span>
                    @else
                        <span class="badge badge-warning">
                            @lang('words.pending')
                        </span>
                    @endif
                </td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>
                    <div class="btn-group" role="group">
                        @admin
                        <a class="btn btn-primary btn-sm" href="#">
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
                        @lang('orders.no_orders')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
