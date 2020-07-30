@foreach (session('flash_notification', collect())->toArray() as $message)
    @php
        $colors = ['success' => 'green', 'danger' => 'red'];
        $color = $colors[$message['level'] ?? 'success'];
    @endphp

    <div class="flex items-center w-full p-4 mb-8
                bg-{{ $color }}-500 text-base text-{{ $color }}-100
                border border-{{ $color }}-600"
         role="alert"
    >
        @if ($message['important'])
            <span class="inline-block flex items-center justify-center h-6 w-6 mr-4
                        text-lg text-white font-bold border-2 border-white rounded-full">!</span>
        @endif

        {!! $message['message'] !!}
    </div>
@endforeach

{{ session()->forget('flash_notification') }}
