@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.transactions')
            </span>
            <div class="btn-group" role="group">
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
            <th>@lang('words.created_at')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($transactions ?? [] as $transaction)
            <tr>
                <!-- ID -->
                <td>
                    <code>
                        {{ $transaction->id }}
                    </code>
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
                <td title="{{ $transaction->created_at }}">
                    {{ $transaction->created_at->diffForHumans() }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('transactions.no_transactions')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
