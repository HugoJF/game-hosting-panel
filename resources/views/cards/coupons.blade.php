@component('partials.card')
    @slot('title')
        <div class="d-flex items-center justify-between">
            <span>
                @lang('words.coupons')
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
            <th>@lang('words.coupon')</th>
            <th>@lang('words.value')</th>
            <th>@lang('words.users')</th>
            <th>@lang('words.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($coupons ?? [] as $coupon)
            <tr>
                <!-- Coupon -->
                <td>{{ $coupon->code }}</td>

                <!-- Value -->
                <td>
                    @if($coupon->value > 0)
                        <span class="badge badge-success">R$ {{ round($coupon->value / 100, 2) }}</span>
                    @elseif($coupon->value < 0)
                        <span class="badge badge-danger">R$ {{ round(-$coupon->value / 100, 2) }}</span>
                    @else
                        <span class="badge badge-secondary">R$ {{ round($coupon->value / 100, 2) }}</span>
                    @endif
                </td>

                <!-- Users -->
                <td class="font-mono">
                    {{ $coupon->users()->count() }} / {{ $coupon->max_uses }}
                </td>

                <!-- Actions -->
                <td>
                    @component('partials.form', ['method' => 'DELETE', 'url' => route('coupons.destroy', $coupon)])
                        <div class="btn-group" role="group">
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('coupons.show', $coupon) }}">
                                @lang('words.view')
                            </a>
                            @admin
                            <a class="btn btn-primary btn-sm" href="{{ route('coupons.edit', $coupon) }}">
                                @lang('words.edit')
                            </a>
                            <button class="btn btn-danger btn-sm">
                                @lang('words.delete')
                            </button>
                            @endadmin
                        </div>
                    @endcomponent
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <h5 class="text-center">
                        @lang('coupons.no_coupons')
                    </h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endcomponent
