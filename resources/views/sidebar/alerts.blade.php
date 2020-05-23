@auth
    @php
        // $alerts = auth()->user()->getAlerts();
        $alerts = collect();
    @endphp

    @if($alerts->count() !== 0)
        <h6 class="flex justify-between items-center px-3 mt-8 mb-4 uppercase font-normal tracking-wider text-gray-700">
            <span>
                @lang('words.alerts')
            </span>
            <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
        </h6>

        <ul class="flex flex-col items-center">
            @foreach ($alerts as $alert)
                <li>
                    <a href="{{ $alert['url'] }}" class="badge badge-{{ $alert['level'] }}">
                        {{ $alert['message'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endauth
