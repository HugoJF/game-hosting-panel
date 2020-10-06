@foreach($specs as $spec => $options)
    <div class="flex py-2 justify-between border-b last:border-b-0 border-gray-100">
        <p>
            <span class="inline text-gray-600" data-feather="{{ $options['icon'] }}"></span>
            <span class="text-gray-700 font-semibold">@lang($options['name'])</span>
        </p>
        <span class="text-gray-700">
            {{ strtolower($options['prefix'] ?? '') }}
            {{ $server->form[$spec] }}
            {{ strtolower($options['suffix'] ?? '') }}
        </span>
    </div>
@endforeach
